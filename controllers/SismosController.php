<?php
/**
 *
 * @package Main FRM
 * @since 1.0
 */

declare(strict_types=1);

namespace controllers;

require_once 'vendor/autoload.php';

use bootstrap\Controller;
use models\Sismos as SismosModel;
use models\DBProcess;

class Sismos extends Controller 
{
	private $_PDO;
	private SismosModel $sismos;
	private array $_parameters;
	private array $_dataTable;

	public function __construct() 
	{
		parent::__construct();
        $this->_PDO = \Database::getInstance()->getConnection();
		$this->sismos = new SismosModel($this->_PDO);
	}

	private function store()
	{
        foreach($_POST as $k => $v) {
            if (is_string($_POST))
                $_POST[$k] = $this->_PDO->quote($v);
        }
		$date = date("Y-m-d H:i", strtotime($_POST['fecha']));
		$intensidad = ($_POST['intensidad'] != "")? $_POST['intensidad'] : "-";
		$this->_parameters = array(
			"magnitud" => mb_strtoupper($_POST['magnitud'], 'UTF-8'),
			"referencia" => mb_strtoupper($_POST['referencia'], 'UTF-8'),
			"profundidad" => mb_strtoupper($_POST['profundidad'], 'UTF-8'),
			"intensidad" => mb_strtoupper($intensidad, 'UTF-8'),
			"fecha" => $date,
			"coordenadas" => mb_strtoupper($_POST['coordenadas'], 'UTF-8'),
			"usuarioId" => $_SESSION['idUsuario']	
		);
		$this->sismos->insertRow($this->_parameters);
		\Logger::getInstance()->setActionMessage('1', 'INSERT', 'monitoreoAnalisis', 'SISMO_' . $_POST['magnitud'] . "_" . $_POST['profundidad'], $_SESSION['loginUsuario']);
		foreach($_POST as $k => $v) {
			unset($_POST[$k]);
		}
		$this->_PDO = NULL;
	}

	private function destroy() 
	{
 		foreach($_POST as $k => $v) {
            if (is_string($_POST))
			$_POST[$k] = $this->_PDO->quote($v);
		}		
		$idRow =  \NumHash::decrypt($_POST['delId']);
		$db = new DBProcess($this->_PDO);
		$nameRow = $db->getRowValuesDB('sismos', 'idSismos', $idRow);	
		$dateRow = $nameRow['fecha'] . "_" .$nameRow['profundidad'];
		$this->sismos->deleteRow($idRow);
		\Logger::getInstance()->setActionMessage('1', 'DELETE', 'monitoreoAnalisis', 'SISMO_' . $dateRow . '_' . $idRow, $_SESSION['loginUsuario']);
		foreach($_POST as $k => $v) {
			unset($_POST[$k]);
		}
		$this->_PDO = NULL;
	}

	private function edit()
	{
 		foreach($_POST as $k => $v) {
            if (is_string($_POST))
			$_POST[$k] = $this->_PDO->quote($v);
		}
		$idRow =  \NumHash::decrypt($_POST['e_ref']);
		$date = date("Y-m-d H:i", strtotime($_POST['e_fecha']));
		$intensidad = ($_POST['e_intensidad'] != "")? $_POST['e_intensidad'] : "-";

		$this->_parameters = array(
			"magnitud" => mb_strtoupper($_POST['e_magnitud'], 'UTF-8'),
			"referencia" => mb_strtoupper($_POST['e_referencia'], 'UTF-8'),
			"profundidad" => mb_strtoupper($_POST['e_profundidad'], 'UTF-8'),
			"intensidad" => mb_strtoupper($intensidad, 'UTF-8'),
			"fecha" => $date,
			"coordenadas" => mb_strtoupper($_POST['e_coordenadas'], 'UTF-8'),
			"usuarioId" => $_SESSION['idUsuario'],
			"idSismos" => $idRow
		);
		$this->sismos->updateRow($this->_parameters);
		\Logger::getInstance()->setActionMessage('1', 'UPDATE', 'monitoreoAnalisis', 'SISMO_' . $_POST['e_magnitud'] . '_' . $date . '_' . $idRow, $_SESSION['loginUsuario']);
		foreach($_POST as $k => $v) {
			unset($_POST[$k]);
		}
		$this->_PDO = NULL;
	}

	private function getDataTableValues($request) : void
	{
		$this->_dataTable = $this->sismos->getDataValues($request);
	}

	public function indexUser($fileNameView)
	{
		if (isset($_GET['jsonDataReportes']) && isset($_SESSION['csrf_token'])) {
			$this->getDataTableValues($_REQUEST);
			print(json_encode($this->_dataTable));
			return;
		}		

		if ( isset($_GET['jsonDataEditReportes']) && isset($_SESSION['csrf_token'])) {	
			$reportValues = $this->sismos->getEditValues($_GET['ref']);
			print(json_encode($reportValues));
			return;
		}	

		if ( $this->handlerRequestPost() ) {
			if ($this->requestType == '_add' && $this->handlerRequestCSRF() == true) {				
				$this->store();
			}
			if ($this->requestType == '_edit') {
				$this->edit();
			}
			if ($this->isAJX() && $this->requestType == "_del") {
                $this->destroy();
            }
            return;
		}

		$db = new DBProcess($this->_PDO);
		$total_rpt = $db->getCountRowsTable("sismos");

		$min_sismos = $this->sismos->get_min_sismos();
		$mid_sismos = $this->sismos->get_mid_sismos();
		$max_sismos = $this->sismos->get_max_sismos();

		$this->view->render(  PATH_RESOURCE_VIEW . '/user/' . $fileNameView,
                            ['total_rpt' => $total_rpt,
                                'min_sismos' => $min_sismos,
                                'mid_sismos' => $mid_sismos,
                                'max_sismos' => $max_sismos
                            ]
		 );
	}	

}
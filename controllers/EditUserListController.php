<?php
/**
 *
 * @package Main FRM
 * @since 1.0
 */

namespace controllers;

require_once 'vendor/autoload.php';
require_once 'bootstrap/Controller.php';

use bootstrap\Controller;
use models\UserList;
use models\DBProcess;

class EditUserList extends Controller 
{
	private $_mysqli;

	private UserList $userList;
	private $reportValues;

	public function __construct() 
	{
		parent::__construct();
        $this->_mysqli = \Database::getInstance()->getConnection();
		$this->userList = new UserList($this->_mysqli);
	}

	public function getDataUserList()
	{
        $idUser = \NumHash::decrypt($_GET['ref']);
        $idAccessProfile = $_GET['ap'];
		$this->reportValues = $this->userList->getEditValues($idUser, $idAccessProfile);
	}

	public function indexAdmin($fileNameView)
	{
		$this->getDataUserList();
		/**
		 * include view
		 */
		
		$db = new DBProcess($this->_mysqli);
		$modulo = $db->getAllRows("modulo", "idModulo", "nombreModulo");
		$tipoUsuario = $db->getAllRows("tipo_usuario", "idTipo_usuario", "tipoUsuario");
		
		$this->view->render(PATH_RESOURCE_VIEW . '/admin/' . $fileNameView,
							[
								'dataUserList' => $this->reportValues, 
								'modulo' => $modulo,
								'tipoUsuario' => $tipoUsuario
							]);
	}
}
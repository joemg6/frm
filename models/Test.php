<?php

/**
 *
 * @package Main PaymenTIK
 * @since 1.0
 */
declare(strict_types=1);

namespace models;

class Test extends DBProcess
{

	protected $_mysqli;

	private $_msnFailPrepare;
	private $_msnFailBind;
	private $_msnFailExecute;

	public function __construct($db)
	{
		$this->_mysqli = $db;

		$this->_msnFailPrepare = "Falló la preparación: (" . $this->_mysqli->errno . ") " . $this->_mysqli->error;
		$this->_msnFailBind    = "Falló la vinculación de parámetros: (" . $this->_mysqli->errno . ") " . $this->_mysqli->error;
		$this->_msnFailExecute = "Falló la ejecución: (" . $this->_mysqli->errno . ") " . $this->_mysqli->error;

	}

	public function getRowValuesDB($table, $campoWhere, $idSearch)
	{

		$stmt = $this->_mysqli->prepare("
			SELECT * 
			FROM $table 
			WHERE $campoWhere = {$idSearch}");

		$stmt->execute();
		$stmt->store_result();
		$meta = $stmt->result_metadata();

		while ($column = $meta->fetch_field()) {
		   $bindVarsArray[] = &$results[$column->name];
		}
		call_user_func_array(array($stmt, 'bind_result'), $bindVarsArray);
		$stmt->fetch();
		$stmt->close();
		return $results;
	}
	
	public function setTest($description) : bool
	{
		
		$insert = "INSERT INTO `test` (`description`) VALUES (?)";

		if ( !($sql = $this->_mysqli->prepare($insert)) ) {
			echo $this->_msnFailPrepare;
			return false;
		}

		if ( !$sql->bind_param('s', $description) ) {
			echo $this->_msnFailBind;
			return false;
		}

		if ( !$sql->execute() ) {
			echo $this->_msnFailExecute;
			//return $this->_mysqli->insert_id;
			return false;
		}
		$sql->close();
		return true;			
	}


	public function deleteTest($id) : bool
	{
		$del = "DELETE FROM `test` WHERE `idTest` = ?";

		if ( !$sql = $this->_mysqli->prepare($del) ) {
			echo $this->_msnFailPrepare;
			return false;			
		}

		if ( !$sql->bind_param("i", $id) ) {
			echo $this->_msnFailBind;
			return false;			
		}

		if ( !$sql->execute() ) {
			echo $this->_msnFailExecute;
			return false;
		} 
		$sql->close();
		return true;
	}

	public function updateTest($tipoReporte, $numeroReporte, $evento, $lugar, $descripcion, $fileSource, $users_idUser, $idReporte) : bool
	{		

		$up = "UPDATE `test` SET tipoReporte = ?, numeroReporte = ?, evento = ?, lugar = ?, descripcion = ?,  fileSource = ?, lastUpdate = NOW(), users_idUser = ? WHERE idTest = ?";

		if ( !$stmt = $this->_mysqli->prepare($up) ) {
			echo $this->_msnFailPrepare;
			return false;				
		}

		if ( !$stmt->bind_param('ssssssii', $tipoReporte, $numeroReporte, $evento, $lugar, $descripcion, $fileSource, $users_idUser, $idReporte) ) {
			echo $this->_msnFailBind;
			return false;
		}

		if ( !$stmt->execute() ) {
			echo $this->_msnFailExecute;
			return false;
		} 
		$stmt->close();
		return true;		
	}

    public function getTestValues(array $requestDataValues) : array
    {
        $requestData = $requestDataValues;

        $columns = array(
            0 => 'idTest',
            1 => 'description'
        );


$sql = "SELECT * FROM test";
        //$sql.=" FROM ... group by ...";
        $query         = $this->_mysqli->query($sql);
        $totalData     = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        if ( !empty($requestData['search']['value']) ) {
            $sql.=" HAVING description LIKE '%".$requestData['search']['value']."%' ";
        }	

        $query         = $this->_mysqli->query($sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query         = $this->_mysqli->query($sql);

        $data = array();
        while ( $row = mysqli_fetch_array($query) ) {
            $nestedData= array();

            $id = \NumHash::encrypt($row["idTest"]);
            $token = md5($row["idTest"]);

            $nestedData[] = $row["idTest"];
            $nestedData[] = $row["description"];

			$file = 'href="#"';
			$delete = "<a href='#' class='delFile' data-id_file='{$id}' ><i class='fa fa-trash'></i></a>";

            $nestedData[] = "
				<div class='end_td_dataTables'>
				<a style='cursor: pointer;' href='EditTest?ref={$id}&token={$token}'><i class='fa fa-edit'></i></a>&nbsp;			
				<a style='cursor: pointer;' {$file} ><i class='fa fa-download'></i></a>&nbsp&nbsp{$delete}			
				</div>					
				";			
			
            $data[] = $nestedData;			
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        return $json_data;
    }


}

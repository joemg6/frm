<?php

/**
 *
 * @package Main SIRED
 * @since 1.0
 */
declare(strict_types=1);

namespace models;

require_once 'bootstrap/Model.php';

use bootstrap\Model;

class Sismos extends Model
{
	public function __construct($dbConnection)
	{
		$this->_PDO = $dbConnection;
	}
	
	public function insertRow(array $parameters) : bool
	{
		$insert = "INSERT INTO `sismos` 
				(`idSismos`, `magnitud`, `referencia`, `profundidad`, `intensidad`, `fecha`,  `coordenadas`, `createdAt`, `updatedAt`, `usuarioId`) 
				VALUES (NULL, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)";
		if ( !($stmt = $this->_PDO->prepare($insert)) ) {
			return false;
		}
        $num = 1;
        foreach ($parameters as $value) {
            $stmt->bindvalue($num, $value);
            $num++;
        }
		if ( !$stmt->execute() ) {
			return false;
		}
		return true;			
	}

	public function deleteRow($idRow) : bool
	{
		$delete = "DELETE FROM `sismos` WHERE `idSismos` = ?";
		if ( !$stmt = $this->_PDO->prepare($delete) )
			return false;			
		$stmt->bindParam(1, $idRow, \PDO::PARAM_INT);
		if ( !$stmt->execute() )
			return false;
		return true;
	}

	public function updateRow(array $parameters) : bool
	{
		$update = "UPDATE `sismos` 
			   SET magnitud = ?, referencia = ?, profundidad = ?, intensidad = ?, fecha = ?, coordenadas = ?, updatedAt = NOW(), usuarioId = ? 
			   WHERE idSismos = ?";
		if ( !$stmt = $this->_PDO->prepare($update) )
			return false;
        $num = 1;
        foreach ($parameters as $value) {
            $stmt->bindvalue($num, $value);
            $num++;
        }
		if ( !$stmt->execute() )
			return false;
		return true;		
	}

	public function getEditValues(string $id) : array
	{
		$idSismos = (string)\NumHash::decrypt($id);
		$sql = "SELECT *, DATE_FORMAT(fecha,'%d-%m-%Y %H:%i') AS fechaSismo 
                FROM sismos 
		        WHERE idSismos = :idSismos";
        $stmt = $this->_PDO->prepare($sql);
        $stmt->bindParam(':idSismos', $idSismos);
        $stmt->execute();
        $dataValues = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $dataValues;
	}

	public function getDataValues(array $requestDataValues) : array
    {
        $requestData = $requestDataValues;
        $columns = array('idSismos', 'magnitud', 'referencia', 'profundidad', 'intensidad', 'fecha', 'coordenadas' );
		$sql = "SELECT *, DATE_FORMAT(fecha,'%d-%m-%Y %H:%i') AS fechaSismo FROM sismos";
        $stmt = $this->_PDO->prepare($sql);
        $stmt->execute();
        $totalData = $stmt->rowCount();
        $totalFiltered = $totalData;
        if ( !empty($requestData['search']['value']) ) {
            $sql.=" HAVING magnitud LIKE '%".$requestData['search']['value']."%' 
			OR referencia LIKE '%".utf8_encode($requestData['search']['value'])."%' 
			";
        }

        $sql .= " ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  
                  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $stmt = $this->_PDO->prepare($sql);
        $stmt->execute();
        $totalFiltered = $stmt->rowCount();
        $data = array();
        while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ) {
            $nestedData= array();
            $id = (string)\NumHash::encrypt($row["idSismos"]);
            $token = md5($row["idSismos"]);
            $nestedData[] = $row["idSismos"];
            $nestedData[] = $row["magnitud"];
            $nestedData[] = $row["referencia"];
            $nestedData[] = $row["profundidad"];
            $nestedData[] = $row["intensidad"];
            $nestedData[] = $row["fechaSismo"];			
            $nestedData[] = $row["coordenadas"];			
            $nestedData[] = $id;
            $nestedData[] = $token;
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

	public function get_min_sismos() : int
	{
		$sql = "SELECT magnitud FROM sismos WHERE magnitud < 4.5";
		$query = $this->_PDO->query($sql);
        $num = $query->rowCount();
		return $num;
	}

	public function get_mid_sismos() : int
	{
		$sql = "SELECT magnitud FROM sismos WHERE magnitud >= 4.5 AND magnitud <= 6";
		$query = $this->_PDO->query($sql);
        $num = $query->rowCount();
		return $num;
	}

	public function get_max_sismos() : int
	{
		$sql = "SELECT magnitud FROM sismos WHERE magnitud > 6";
		$query = $this->_PDO->query($sql);
        $num = $query->rowCount();
		return $num;
	}

	public function __destruct() 
	{
		$this->_PDO = NULL;
	}

}

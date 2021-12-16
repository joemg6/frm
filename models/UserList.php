<?php

/**
 *
 * @package Main FRM
 * @since 1.0
 */
declare(strict_types=1);

namespace models;

require_once 'bootstrap/Model.php';

use bootstrap\Model;

class UserList extends Model
{
	public function __construct($dbConnection)
	{
		$this->_PDO = $dbConnection;
	}
	
	public function insertRow(array $parameters) : bool
	{
		foreach ($parameters as $key => $value) {
			${$key} = $value;
		}
		$this->_PDO->beginTransaction();
		$status = true;

		$insert = "INSERT INTO `usuario` (`loginUsuario`, `passUsuario`, `nombre`, `aPaterno`, `aMaterno`, `dni`, `fechaIngreso`, `direccion`, `telefono`, `correo`, `createdAt`, `updatedAt`, `estado`, `modulo_idModulo`, `tipo_usuario_idTipo_usuario`) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, NOW(), NOW(), '$estado', '$modulo', '$tipoUsuario')";
		if ( !($stmt = $this->_PDO->prepare($insert)) )
            $status = false;
        $stmt->bindParam(1, $loginUsuario, \PDO::PARAM_STR);
        $stmt->bindParam(2, $passUsuario, \PDO::PARAM_STR);
        $stmt->bindParam(3, $nombre, \PDO::PARAM_STR);
        $stmt->bindParam(4, $aPaterno, \PDO::PARAM_STR);
        $stmt->bindParam(5, $aMaterno, \PDO::PARAM_STR);
        $stmt->bindParam(6, $dni, \PDO::PARAM_INT);
        $stmt->bindParam(7, $direccion, \PDO::PARAM_STR);
        $stmt->bindParam(8, $telefono, \PDO::PARAM_STR);
        $stmt->bindParam(9, $correo, \PDO::PARAM_STR);
		if ( !$stmt->execute() )
            $status = false;
		$usuario_idUsuario = $this->_PDO->lastInsertId();

		$insert_2 = "INSERT INTO `access_profile` (`typeProfile`, `usuario_idUsuario`) VALUES ( ?, ?)";
		if ( !($stmt2 = $this->_PDO->prepare($insert_2)) )
            $status = false;
        $stmt2->bindParam(1, $typeProfile, \PDO::PARAM_STR);
        $stmt2->bindParam(2, $usuario_idUsuario, \PDO::PARAM_INT);
		if ( !$stmt2->execute() ) {
            $status = false;
        }

		if ( $status == false ) {
			$this->_PDO->rollback();
			return false;
		} else {
			$this->_PDO->commit();
		}
		return true;			
	}

    public function deleteRow($idUser) : bool
    {
        return false;
    }

	public function deleteUser(int $idUser, int $delIdAccess_profile) : bool
	{
		$this->_PDO->beginTransaction();
		$status = true;

		$del_2 = "DELETE FROM `access_profile` WHERE `idAccess_profile` = ?";
		if ( !$stmt = $this->_PDO->prepare($del_2) )
            $status = false;
        $stmt->bindParam(1, $delIdAccess_profile, \PDO::PARAM_INT);
		if ( !$stmt->execute() )
            $status = false;

		$del = "DELETE FROM `usuario` WHERE `idUsuario` = ?";
		if ( !$stmt = $this->_PDO->prepare($del) ) return false;
        $stmt->bindParam(1, $idUser, \PDO::PARAM_INT);
		if ( !$stmt->execute() )
            $status = false;

		if ( $status == false ) {
			$this->_PDO->rollback();
			return false;
		} else {
			$this->_PDO->commit();
		}
		return true;
	}

	public function updateRow(array $parameters) : bool
	{
		foreach ($parameters as $key => $value) {
			${$key} = $value;
		}
		$this->_PDO->beginTransaction();
		$status = true;

		$up = "UPDATE `usuario` SET loginUsuario = ?, passUsuario = ?, nombre = ?, aPaterno = ?, aMaterno = ?, dni = ?, direccion = ?, telefono = ?, correo = ?, updatedAt = NOW(), estado = '$estado', modulo_idModulo = '$modulo', tipo_usuario_idTipo_usuario = '$tipoUsuario' WHERE idUsuario = ?";
		if ( !$stmt = $this->_PDO->prepare($up) )
            $status = false;
            $stmt->bindParam(1, $loginUsuario, \PDO::PARAM_STR);
            $stmt->bindParam(2, $passUsuario, \PDO::PARAM_STR);
            $stmt->bindParam(3, $nombre, \PDO::PARAM_STR);
            $stmt->bindParam(4, $aPaterno, \PDO::PARAM_STR);
            $stmt->bindParam(5, $aMaterno, \PDO::PARAM_STR);
            $stmt->bindParam(6, $dni, \PDO::PARAM_INT);
            $stmt->bindParam(7, $direccion, \PDO::PARAM_STR);
            $stmt->bindParam(8, $telefono, \PDO::PARAM_STR);
            $stmt->bindParam(9, $correo, \PDO::PARAM_STR);
            $stmt->bindParam(10, $idUsuario, \PDO::PARAM_INT);
		if ( !$stmt->execute() )
            $status = false;

		$update2 = "UPDATE `access_profile` SET typeProfile = ? WHERE idAccess_profile = ?";
		if ( !$stmt = $this->_PDO->prepare($update2) )
            $status = false;
        $stmt->bindParam(1, $typeProfile, \PDO::PARAM_STR);
        $stmt->bindParam(2, $idAccess_profile, \PDO::PARAM_INT);
		if ( !$stmt->execute() )
            $status = false;

		if ( $status == false ) {
			$this->_PDO->rollback();
			return false;
		} else {
			$this->_PDO->commit();
		}
		return true;		
	}

	public function getEditValues(string $idUser, string $idAccessProfile) : array
	{
		$sql = "SELECT loginUsuario, passUsuario, nombre, aPaterno, aMaterno, dni, direccion, telefono, correo, estado, idModulo, nombreModulo, idTipo_usuario, tipoUsuario, idAccess_profile, typeProfile
			FROM usuario
			INNER JOIN modulo
			ON usuario.modulo_idModulo = modulo.idModulo
			INNER JOIN tipo_usuario
			ON usuario.tipo_usuario_idTipo_usuario = tipo_usuario.idTipo_usuario
			INNER JOIN access_profile
			ON usuario.idUsuario = access_profile.usuario_idUsuario";
		$sql.=" WHERE idUsuario = :idUsuario && idAccess_profile = :idAccess_profile";
        $stmt = $this->_PDO->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUser);
        $stmt->bindParam(':idAccess_profile', $idAccessProfile);
        $stmt->execute();
        $dataValues = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $dataValues;
	}

    public function getDataValues(array $requestDataValues) : array
    {
        $requestData = $requestDataValues;
        $columns = array(0 => 'idUsuario', 1 => 'loginUsuario', 2 => 'nombre');
		$sql = "SELECT idUsuario, loginUsuario, passUsuario, nombre, aPaterno, aMaterno, dni, direccion, telefono, correo, estado, idModulo, nombreModulo, idTipo_usuario, tipoUsuario, idAccess_profile, typeProfile
			FROM usuario
			INNER JOIN modulo
			ON usuario.modulo_idModulo = modulo.idModulo
			INNER JOIN tipo_usuario
			ON usuario.tipo_usuario_idTipo_usuario = tipo_usuario.idTipo_usuario
			INNER JOIN access_profile
			ON usuario.idUsuario = access_profile.usuario_idUsuario";
        $stmt = $this->_PDO->query($sql);
        $totalData = $stmt->rowCount();
        $totalFiltered = $totalData;
        if ( !empty($requestData['search']['value']) ) {
            $sql.=" HAVING loginUsuario LIKE '%".$requestData['search']['value']."%' ";
        }
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $stmt         = $this->_PDO->query($sql);
        $totalFiltered = $stmt->rowCount();
        $data = array();
        while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ) {
            $nestedData= array();
            $id = (string)\NumHash::encrypt($row["idUsuario"]);
            $token = md5($row["idUsuario"]);
			$apellidos = $row["aPaterno"] . " " . $row["aMaterno"];
            $nestedData[] = $row["loginUsuario"];
            $nestedData[] = htmlentities(utf8_decode($row["nombre"]));			
            $nestedData[] = htmlentities(utf8_decode($apellidos));
            $nestedData[] = $row["dni"];
            $nestedData[] = $row["telefono"];
            $nestedData[] = $row["correo"];
            $nestedData[] = ucfirst($row["nombreModulo"]);
            $nestedData[] = ucfirst($row["typeProfile"]);
            $nestedData[] = $row["estado"];
            $nestedData[] = $id;
            $nestedData[] = $token;
            $nestedData[] = $row["idAccess_profile"];
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

	public function __destruct() 
	{
		$this->_PDO = NULL;
	}

}

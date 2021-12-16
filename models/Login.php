<?php
/**
 *
 * @package Main SIRED
 * @since 1.0
 */

namespace models;

require 'models/Session.php';

class Login
{	
	private $_PDO;
	private Session $_objSession;

	private string $_typeProfile;
	private string $_userName;
	private string $_passwordUser;

	public function __construct()
	{		
        $this->_PDO = \Database::getInstance()->getConnection();
	}

    public function loginUser(string $userName, string $passwordUser, string $typeProfile)
    {
        $this->_typeProfile = $typeProfile;
        $this->_userName = $userName;
        $this->_passwordUser = sha1($passwordUser);

		$sql = "
            SELECT * FROM usuario 
            INNER JOIN access_profile
            ON access_profile.usuario_idUsuario = usuario.idUsuario
            INNER JOIN modulo
            ON modulo.idModulo = usuario.modulo_idModulo 
            INNER JOIN tipo_usuario
            ON tipo_usuario.idTipo_usuario = usuario.tipo_usuario_idTipo_usuario
            WHERE usuario.correo = :correo
            OR usuario.loginUsuario = :loginUsuario
            AND usuario.passUsuario = :passUsuario		
            AND access_profile.typeProfile = :typeProfile		
            AND usuario.estado = 1			
            ";
        if ( !$stmt = $this->_PDO->prepare($sql) ) {
            echo "Falló la preparación: ";
        }

        $stmt->bindParam(':correo', $this->_userName, \PDO::PARAM_STR);
        $stmt->bindParam(':loginUsuario', $this->_userName, \PDO::PARAM_STR);
        $stmt->bindParam(':passUsuario', $this->_passwordUser, \PDO::PARAM_STR);
        $stmt->bindParam(':typeProfile', $this->_typeProfile, \PDO::PARAM_STR);

        if ( !$stmt->execute() ) {
            echo "Falló la ejecución: (";
        }

        $result = $stmt->fetchAll();
        if ($stmt->rowCount() <= 0) {
			header("Location: ./?error=1");
			exit();
        }

        $this->_objSession = new Session();
		$this->_objSession->startSession();
        foreach ($result as $row) {
            $modulo[] = $row["nombreModulo"];
            $this->_objSession->setValueSession('last_activity', time());
            $this->_objSession->setValueSession('idProfile' . SUFFIX, $row["idAccess_profile"]);
            $this->_objSession->setValueSession('nameProfile' . SUFFIX, $row["typeProfile"]);
            $this->_objSession->setValueSession('modulo_idProfile', $row["modulo_idModulo"]);
            $this->_objSession->setValueSession('modulo', $modulo);
            $this->_objSession->setValueSession('idUsuario', $row["idUsuario"]);
            $this->_objSession->setValueSession('loginUsuario', $row["loginUsuario"]);
            $this->_objSession->setValueSession('csrf_token', sha1($row["loginUsuario"]) . SUFFIX);
            $this->_objSession->setValueSession('tipoUsuario', $row["tipoUsuario"]);
            $this->_objSession->setValueSession('emailUser', $row["correo"]);
            $this->_objSession->setValueSession('nameUser', $row["nombre"]);
            $this->_objSession->setValueSession('secondNameUser', $row["aPaterno"]);
            $nameProfile = $row["typeProfile"];
        }

		header('Location: '. $nameProfile .'/init');
        $stmt->close();
    }

}


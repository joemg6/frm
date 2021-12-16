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
use models\UserList as UserListModel;
use models\DBProcess;
use models\ManagerFile;

class UserList extends Controller
{
    private $_PDO;
    private UserListModel $bah;
    private ManagerFile $managerFile;
    private array $_parameters;
    private array $_dataTable;

    const FILES_FOLDER = "";

    public function __construct()
    {
        parent::__construct();
        $this->_PDO = \Database::getInstance()->getConnection();
        $this->bah = new UserListModel($this->_PDO);
    }

    private function store()
    {
        foreach($_POST as $k => $v) {
            if (is_string($_POST))
                $_POST[$k] = $this->_PDO->quote($v);
        }
        $this->_parameters = array(
            "loginUsuario" => strtolower($_POST['nickname']),
            "passUsuario" => sha1($_POST['passUsuario']),
            "nombre" => utf8_encode(ucfirst(strtolower($_POST['nombre']))),
            "aPaterno" => utf8_encode(ucfirst(strtolower($_POST['aPaterno']))),
            "aMaterno" => utf8_encode(ucfirst(strtolower($_POST['aMaterno']))),
            "dni" => $_POST['dni'],
            "direccion" => utf8_encode(ucfirst(strtolower($_POST['direccion']))),
            "telefono" => $_POST['telefono'],
            "correo" => strtolower($_POST['correo']),
            "estado" => 1,
            "modulo" => $_POST['modulo'],
            "tipoUsuario" => $_POST['tipoUsuario'],
            "typeProfile" => $_POST['typeProfile']
        );
        if ( !$this->bah->insertRow($this->_parameters) ) {
            echo "Error, no se pudo ingresar el registro";
        }
        \Logger::getInstance()->setActionMessage('1', 'INSERT', 'ADD_USER', $_POST['nickname'], $_SESSION['loginUsuario']);
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
        $idUser =  \NumHash::decrypt($_POST['delIdUser']);
        $delIdAccess_profile = (int)$_POST['delIdAccess_profile'];
        $db = new DBProcess($this->_PDO);
        $nameRow = $db->getRowValuesDB('usuario', 'idUsuario', $idUser);
        $dateRow = $nameRow['loginUsuario'];

        $this->bah->deleteUser($idUser, $delIdAccess_profile);

        \Logger::getInstance()->setActionMessage('1', 'DELETE', 'DEL_USER', $dateRow . '_' . $idUser, $_SESSION['loginUsuario']);
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
        if ( $_POST['passUsuario'] != "" && strlen($_POST['passUsuario']) < 30) {
            $passwd = sha1($_POST['passUsuario']);
        } else {
            $passwd = $_POST['old_password'];
        }
        $this->_parameters = array(
            "loginUsuario" => strtolower($_POST['nickname']),
            "passUsuario" => $passwd,
            "nombre" => utf8_encode(ucfirst(strtolower($_POST['nombre']))),
            "aPaterno" => utf8_encode(ucfirst(strtolower($_POST['aPaterno']))),
            "aMaterno" => utf8_encode(ucfirst(strtolower($_POST['aMaterno']))),
            "dni" => $_POST['dni'],
            "direccion" => utf8_encode(ucfirst(strtolower($_POST['direccion']))),
            "telefono" => $_POST['telefono'],
            "correo" => strtolower($_POST['correo']),
            "estado" => $_POST['estado'],
            "modulo" => $_POST['modulo'],
            "tipoUsuario" => $_POST['tipoUsuario'],
            "typeProfile" => $_POST['typeProfile'],
            "idUsuario" => $_POST['ref'],
            "idAccess_profile" => $_POST['idAccess_profile']
        );
        if ( !$this->bah->updateRow($this->_parameters) ) {
            echo "Error, no se pudo actualizar el registro";
        }
        \Logger::getInstance()->setActionMessage('1', 'UPDATE', 'EDIT_USER', $_POST['nickname'] . "_" . $_POST['ref'], $_SESSION['loginUsuario']);
        foreach($_POST as $k => $v) {
            unset($_POST[$k]);
        }
        $this->_PDO = NULL;
    }

    private function getDataTableValues($request) : void
    {
        $this->_dataTable = $this->bah->getDataValues($request);
    }

    private function uploadFile(array $file) : bool
    {
        $inputName = array_key_first($_FILES);
        $this->uploadFileName = NULL;
        if ( strlen($_FILES[$inputName]['name']) > 5 && $_FILES[$inputName]['size'] > 0 ) {
            $fileTmpPath = $_FILES[$inputName]['tmp_name'];
            $fileName = \Sanitize::replaceSpecialChars($_FILES[$inputName]['name']);
            $fileName = \Sanitize::cleanHyphenizeSpecialChars($fileName);
            $fileSize = $_FILES[$inputName]['size'];
            $fileType = $_FILES[$inputName]['type'];
            $this->managerFile = new ManagerFile();
            $this->uploadFileName = $this->managerFile->uploadProductFile($fileTmpPath, $fileName, $fileSize, $fileType, self::FILES_FOLDER);
            return true;
        }
        return false;
    }

    public function indexAdmin($fileNameView)
    {
        if (isset($_GET['jsonDataReportes']) && isset($_SESSION['csrf_token'])) {
            $this->getDataTableValues($_REQUEST);
            print(json_encode($this->_dataTable));
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
        $modulo = $db->getAllRows("modulo", "idModulo", "nombreModulo");
        $tipoUsuario = $db->getAllRows("tipo_usuario", "idTipo_usuario", "tipoUsuario");

        $requestReporte = PATH_MODELS . '/inc/getRequestBah.php';
        $this->view->render(  PATH_RESOURCE_VIEW . '/admin/' . $fileNameView, ['requestReporte' => $requestReporte, 'modulo' => $modulo, 'tipoUsuario' => $tipoUsuario] );
    }

}
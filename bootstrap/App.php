<?php
/**
*
* @package Main FRM
* @since 1.0
*/

namespace bootstrap;

require_once 'main/pathDefault.php';
require 'class/Database.php';
require 'class/Logger.php';
require 'models/DBProcess.php';

use models\DBProcess;

class App
{

	private $_PDO;

    private ?string $_url;
    public ?string $_profile;
    public ?string $_endPoint;
    public array $_userProfiles;

	protected string $suffix = SUFFIX;

    private Route $_objRoute;

    public function __construct(?string $url)
    {
        $this->_url = $url;
        $this->_userProfiles = array();
		$this->_PDO = \Database::getInstance()->getConnection();
    }

    public function getRoutes() : void
    {        
		if ($this->_url) {
			$db = new DBProcess($this->_PDO);
			$this->_userProfiles = $db->getAllRowsGroupBy("access_profile", "idAccess_profile", "typeProfile");
		}
        $this->_objRoute = new Route($this->_url, $this->_userProfiles);
        $route_arr = $this->_objRoute->get();
		$this->_profile = $route_arr['profile'];
        $this->_endPoint = $route_arr['endPoint'];
    }

    private function loadFileController() : bool
    {
		$controllerFile = '';
        if ( ($this->_profile == "indexLogin" || $this->_profile == "indexAdminLogin") && $this->_endPoint == NULL ) {
            $controllerFile = 'controllers/IndexController.php'; // index form (ControllerIndex)
        }
        else if ( $this->_profile != NULL && $this->_endPoint == NULL ) {
            $controllerFile = 'controllers/' . ucfirst($this->_profile) . 'Controller.php';
        }
        else if ( $this->_profile != NULL && $this->_endPoint != NULL ) {
            $controllerFile = 'controllers/' . ucfirst($this->_endPoint) . 'Controller.php';
        }

		if ( !file_exists($controllerFile) ) {
			return false;
		}
		require $controllerFile;
		return true;
    }

	private function isIndex() : bool
	{
        if ( !$this->_profile == "indexLogin" || !$this->_profile == "indexAdminLogin" )
            return false;
        $className = "controllers\\Index";
        if (!class_exists($className))
            return false;

        $objIndex = new $className;
        if ($this->_profile == "indexAdminLogin") {
            $objIndex->indexAdmin();
            return true;
        }
        if ($this->_profile == "indexLogin") {
            $objIndex->indexUser();
            return true;
        }
		return false;
	}

	private function isInitSession() : bool
	{
		$timeout_duration = 31536000;
		if ( !isset($_SESSION) ) 
			session_start();
			//print_r($_SESSION);
		if ( isset($_SESSION["last_activity"]) && ((time() - $_SESSION["last_activity"]) > $timeout_duration) ) {
			session_unset();
			session_destroy();    
			return false;
		}	
		if ( !isset($_SESSION["idUsuario"]) || !isset($_SESSION["nameProfile{$this->suffix}"]) ) {
			return false;		
		} 
		$_SESSION["last_activity"] = time();
		return true;
	}

	private function isLogOut() : bool
	{
		if ( ucfirst($this->_endPoint) == "LogOut" ) {
			$nameClassController = ucfirst($this->_endPoint);
			$className = "controllers\\" . $nameClassController;
			$objController = new $className;
			$objController->exit();
			return true;
		}
		return false;
	}

	private function loaderPublicIndex()
	{
		if ( in_array($this->_profile, $this->_userProfiles) ) {
			return false;
		}

		if ( $this->_profile == "user" && $this->_endPoint == "init")  {
			$className = "controllers\\" . $this->_endPoint;
			$objController = new $className;
			$getPageProfile = "index" . ucfirst($this->_profile);;
			$objController->$getPageProfile($this->_endPoint);                        
			return true;
		}		
		if ( $this->_profile !== "indexLogin" )  {
			$className = "controllers\\" . $this->_profile;
			$objController = new $className;
			$getPageProfile = "indexPublic";
			$objController->$getPageProfile($this->_profile);                        
			return true;
		}
		if ( $this->_profile !== "indexAdminLogin" )  {
			$className = "controllers\\" . $this->_profile;
			$objController = new $className;
			$getPageProfile = "indexPublic";
			$objController->$getPageProfile($this->_profile);                        
			return true;
		}
		return false;
	}

	private function loaderIndexSession() : bool
	{
		if ( $_SESSION["nameProfile{$this->suffix}"] == strtolower($this->_profile) && $this->_profile != "indexLogin" ) {
			// if looged user init sessión, then check and established type username (admin,user,...)
			foreach ($this->_userProfiles as $key => $profile) {
				if (strtolower($_SESSION["nameProfile{$this->suffix}"]) == $profile) {
					$className = "controllers\\" . $this->_endPoint;
					$objController = new $className;
					$fileNameView = $this->_endPoint;
					$getPageProfile = "index" . ucfirst($profile);
					$objController->$getPageProfile($fileNameView);                        
					break;
				}
			}
			return true;
		}
		return false;
	}

    public function run()
    {
		$this->getRoutes();

        if ( !$this->loadFileController() ) {
			$error = new Error;
			$error->getMessage();
            exit();
		}

		if ( $this->isIndex() ) {
			return;
		}

		if ( $this->loaderPublicIndex() ) {
			return;
		}

		if ( !$this->isInitSession() ) {
			$error = new Error;
			$error->getMessageExpiredSession();
			exit();
		}

		if ( $this->isLogOut() ) {
			return;
		}

		if ( !$this->loaderIndexSession() ) {
 			$error = new Error;
			$error->getMessage();
			exit();
		}
    }	

}

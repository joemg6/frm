<?php

namespace controllers;

use bootstrap\Controller;
use models\Login;

require_once 'vendor/autoload.php';

class Index extends Controller
{
	private $_PDO;

	public function __construct() 
	{
		parent::__construct();
        $db = \Database::getInstance();
        $this->_PDO = $db->getConnection();
	}

	private function loginInit()
	{
        foreach($_POST as $k => $v) {
            if (is_string($_POST))
                $_POST[$k] = $this->_PDO->quote($v);
        }
		$usern = isset($_POST['usern']) ? $_POST['usern'] : NULL;
		$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : NULL;
		$typeProfile = isset($_POST['typeProfile']) ? $_POST['typeProfile'] : NULL;
		
		$user = new Login();
		$user->loginUser($usern, $passwd, $typeProfile);

		$this->_PDO->close();
	}

	public function indexAdmin()
	{
		if ( $this->handlerRequestPost() && $this->requestType == '_index' ) {
			$this->loginInit();
            return;
		}		
		$this->view->render('admin/index');
    }

	public function indexUser()
	{
		if ( $this->handlerRequestPost() && $this->requestType == '_index' ) {
			$this->loginInit();
            return;
		}		
		$this->view->render('index');
	}	

}

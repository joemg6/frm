<?php

namespace controllers;

use bootstrap\Controller;

require_once 'models/Session.php';

use models\Session;

class LogOut extends Controller
{
    private Session $objSession;
    private $idProfile;

	public function __construct()
    {
		parent::__construct();
	}

	public function getIdprofile()
    {
       $sessionIdProfile = $_SESSION['idProfile' . SUFFIX];
       switch ($sessionIdProfile) {
           case 1:
               $this->idProfile = './../admin/';
               break;
           case 2:
               $this->idProfile = './../';
               break;
           default:
               $this->idProfile = './';
       }
       return $this->idProfile;
    }
	
	public function exit()
	{
		$this->view->render( PATH_RESOURCE_VIEW . '/log_out', ['redirectTo' => $this->getIdprofile()] );
        $this->objSession = new Session();
        $this->objSession->startSession();
        $this->objSession->destroySession();
	}

}
<?php

/**
 *
 * @package Main FRM
 * @since 1.0
 */

namespace controllers;

require_once 'vendor/autoload.php';

use bootstrap\Controller;

class System extends Controller 
{
	private $_mysqli;

	public function __construct() 
	{
		parent::__construct();
		$this->_mysqli = \Database::getInstance()->getConnection();
	}

    public function indexAdmin($fileNameView)
    {
        $this->view->render(PATH_RESOURCE_VIEW . '/admin/' . $fileNameView);
    }

	public function indexUser($fileNameView)
	{
		$this->view->render(PATH_RESOURCE_VIEW . '/user/' . $fileNameView);

	}	

}
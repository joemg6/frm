<?php
/**
 *
 * @package Main FRM
 * @since 1.0
 */

namespace controllers;

use bootstrap\Controller;

class Init extends Controller
{

	public function __construct()
    {
		parent::__construct();
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
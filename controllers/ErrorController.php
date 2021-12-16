<?php

namespace controllers;

use bootstrap\Controller;

class ErrorController extends Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->view->render('error');
	}
}
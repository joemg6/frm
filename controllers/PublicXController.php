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

class PublicX extends Controller
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function indexPublic($fileNameView)
	{
		if ( $this->handlerRequestPost() ) {

			if ($this->requestType == '_add' && $this->handlerRequestCSRF() == true) {
				$this->addTest();
				header("location: Test?msn=added");
			}

			if ($this->requestType == '_edit') {
				$this->upTest();
                header("location: Test?msn=updated");
			}

			if ($this->isAJX() && $this->requestType == "_del") {
                $this->delTest();
                //echo " DONE " . $this->requestType ."<br>";
            }
            return;
		}

		$this->view->render(  PATH_RESOURCE_VIEW . '/public/' . $fileNameView);
	}	


}
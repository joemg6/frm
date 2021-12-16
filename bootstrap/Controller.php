<?php
/**
 *
 * @package Main SIRED
 * @since 1.0
 */

declare(strict_types=1);

namespace bootstrap;

Abstract class Controller
{

	public View $view;

    protected string $requestType;

	public function __construct() 
	{
		$this->view = new View();
	}

	public function handlerRequestPost() : bool
    {
        if (isset($_POST["_method"])) {
            $request_types = array('_set', '_add', '_store', '_edit', '_delete', '_del', '_index');
            foreach($request_types as $value) {
                if ($_POST["_method"] == $value) {
                    $this->requestType = $value;
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public function handlerRequestCSRF() : bool
    {
        if ( isset($_POST["csrf_token"]) && $this->handlerRequestPost() == true ) {
            if ( $_POST["csrf_token"] == $_SESSION['csrf_token'] ) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function isAJX() : bool
    {
        if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') )
            return true;
        return false;
    }

}
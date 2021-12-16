<?php
/**
 *
 * @package Main SIRED
 * @since 1.0
 */

namespace Models;

class Session
{
	
	public function __construct(){ }
	
	public function startSession()
	{
		@session_start();
	}
	
	public function setValueSession($sessionName, $value)
	{		
		$_SESSION[$sessionName] = $value;	
	}
	
	public function destroySession()
	{
		session_unset();
		session_destroy();
	}
	
}


<?php

/**
 *
 * @package Main FRM
 * @since 1.0
 */

include_once "main/pathDefault.php";

@session_start();

$suffix = SUFFIX;

if ( empty($_SESSION["loginUsuario"]) || empty($_SESSION["idProfile{$suffix}"]) ) {
	header("Location: ../"); exit();
}



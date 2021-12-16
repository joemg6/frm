<?php
/**
 *
 * @package FRM
 * @since 1.0
 */

include_once 'class/RequestUri.php';

header ("Content-type: text/html; charset=utf-8");
@session_start();

	$linkCookie = RequestUri::getRequestUrl();
	$linkCookie = explode('=', $linkCookie);
	$linkCookie = end($linkCookie);
	if ($linkCookie != 'init') {
		setcookie('url_link', $linkCookie);
	}

?>
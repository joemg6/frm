<?php
/**
 *
 * @package Main FRM
 * @since 1.0
 */

declare(strict_types=1);

/* if ($_SERVER["SERVER_PORT"] != 443) {
    $redir = "Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header($redir);
    exit();
} */

ini_set('session.name','PHPSESSID' . strtoupper("_frm"));
ini_set("session.save_path", "/var/www/html/sessions");
ini_set("session.gc_maxlifetime", "31536000");
ini_set("session.cookie_lifetime", "31536000");
ini_set("session.cache_expire", "31536000");

spl_autoload_register(function ($class) {
    $className = explode('\\', $class);
	if (file_exists("bootstrap/". $className[1] . '.php')) {
		include "bootstrap/". $className[1] . '.php';
	}
});

use bootstrap\App;

$url = $_GET['url'] ??  NULL ;
$app = new App($url);
$app->run();

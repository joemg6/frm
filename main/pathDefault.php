<?php

if (!defined('PATH_INDEX')) define('PATH_INDEX', substr(__DIR__, 0, -4));
if (!defined('PATH_MODELS')) define('PATH_MODELS', '../models');
if (!defined('PATH_CONTROLLERS')) define('PATH_CONTROLLERS', '../controllers');
if (!defined('PATH_RESOURCE_VIEW')) define('PATH_RESOURCE_VIEW', '../resources/view');

if (!defined('SUFFIX')) define('SUFFIX', '_frm');

//if (!defined('DIRECTORY_STORAGE')) define('DIRECTORY_STORAGE', '/public/reportes/');
if (!defined('DIRECTORY_STORAGE')) define('DIRECTORY_STORAGE', '/storage/');
if (!defined('OPERACIONES_DIRECTORY_NAME')) define('OPERACIONES_DIRECTORY_NAME', 'reportes');

if (!defined('ID_PRODUCTO_OPERACIONES_DB')) define('ID_PRODUCTO_OPERACIONES_DB', '1');

/*ini_set('session.name','PHPSESSID' . strtoupper(SUFFIX));
ini_set("session.save_path", "/var/www/html/sessions"); 
ini_set("session.gc_maxlifetime", "31536000"); 
ini_set("session.cookie_lifetime", "31536000");
ini_set("session.cache_expire", "31536000");*/

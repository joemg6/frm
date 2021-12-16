<?php
/**
 *
 * @package Main SIRED
 * @since 1.0
 */

/**
 * [app route description]
 * @param  [type] $url[1] - URL endpoint
 * @param  [type] $endPointRoute - Call Controller ($endPoint + Controller) and FileName View
 * @return [type]       [require file view]
 */

	$routes = array();
	$routes[] = lcfirst('init');
	$routes[] = lcfirst('system');
	$routes[] = lcfirst('sismos');
	$routes[] = lcfirst('logOut');


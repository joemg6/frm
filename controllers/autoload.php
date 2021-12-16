<?php 
/**
 *
 * @package Main PaymenTIK
 * @since 1.0
 */

spl_autoload_register('autoload');
function autoload($classname) {
  $namespace = explode("\\" , $classname)[0];
  if ($namespace == 'models') {
    $classname = str_replace ('\\', '/', $classname);
    $filename = $classname .".php";
    require $filename;
  }
}

 ?>
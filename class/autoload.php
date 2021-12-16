<?php 

    spl_autoload_register(function ($className) {
      if (file_exists("class/". $className . '.php')) {
        include "class/". $className . '.php';
      }        
    });

 ?>
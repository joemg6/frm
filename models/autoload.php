<?php 

    spl_autoload_register(function ($className) {
      if (file_exists("models/". $className . '.php')) {
        include "models/". $className . '.php';
      }        
    });

 ?>
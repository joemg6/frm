<?php

class RequestUri
{
	public static function getRequestUrl()
    {
		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : NULL;  
		if ($url != NULL) {	
			$loc = $_SERVER['REQUEST_URI'];
			$loc = explode('/', $loc);
			$loc = end($loc); 
			return $loc; 
		}
		return null;
	}

	public static function checkGetValue($getName)
    {
        if (array_key_exists($getName, $_GET)) {
            return $_GET["{$getName}"];
        } else {
            header('location: /');
            echo "<script>window.location = './'</script>";
        }
    }

}




<?php

namespace bootstrap;

class Error
{

    public function __construct()
    {

    }

    public function getMessage()
    {
		$title = 'Error';
		$description = 'Error, esta página no está disponible';
		echo sprintf(
			"<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" .
			"<meta name='viewport' content='width=device-width, initial-scale=1.0'>" .
			"<title>%s</title>" . 
			"<style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana," .
			"sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{" .
			"display:inline-block;width:65px;}</style></head>" .
			"<body><h1>%s</h1></body>" .
			"-> <a href='/'>Ir a Página principal <i class='fa fa-chevron-right'></i></a>" .
			"</html>",
			$title,
			$description
		);
    }

    public function getMessageExpiredSession()
    {
		$title = 'Session Expired';
		$description = 'Su Sesión Expiró';
		echo sprintf(
			"<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" .
			"<meta name='viewport' content='width=device-width, initial-scale=1.0'>" .
			"<title>%s</title>" . 
			"<style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}
			h1{margin:0;font-size:32px;font-weight:normal;line-height:48px;}
			strong{display:inline-block;width:65px;}
			a{color:#fff;text-decoration:none}
			button{  background-color: #0062cc;
			background-image: none;
			border: 1px solid #005cbf;
			border-radius: .3rem;
			box-sizing: border-box;
			color: #fff;
			cursor: pointer;
			display: inline-block;
			font-size: 1.25rem;
			font-weight: 400;
			line-height: 1.5;
			padding: .5rem 1rem;
			text-align: center;
			text-decoration: none;
			transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
			user-select: none;
			vertical-align: middle;
			white-space: nowrap;}
			</style></head>" .
			"<body><h1>%s</h1><br><hr><br>" .
			"<button><a href='/'> Ir a Página principal <i class='fa fa-chevron-right'></i></a></button>" .
			"</body></html>" .
			"<script>
			setTimeout('location.href= \"../\" ', 300000);
			</script>",
			$title,
			$description
		);		
    }
}
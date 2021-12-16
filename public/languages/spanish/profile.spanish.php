<?php

	global $txt;
	$txt['limit_file_upload'] = ' (Recomendable no superar 4MB)';
	$txt['nivel_de_emergencia'] = array('NIVEL 1', 'NIVEL 2', 'NIVEL 3', 'NIVEL 4');
	//Modulo Operaciones
	$txt['tipo_reporte_operaciones'] = array(
		'RP' => 'REPORTE PRELIMINAR',
		'RC' => 'REPORTE COMPLEMENTARIO',
		'RCA' => 'REPORTE COMPLEMENTARIO ATENDIDO',
		'RPI' => 'REPORTE DE PELIGRO INMINENTE',				
		'RS' => 'REPORTE DE SITUACIÓN',
		'RF' => 'REPORTE FINAL');
	//Modulo Monitoreo y Análisis
	$txt['tipo_reporte_mAnalisis'] = array(
		'AM' => 'AVISO METEOROLÓGICO',
		'AO' => 'AVISO OCEANOGRAFICO',
		'AFC' => 'AVISO DE FOCOD DE CALOR',
		'AZC' => 'AVISO DE ZONAS CRÍTICAS',
		'AER' => 'AVISO DE ESCENARIOS DE RIESGO',
		'RS' => 'REPORTE DE SISMOS',
		'RP' => 'REPORTE DE PUERTOS',
		'RH' => 'REPORTE DE HIDROMÉTRICO',
		'BT' => 'BOLETINES');
	$txt['instituciones_t_cientificas'] = array('SENAMHI', 'IGP', 'INGEMMET', 'DHN', 'CENEPRED', 'SERFOR', 'CONIDA', 'ENFEN');
	
	$lang = "es";

	$listMont = array("","Ene.","Feb.","Marzo","Abril","Mayo","Junio","Julio","Ago.","Sept","Oct.","Nov.","Dic.");
	$listWeek = array("","Mon"=>"Lunes","Tue"=>"Martes","Wed"=>"Miércoles","Thu"=>"Jueves","Fri"=>"Viernes","Sat"=>"Sábado","Sun"=>"Domingo");

	$mysqlErr ="No se pudo establecer conexi&oacute;n con la Base de Datos.";
	
  
?>
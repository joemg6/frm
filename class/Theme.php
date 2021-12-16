<?php

/**
 *
 * @package FRM
 * @since 1.0
 */

Abstract class Theme
{
    /**
     * Retrieve root directory.
     * @return string Path root app directory.
     */
    public static function get_root_directory()
    {
        return './';
    }

    /**
     * Retrieve public directory.
     * @return string Path to current public directory.
     */
    public static function get_public_directory()
    {
        return '../public';
    }

    /**
     * Retrieve vendor directory.
     * @return string Path to current vendor directory.
     */
    public static function get_vendor_directory()
    {
        return '../vendor';
    }

	    /**
     * Retrieve chart directory.
     * @return string Path to current chart directory.
     */
    public static function get_chart_directory()
    {
        return '../chart';
    }

    /**
     * Retrieve template in public directory.
     * @return string Path to current template in public directory.
     */
    public static function get_template_directory()
    {
        return './public/template';
    }

    public static function get_head_profile()
    {
        @session_start();
        $templateDirectory = self::get_template_directory();
        $rootDirectory = self::get_root_directory();
        $deflang = "";
		include $rootDirectory . "main/auth.php";
		include $rootDirectory . "main/checkCookie.php";
		include $rootDirectory . "main/settings.php";

		include $rootDirectory . "/public/languages/$deflang/profile.$deflang.php";

		include_once $templateDirectory . '/above.php';
		include $templateDirectory . '/u_sidebar.php';
		include $templateDirectory . '/u_top_nav.php';
    }

    public static function get_head_admin_profile()
    {
        @session_start();
        $templateDirectory = self::get_template_directory();
        $rootDirectory = self::get_root_directory();
		include $rootDirectory . "main/auth.php";
		include $rootDirectory . "main/checkCookie.php";
		include $rootDirectory . "main/settings.php";

		include_once $templateDirectory . '/above.php';
		include $templateDirectory . '/a_sidebar.php';
		include $templateDirectory . '/a_top_nav.php';
    }

	public static function get_dependecies_js_inbody() 
	{
		return '
		<script type="text/javascript" language="javascript" src="' . Theme::get_public_directory() . '/js/jquery-2.2.4.min"></script>

		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/managerContent.ajx.js?v=0.1"></script>

		<script src="' . Theme::get_public_directory() . '/js/notify.js?v=0.1"></script>

		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/buttons.flash.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/buttons.html5.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/buttons.print.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/buttons.colVis.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/pdfmake.min.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/vfs_fonts.js"></script>
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/datatables/jszip.min.js"></script>
		
		<script type="text/javascript" src="' . Theme::get_public_directory() . '/js/DateFormat.min.js"></script>
		';			
	}

	public static function get_dependecies_css_inbody() 
	{
		return '	
		<link rel="stylesheet" type="text/css" href="' . Theme::get_public_directory() . '/css/datatables/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="' . Theme::get_public_directory() . '/css/datatables/buttons.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="' . Theme::get_public_directory() . '/css/datatables/custom.dataTables.css">		
		';
	}	
}


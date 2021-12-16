<?php
/**
*
* @package Main PaymenTIK
* @since 1.0
*/

error_reporting(0);

function dir_path() {
    define('ROOTPATH', $_SERVER["DOCUMENT_ROOT"]);
    return ROOTPATH;
}

function get_view_link() {
    define( 'PATH_DIR_URL', '../public');
    return PATH_DIR_URL;
}

function get_path_gl() {
    define( 'PATH_DIR_GL', 'public/');
    return PATH_DIR_GL;
}

function get_path_vendor() {
    define( 'PATH_DIR_VENDOR', '../vendor');
    return PATH_DIR_VENDOR;
}

function get_path_controllers() {
    define( 'PATH_DIR_CONTROLLER', '../controllers');
    return PATH_DIR_CONTROLLER;
}

function get_path_models() {
    define( 'PATH_DIR_CONTROLLER', '../models');
    return PATH_DIR_CONTROLLER;
}

function get_path_req() {
    define( 'PATH_REQ', '../controllers/req/' );
    return PATH_REQ;
}

function get_rp_path() {
    define( 'RP_PATH', dir_path() );
    return RP_PATH;
}

////////////////

function get_path_view() {
    define( 'PATH_VIEW', '../resources/view/' );
    return PATH_VIEW;
}
function get_path_view_admin() {
    define( 'PATH_VIEW', '../resources/view/admin/' );
    return PATH_VIEW;
}
function get_path_view_user() {
    define( 'PATH_VIEW', '../resources/view/user/' );
    return PATH_VIEW;
}
function get_path_view_assistant() {
    define( 'PATH_VIEW', '../resources/view/assistant/' );
    return PATH_VIEW;
}

function accessProfile($value) {
    session_start();
    $profile = $_SESSION['idProfile' . SUFFIX];
    /*  if ( $profile != $value ) {
    header('location: ./' . $profile . '/Error');
    }*/
    if ($profile == 1) {
        $dir = 'public';
        include_once $dir . '/global/above.php';
        include $dir . '/global/a_sidebar.php';
        include $dir . '/global/top_nav.php';
    }
}



/**
 * Get value $_GET from url
 * @var $getName: GetName URl
 */
/*function checkGetValue($getName)
{
    if (array_key_exists($getName, $_GET)) {
        return $_GET["{$getName}"];
    } else {
        header('location: /');
        echo "<script>window.location = './'</script>";
    }
}*/

/**
 * Get source and script Datables
 */

function mem_total() {
    exec("free -m", $output);
    $str = trim($output[1]);
    $str = preg_replace("/\s(?=\s)/", "", $str);
    $str = preg_replace("/[\n\r\t]/", " ", $str);
    $ram = explode(" ", $str);
    $str = trim($output[3]);
    $str = preg_replace("/\s(?=\s)/", "", $str);
    $str = preg_replace("/[\n\r\t]/", " ", $str);
    $swap = explode(" ", $str);
    
    $mem_tot = $ram[1]*1024*1024;
    return $mem_tot;
}

function arquitect() {
    $plat = exec("uname -m");
    if ($plat == "i686")
        $arquit = "(32 bits)";
    else{
        $arquit = "(64 bits)";
    }
    return $arquit;
}

function sizeTraf($traf){
    $sizetx = $traf;
    if ($sizetx < 1024) {
        return $sizetx . " Kbps";
    }
    else if ($sizetx < (1024*1024)) {
        $sizetx_r = round($sizetx/1024,2);
        return $sizetx_r . " Mbps";
    }
    else if ($sizetx < (1024*1024*1024)) {
        $sizetx_r = round($sizetx/(1024*1024),2);
        return $sizetx_r . " Gbps";
    }
    else if ($sizetx < (1024*1024*1024*1024)) {
        $sizetx_r = round($sizetx/(1024*1024*1024),2);
        return $sizetx_r . " Tbps";
    }
}

function trafEth($eth, $file_export){
    $n_eth = $eth;
    $file = $file_export;
    //exec("sudo ifstat -b | head -3 | grep -v 'eth0' | grep -v Kbps > $file");
    exec("sudo ifstat -b 0.8 1 | grep -v $n_eth | grep -v Kbps | xargs > $file");
    $r_file = file_get_contents($file);
    //$r_file = exec("cat $file");
    $r_file = trim($r_file);
    $l_file = explode(" ", $r_file);
    $txeth = sizeTraf($l_file[0]);
    $rxeth = sizeTraf(end($l_file));
    //$total = sizeTraf($l_file[0] + end($l_file));
    $t= '<span class="redstat_tx">TX: '.$txeth.'</span>';
    $t.= '<span class="redstat_rx">RX: '.$rxeth.'</span>';
    //$t.= "<span class=\"redstat_tt\">Total: $total</span>";
    return $t;
}

function sizeFormat($size){
    if($size < 1024)	{
        return $size." bytes";
    }
    else if($size < (1024*1024)) {
        $size=round($size/1024,2);
        return $size." KiB";
    }
    else if($size < (1024*1024*1024))	{
        $size=round($size/(1024*1024),2);
        return $size." MiB";
    }
    else if($size / (1024*1024*1024*1024))	{
        $size=round($size/(1024*1024*1024),2);
        return $size." GiB";
    } else	{
        $size=round($size/(1024*1024*1024*1024),2);
        return $size." TiB";
    }
}

function sizeFormatSQ($size){
    if($size < 1024)  {
        return $size." KiB";
    }
    else if($size < (1024*1024)) {
        $size=round($size/1024,2);
        return $size." MiB";
    }
    else if($size < (1024*1024*1024)) {
        $size=round($size/(1024*1024),2);
        return $size." GiB";
    }
    else {
        $size=round($size/(1024*1024*1024),2);
        return $size." TiB";
    }
}

function name_distri() {
    $distri = exec("lsb_release -d | awk '{print $2,$3,$4,$5}'");
    return $distri;
}

function proc() {
    exec("cat /proc/cpuinfo | grep \"model name\\|processor\"", $PROCESSA);
    $str1 = trim($PROCESSA[1]);
    $str1 = preg_replace("/\s(?=\s)/", "", $str1);
    $str1 = preg_replace("/[\n\r\t]/", " ", $str1);
    $str1 =  str_replace("model name : ", "", $str1);
    return $str1;
}

function num_proc() {
    $proc = exec("cat /proc/cpuinfo | grep processor | wc -l");
    return $proc;
}

function cpu_model() {
    $md = exec("cat /proc/cpuinfo | grep \"model name\" | head -n1");
    $md = substr($md, strpos($md, ":")+2, strlen($md));
    return "<b>".$md."</b>";
}

/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/

function num_eth() {
    $eth = shell_exec("sudo ifconfig -a -s | grep -Ee 'eth[0-9]' | awk {'print $1\" \"$2\" \"$3\" \"$4\" \"$5\" \"$6\" \"$7\" \"$8\" \"$9\" \"$10\" \"$11\" \"$12'}");
    $eth = explode("\n", $eth);
    for ($i=0; $i < count($eth); $i++) {
        $ethx = trim($eth[$i]);
        $iface = explode(" ", $ethx);
        if ($iface[0] != "") {
            echo "<option value='".$iface[0]."'>".$iface[0]."</option>";
        }
    }
}

function ip_dns_lo() {
    $file = "/etc/resolv.conf";
    $fileln = file($file);
    $url_log = "##-##";
    $pos = 0;
    foreach($fileln as $linea){
        if (strstr($linea,$url_log)){
            $row_ip_ch = $pos+1;
        }
        $pos++;
    }
    $l_url_log = file_get_contents($file);
    $l_url_log = explode("\n", $l_url_log);
    $l_url_log = $l_url_log[($row_ip_ch-1)];
    $l_url_log = explode(" ",$l_url_log);
    $ip_dns_c  = $l_url_log[1];
    return $ip_dns_c;
}

function test_cnx_db() {
    mysqli_connect("localhost","root","raptor","raptor");
    
    echo "<div class=\"test_db\">";
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    } else {
        print "Conection Raptor database OK";
    }
    echo "</div>";
}

function en_str($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_','.'),$data);
    return $data;
}

function de_str($string) {
    $data = str_replace(array('-','_','.'),array('+','/','='),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function del_line($file_in, $line_del) {
    $file = $file_in;
    $fileln = file($file);
    $line_seach = $line_del;
    $pos = 0;
    
    foreach( $fileln as $linea ) {
        if ( strstr($linea, $line_seach) ){
            $row=$pos+1;
        }
        else{
        }
        $pos++;
    }
    
    $content = file_get_contents($file);
    $lineas = explode("\n", $content);
    $newline2 = "";
    if ( $row != "" ) {
        file_put_contents($file, str_replace($lineas[($row-1)]."\n", $newline2, $content));
        return 1;
    }
    return 0;
}

function details_hd() {
    $name_grep_disk = exec("sudo fdisk -l | grep /dev/ | grep bytes | head -n1 | awk {'print $1'}");
    $count_disk = shell_exec("sudo fdisk -l | grep ".$name_grep_disk." | grep bytes | grep -Ee '/dev/sd[a-z]' | grep -v '/dev/dm-0' | grep -v '/dev/mapper/' | wc -l");
    $list_dev_disk = shell_exec("sudo fdisk -l /dev/sd? | grep ".$name_grep_disk." |grep bytes | awk '{print $2}' | sed -e 's/://g'");
    
    $dev_disk = explode("\n", $list_dev_disk);
    
    for ($i=0; $i <$count_disk ; $i++) {
        $name_disk = explode("/dev/", $dev_disk[$i]);
        $name_sdx_disk = $name_disk[1];
        
        $dsk = shell_exec("sudo smartctl -A ".trim($dev_disk[$i])." | grep -v 'build' | grep -v 'Copyright' | grep -v '===' ");
        
        return "<pre>/dev/".$name_sdx_disk.$dsk."</pre>";
    }
}

function search_string($open_file, $string_search) {
    $file = $open_file;
    $fileln = file($file);
    $pos = 0;
    foreach($fileln as $linea) {
        if (strstr($linea, $string_search)){
            $num_row = $pos + 1;
        }
        $pos++;
    }
    $content = file_get_contents($file);
    $arr_lines = explode("\n", $content);
    $line_string = $arr_lines[($num_row - 1)];
    $quit     = array('$', ';');
    $line_string = str_replace($quit, "", $line_string);
    return array('num_row' => $num_row, 'string' => $line_string);
}

function value_directive($open_file, $string_search) {
    $file = $open_file;
    $fileln = file($file);
    $pos = 0;
    foreach($fileln as $linea) {
        if (strstr($linea, $string_search)){
            $num_row = $pos + 1;
        }
        $pos++;
    }
    $content = file_get_contents($file);
    $arr_lines = explode("\n", $content);
    $line_string = $arr_lines[($num_row - 1)];
    $value = explode(" ", $line_string);
    $value = $value[1];
    
    return $value;
}

function getValueHd($open_file, $string_search, $selector) {
    $file = $open_file;
    $fileln = file($file);
    $pos = 0;
    foreach($fileln as $linea) {
        if (strstr($linea, $string_search)){
            $num_row = $pos + 1;
        }
        $pos++;
    }
    $content = file_get_contents($file);
    $arr_lines = explode("\n", $content);
    $line_string = $arr_lines[($num_row - 1)];
    $value = explode($selector, $line_string);
    
    return $value;
}

/**
* [str_replace_once - remplace only first result]
* @param  [type] $search  [string to search]
* @param  [type] $replace [string that is replaced]
* @param  [type] $subject [file content "file_get_contents($file)"]
* @return [type]          [all stringsb with replace new string]
*/

function str_replace_once($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos === false) {
        return $subject;
    }
    return substr($subject, 0, $pos) . $replace . substr($subject, $pos + strlen($search));
}

function str_replace_last_once($search, $replace, $subject) {
    $pos = strrpos($subject, $search);
    if ($pos === false) {
        return $subject;
    }
    return substr($subject, 0, $pos) . $replace . substr($subject, $pos + strlen($search));
}

/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/

function del_void_line($file) {
    $stat_file = "";
    $result = "";
    $fileln      = file($file);
    foreach ($fileln as $line) {
        if(substr($line, 0,8) == "\n") {
            $stat_file = true;
            continue;
        } else {
            $result .= $line;
        }
    }
    file_put_contents($file, $result);
    if ($stat_file == true) {
        return 1;
    } else {
        return 0;
    }
}

function up_line($file, $string_search_up) {
    $fileln = file($file);
    
    $pos = 0;
    foreach ($fileln as $linea) {
        if (strstr($linea, $string_search_up)) {
            $pos_check_regex = $pos + 1;
        }
        $pos++;
    }
    $content_check = file_get_contents($file);
    $row_ckeck   = explode("\n", $content_check);
    $line_above = $row_ckeck[($pos_check_regex-2)]."\n";
    $line_above = trim($line_above);
    
    if (ereg("^[a-zA-Z0-9\-_#]{1,10}", $line_above)) {
        //Add new line(tmp) below
        $content1       = file_get_contents($file);
        $row_regex      = explode("\n", $content1);
        $new_line_regex = $row_regex[($pos_check_regex-1)]."\n".$line_above;
        file_put_contents($file, str_replace($row_regex[($pos_check_regex-2)], $new_line_regex, $content1));
        //Delele line_above
        $content2     = file_get_contents($file);
        $row_delete   = explode("\n", $content2);
        if ($line_above != "" ) {
            file_put_contents($file, str_replace_last_once($row_delete[($pos_check_regex)]."\n", "", $content2));
        }
        return 1;
    } else {
        return 0;
    }
}

function down_line($file, $string_search_up) {
    $fileln = file($file);
    
    if (del_void_line($file)) {
        return;
    }
    
    $pos = 0;
    foreach ($fileln as $linea) {
        if (strstr($linea, $string_search_up)) {
            $pos_check_regex = $pos + 1;
        }
        $pos++;
    }
    $content_check = file_get_contents($file);
    $row_ckeck   = explode("\n", $content_check);
    $line_above = $row_ckeck[($pos_check_regex)]."\n";
    
    $line_above = trim($line_above);
    
    if (ereg("^[a-zA-Z0-9\-_#]{1,10}", $line_above)) {
        //Add two lines in line_down(reversed)
        $content1 = file_get_contents($file);
        $row_regex   = explode("\n", $content1);
        $new_line_regex = $row_regex[($pos_check_regex)]."\n".$row_regex[($pos_check_regex-1)];
        file_put_contents($file, str_replace($row_regex[($pos_check_regex-1)], $new_line_regex, $content1));
        //Delele line rule_below
        $content2     = file_get_contents($file);
        $row_delete   = explode("\n", $content2);
        if ($line_above != "" ) {
            file_put_contents($file, str_replace_last_once($row_delete[($pos_check_regex+1)]."\n", "", $content2));
            return 1;
        } else {
            return 0;
        }
    }
}

function del_rule_line($file, $name_rule) {
    $delRule = $name_rule;
    $fileln  = file($file);
    
    $pos = 0;
    foreach ( $fileln as $linea ) {
        if ( strstr($linea, $delRule) ) {
            $row = $pos + 1;
        }
        $pos++;
    }
    
    $content = file_get_contents($file);
    $row_regex    = explode("\n", $content);
    if ( $name_rule != "" ) {
        $newline = "";
        file_put_contents($file, str_replace($row_regex[($row-1)]."\n", $newline, $content));
        return 1;
    } else {
        return 0;
    }
}

function change_rule_state($file, $rule_name) {
    $rule_name_on = $rule_name;
    
    $fileln = file($file);
    
    $pos = 0;
    foreach ( $fileln as $linea ) {
        if ( strstr($linea, $rule_name_on) ) {
            $row = $pos+1;
        }
        $pos++;
    }
    $content = file_get_contents($file);
    $row_regex    = explode("\n", $content);
    
    $row_regex = $row_regex[($row-1)];
    
    $line_stat = substr($row_regex,0,5);
    
    if ( $line_stat == "##-##" ) {
        //enabled rule
        $line_on  = explode("##-##", $row_regex);
        $line_on      = $line_on[1];
        file_put_contents($file, str_replace($row_regex, $line_on, $content));
        return 1;
    }
    else if ( $line_stat != "##-##" ) {
        //disabled rule
        $line_off     = "##-##".$row_regex;
        file_put_contents($file, str_replace($row_regex, $line_off, $content));
        return 1;
    } else {
        return 0;
    }
}

define( 'RP_PATH', dir_path() );

?>
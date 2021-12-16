<?php

require "../class/Database.php";
require "../models/DBProcess.php";

$PDO = "";
$PDO = \Database::getInstance()->getConnection();
$obj = new \models\DBProcess($PDO);
print_r($obj->getRowValuesDB("sismos", 'idSismos', 46));
echo "DONE";

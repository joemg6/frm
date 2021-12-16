<?php
/**
 *
 * @package Main FRM
 * @since 1.0
 */

class Database 
{
	private $_connection;
	private static $_instance; //The single instance
	private string $_host;
	private string $_username;
	private string $_password;
	private string $_database;

	public static function getInstance() 
	{
		if (!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() 
	{
        require 'configDB.php';
        $this->_host = $DBHOST;
        $this->_database = $DBNAME;
        $this->_username = $DBUSER;
        $this->_password = $DBPASS;
        try {
            $this->_connection = new \PDO("mysql:host={$DBHOST};dbname={$DBNAME}", $DBUSER, $DBPASS);
            $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_connection->setAttribute(\PDO::ATTR_PERSISTENT,true);
            $this->_connection->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        } catch (\PDOException $e) {
            echo '<b><h1>Connection Error</h1></b> ';
            echo '<hr>';
            echo E_USER_ERROR . PHP_EOL;
            echo $e->getMessage();
            exit();
        }
    }

	private function __clone() { }

	public function getConnection() 
	{
		return $this->_connection;
	}

	public function closePDO()
	{
		return $this->_connection = NULL;
	}

}


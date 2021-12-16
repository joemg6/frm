<?php
/**
 *
 * @package Main FRM
 * @since 1.0
 */

/**
 * Logger class
 * Singleton using lazy instantiation
 */

class Logger
{
    private static $instance;
    private $_PDO;

    private function __construct() 
	{		
		$this->_PDO = \Database::getInstance()->getConnection();
    }

    /**
     * Gets instance of the Logger
     * @return Logger instance
     * @access public
     */
    public static function getInstance() 
	{
        if(!self::$instance) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    /**
     * Adds a message to the Actionlog
     * @param String $message Message to be logged
     * @access public
     */
    public function setActionMessage($log_type, $log_action, $log_board, $log_description, $userName) 
	{
		$sql = "INSERT INTO `log_actions` (`log_type`, `log_date`, `log_action`, `log_board`, `log_description`, `userName`) 
                VALUES (?, NOW(), ?, ?, ?, ?)";
		if ( !($stmt = $this->_PDO->prepare($sql)) ) {
			return false;
		}
        $stmt->bindParam(1, $log_type, \PDO::PARAM_INT);
        $stmt->bindParam(2, $log_action, \PDO::PARAM_STR);
        $stmt->bindParam(3, $log_board, \PDO::PARAM_STR);
        $stmt->bindParam(4, $log_description, \PDO::PARAM_STR);
        $stmt->bindParam(5, $userName, \PDO::PARAM_STR);
		if ( !$stmt->execute() ) {
			return false;
		}
        $this->_PDO = NULL;
		return true;
    }

};
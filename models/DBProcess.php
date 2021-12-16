<?php 
/**
 *
 * @package Main FRM
 * @since 1.0
 */

namespace models;

class DBProcess 
{
	protected $_PDO;

	public function __construct($dbConnection)
	{
		$this->_PDO = $dbConnection;
	}

	public function insertValue($table, $arrPost)
	{
		$keys = array();
		$values = array();
		foreach ($arrPost as $key => $value) {
			$keys[] = '$' . $key;			
			$values[] = $value;
		}

		$columnsName = implode(',', $keys);
		$rowValue = implode(',', $values);

		$insert = "INSERT INTO " . $table . " (" . $columnsName . ") VALUES (" . $rowValue . ");";
		$this->_PDO->query($insert);
		$this->_PDO = NULL;
	}

	public function getRowValuesDB($table, $campoWhere, $idSearch) : array
	{
        $results = array();
        $sql = "SELECT * FROM $table WHERE $campoWhere = :idSearch";
        $stmt = $this->_PDO->prepare($sql);
        $stmt->bindParam(':idSearch', $idSearch, \PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
            $results = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->_PDO = NULL;
		return $results;
	}

	public function getAllRows($table, $rowId, $rowName) : array
	{
		$sql = "SELECT * FROM $table;";
		$query = $this->_PDO->query($sql);
		$arr = array();
	    while ( $row = $query->fetch(\PDO::FETCH_ASSOC) ) {
			$arr[$row[$rowId]] = $row[$rowName];
		}
		return $arr;
	}

	public function getAllRowsGroupBy($table, $rowId, $rowName) : array
	{
		$sql = "SELECT $rowId, $rowName FROM $table GROUP BY $rowName;";
		$query = $this->_PDO->query($sql);
        $rows = $query->fetchAll();
		$arr = array();
	    foreach ( $rows as $row ) {
			$arr[$row[$rowId]] = $row[$rowName];
		}
		return $arr;	
	}

	public function getCountRowsTable($table) : int
	{
		$sql = "SELECT * FROM $table";
		$query = $this->_PDO->query($sql);
        $num = $query->rowCount();
		return $num;	
	}

}


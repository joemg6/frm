<?php
/**
 *
 * @package Main SIRED
 * @since 1.0
 */

declare(strict_types=1);

namespace bootstrap;

Abstract class Model
{

	protected $_PDO;
	protected $rows = array();
	protected $chartRows = array();
	
	abstract protected function insertRow(array $parameters);
	abstract protected function deleteRow($idRow);
	abstract protected function updateRow(array $parameters);
	abstract protected function getDataValues(array $requestDataValues);

}
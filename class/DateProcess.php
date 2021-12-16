<?php

class DateProcess
{

	/**
	 * Reorder format date -> Y-m-d to d-m-Y
	 */
	public function orderToSpa($date) : string
    {
		$initDate = explode("-", $date);
		$initDate = array($initDate[2], $initDate[1], $initDate[0]);
		$initDate = implode("-", $initDate);
		return $initDate;
	}

}

?>
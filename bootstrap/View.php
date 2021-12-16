<?php
/**
 *
 * @package Main PaymenTIK
 * @since 1.0
 */

namespace bootstrap;

class View
{
    private string $file;
/**
 * [render description]
 * @param  [type] $fileNameView [file view]
 * @return [type]       [require file view]
 */

	public function render(string $fileNameView, array $args1 = [], array $args2 = []) : bool
	{
        if (is_array($args1) && count($args1) > 0) {
            foreach ($args1 as $key => $value) {
                ${$key} = $value;
            }
        }
        if (is_array($args2) && count($args2) > 0) {
            foreach ($args2 as $key => $value) {
                ${$key} = $value;
            }
        }
        $this->file = 'public/' . $fileNameView . '.php';
        if (!file_exists($this->file)) {
            return false;
        }
		require_once $this->file;
        return true;
	}

}
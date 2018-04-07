<?php
if(function_exists('get_dirname'))
{
	
}
else
{
	function get_dirname($target) {
		$array = explode('/',$target);
		$count = count($array);
		return $array[$count-2];
	}
}
?>
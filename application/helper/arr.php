<?php
/**
 * 定义 Helper_Array 类
 *
 * @package helper
 */
/**
 * Helper_Array 类提供了一组简化数组操作的方法 
 *
 * @package helper
 */
class Helper_Arr extends Helper_Array
{
	/**
	 * 获取数组中的key值
	 *
	 * @param array		$arr
	 * @param string	$key
	 * @param mixed		$default
	 */
	static function get(& $arr, $key, $default = NULL)
	{
		return isset($arr[$key]) ? $arr[$key] : $default;
	}
}

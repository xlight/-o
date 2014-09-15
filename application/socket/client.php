<?php
/**
 * Socket Client
 *
 * @package		Socket
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
abstract class Socket_Client {

	public static $default = 'default';
	public static $instances = array();

	protected $config;
	
	public static function instance($group = NULL)
	{
		if ($group === NULL)
		{
			$group = self::$default;
		}

		if (isset(self::$instances[$group]))
		{
			return self::$instances[$group];
		}

		$config = OK::ini('socket/client');

		if ( ! array_key_exists($group, $config))
		{
			throw new Socket_Client_Exception('Failed to load Socket_Client config group: :group', array(':group' => $group));
		}

		$config 					= $config[$group];
		$client_class 				= 'Socket_Client_'.ucfirst($config['driver']);
		self::$instances[$group] 	= new $client_class($config);

		return self::$instances[$group];
	}

	protected function __construct(array $config)
	{
		$this->config = $config;
	}

}

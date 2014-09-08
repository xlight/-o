<?php
/**
 * Gearman Client
 *
 * @package		Gearman
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
abstract class Gearman_Client {

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

		$config = OK::ini('gearman_dsn_pool/client');

		if ( ! array_key_exists($group, $config))
		{
			throw new Gearman_Client_Exception('Failed to load Gearman_Client config group: :group', array(':group' => $group));
		}

		$config 					= $config[$group];
		$client_class 				= 'Gearman_Client_'.ucfirst($config['driver']);
		self::$instances[$group] 	= new $client_class($config);

		return self::$instances[$group];
	}

	protected function __construct(array $config)
	{
		$this->config = $config;
	}

}

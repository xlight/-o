<?php
/**
 * Gearman Worker
 *
 * @package		Gearman
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
abstract class Gearman_Worker {

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

		$config = OK::ini('gearman_dsn_pool/worker');

		if ( ! array_key_exists($group, $config))
		{
			throw new Gearman_Client_Exception('Failed to load Gearman_Worker config group: :group', array(':group' => $group));
		}

		$config 					= $config[$group];
		$worker_class 				= 'Gearman_Worker_'.ucfirst($config['driver']);
		self::$instances[$group] 	= new $worker_class($config);

		return self::$instances[$group];
	}

	protected function __construct(array $config)
	{
		$this->config = $config;
	}

	public function work()
	{
		$this->_work();
	}

	abstract protected function _work();

}

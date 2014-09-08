<?php
/**
 * Mongo - mongodb class
 *
 * @author		Artisan Gao <gaodch@okooo.net>
 * @version		$Id$
 */
class Mongo_Database {

	protected static $_instances;

	protected $_config;
	protected $_connection;
	protected $_db;

	public static function instance($name, $config = NULL)
	{
		if (self::$_instances[$name])
		{
			return self::$_instances[$name];
		}

		if (NULL === $config)
		{
			$config = OK::ini('mongo_dsn_pool/'.$name);
		}

		self::$_instances[$name] = new Mongo_Database($config);

		return self::$_instances[$name];
	}

	protected function __construct($config)
	{
		$this->_config = $config;

		$this->connect();
	}

	public function connect()
	{
		try
		{
			$this->_connection = new Mongo('mongodb://'.$this->_config['server']);
		}
		catch (MongoConnectionException $e)
		{
			$this->_connection = new Mongo('mongodb://'.$this->_config['server']);
		}

		$this->_db = $this->_connection->selectDB($this->_config['db']);
	}

	public function get_collection($collection)
	{
		if ($this->is_connect())
		{
			$collection = $this->_db->selectCollection($collection);
		}

		return $collection;

	}

	public function update($collection, $update, $options = array())
	{
		return $this->get_collection($collection)->upate($update, $options);
	}

	/**
	 * 判断MongoDB是否已经连接
	 * 没有连接自动重新连接，多用于长脚本中
	 *
	 * @param	boolean	$reconnect 是否重新连接
	 */
	public function is_connect($reconnect = TRUE)
	{
		if ( ! $this->_connection->connect())
		{
			if ( ! $reconnect)
			{
				return false;
			}
			else
			{
				$this->connect();
			}
		}

		return true;
	}
}

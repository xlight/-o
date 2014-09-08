<?php
/**
 * Gearman Client
 *
 * @package		Gearman
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
class Gearman_Client_Pecl extends Gearman_Client {

	protected $client;

	protected function __construct(array $config)
	{
		parent::__construct($config);

		$this->client = new GearmanClient();

		foreach ($this->config['servers'] as $server)
		{
			$server = explode(':', $server);
			$this->client->addServer($server[0], $server[1]);
		}
	}

	public function normal($function_name, $workload)
	{
		if (method_exists($this->client, 'doNormal'))
		{
			return $this->client->doNormal($function_name, $workload);
		}
		else
		{
			return $this->client->do($function_name, $workload);
		}
	}

	public function background($function_name, $workload)
	{
		return $this->client->doBackground($function_name, $workload);
	}	

	public function ping()
	{
		return $this->client->ping(true);
	}

	public function __call($method, $arguments)
	{
		if (method_exists($this->client, $method))
		{
			$callback = array($this->client, $method);

			if (is_array($arguments))
			{
				return call_user_func_array($callback, $arguments);	
			}
			else
			{
				return call_user_func($callback);
			}
		}
	}

}

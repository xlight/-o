<?php
/**
 * Gearman Worker
 *
 * @package		Gearman
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
class Gearman_Worker_Pecl extends Gearman_Worker {

	protected $worker;

	protected function __construct(array $config)
	{
		parent::__construct($config);

		$this->worker = new GearmanWorker();

		foreach ($this->config['servers'] as $server)
		{
			$server = explode(':', $server);
			$this->worker->addServer($server[0], $server[1]);
		}

		foreach ($this->config['functions'] as $function)
		{
			$instance = Gearman_Task::factory($function['callback'][0]);

			$callback = array($instance, $function['callback'][1]);

			$this->worker->addFunction($instance->function_name(), $callback, null, $function['timeout']);
		}
	}

	protected function _work()
	{
		while($this->worker->work());
	}

}

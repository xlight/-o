<?php
/**
 * Gearman Task
 *
 * @package		Gearman
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
abstract class Gearman_Task {

	protected $job;
	protected $workload;

	public static function factory($class)
	{
		return new $class;
	}

	public function __construct()
	{
	}

	public function work($job)
	{
		$this->job	= $job;
		$this->workload($job->workload());

		try
		{
			$result = $this->_work();
		}
		catch(Exception $e)
		{
			// NOTE:
			// ...
		}
		// 返回数据
		return $result;
	}

	public function workload($workload = FALSE)
	{
		if ($workload)
		{
			$this->workload = $workload;

			return TRUE;
		}
		else
		{
			return $this->workload;
		}
	}

	public function function_name()
	{
		return strtolower(Kohana::$environment.'_'.get_class($this));
	}

	protected function send_complete($content = NULL)
	{
		$this->job->sendComplete($content);

		/**
		$this->log->add(Kohana::INFO, 'GEARMAN: :function_name task completed successfully',
			array(
				':function_name' => $this->function_name()
			));
		**/

		return $this;
	}
}

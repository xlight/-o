<?php
/**
 * Pctrl Thread
 *
 * @package		Pctrl
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
class Pctrl_Thread {

	protected $_pid;

	protected function __construct()
	{
		// Use the factory method ...
	}

	public static function factory($callback, $arguments = NULL)
	{
		$thread = new Pctrl_Thread;

		$thread->run($callback, $arguments);

		return $thread;
	}

	protected function run($callback, $arguments = NULL)
	{
		$pid = pcntl_fork();

		if ($pid == -1)
		{
			throw new Exception('could not fork');
		}
		else if ($pid)
		{
			// Inside the partent
			$this->_pid = $pid;
		}
		else
		{
			// Inside the child
			Pctrl_Signal::install();

			if (is_array($arguments))
			{
				call_user_func_array($callback, $arguments);	
			}
			else
			{
				call_user_func($callback);
			}
			// Important !!!!!!!!!!!!!!!!!!
			exit;
		}
	}

	public function get_pid()
	{
		return $this->_pid;
	}

	public function is_running()
	{
		// WNOHANG 如果没有子进程退出立刻返回
		$pid = pcntl_waitpid($this->_pid, $status, WNOHANG);

		return ($pid === 0);
	}

	public function kill($signal = SIGKILL, $block = FALSE)
	{
		//if ($this->is_running())
		if (true)
		{
			posix_kill($this->_pid, $signal);

			if ($block)
			{
				pcntl_waitpid($this->_pid);
			}
		}
	}

}

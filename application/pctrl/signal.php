<?php
/**
 * Pctrl Signal
 *
 * @package		Pctrl
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
class Pctrl_Signal {

	public static $signal;

	public static function install()
	{
		declare(ticks = 1);

		pcntl_signal(SIGTERM,	array('Pctrl_Signal', 'handle'));
		pcntl_signal(SIGHUP,	array('Pctrl_Signal', 'handle'));
		pcntl_signal(SIGUSR1,	array('Pctrl_Signal', 'handle'));
		pcntl_signal(SIGUSR2,	array('Pctrl_Signal', 'handle'));

	}

	public static function handle($signal)
	{
		self::$signal = $signal;
	}
}

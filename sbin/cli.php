<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define('WWWROOT_PATH', dirname(dirname(__FILE__)));
require_once APPLICATION_PATH . '/bootstrap.php';
Bootstrap::instance();

class_exists('Minion_Task') OR die('Please enable the Minion module for CLI support.');

Minion_Task::factory(Minion_CLI::options())->execute();

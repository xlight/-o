<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Gearman Client
 *
 * @package		Gearman
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
class Gearman_Client_Pear extends Gearman_Client {

	protected $client;

	protected function __construct(array $config)
	{
		parent::__construct($config);

		$this->client = new Net_Gearman_Client($config['servers']);
	}

}

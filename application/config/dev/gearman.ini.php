<?php
return array(
		'client'	=> array(
			'default'	=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.8.223:20043'	=> '192.168.8.223:20043',
					),
				),
			),
		'worker'	=> array(
			'default'	=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.8.223:20043'	=> '192.168.8.223:20043',
					),
				'functions'	=> array(
					'Route'		=> array(
						'callback'		=> array('Task_Route', 'work'),
						'timeout'		=> 0,
						),
					),
				),
			),
		);

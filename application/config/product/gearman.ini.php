<?php
return array(
		'client'	=> array(
			'default'	=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.10.61:4732'	=> '192.168.10.61:4732',
					),
				),
			),
		'worker'	=> array(
			'default'	=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.12.25'	=> '192.168.12.25:4732',
					'192.168.12.26'	=> '192.168.12.26:4732',
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

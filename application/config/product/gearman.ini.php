<?php
return array(
		//array('host' => '192.168.12.25','port' => '4732'),
		//array('host' => '192.168.12.26','port' => '4732'),
		'client'	=> array(
			'default'	=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.12.25'	=> '192.168.12.25:4732',
					'192.168.12.26'	=> '192.168.12.26:4732',
					),
				),
			'pecl'		=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.12.25'	=> '192.168.12.25:4732',
					'192.168.12.26'	=> '192.168.12.26:4732',
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
					'Clean'		=> array(
						'callback'		=> array('Task_Blackhole', 'work'),
						'timeout'		=> 0,
						),
					'Route'		=> array(
						'callback'		=> array('Task_Route', 'work'),
						'timeout'		=> 0,
						),
					),
				),
			// 匹配专用
			'find'		=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.12.25'		=> '192.168.12.25:4732',
					'192.168.12.26'		=> '192.168.12.26:4732',
					//'192.168.10.181'	=> '192.168.10.181:4730',
					),
				'functions'	=> array(
					'Front10'	=> array(
						'callback'		=> array('Task_Front10', 'work'),
						'timeout'		=> 0,
						),
					),
				),
			// 抓取专用
			'snatch'	=> array(
				'driver'	=> 'pecl',
				'servers'	=> array(
					'192.168.12.25'	=> '192.168.12.25:4732',
					'192.168.12.26'	=> '192.168.12.26:4732',
					),
				'functions'	=> array(
					'Front11'	=> array(
						'callback'		=> array('Task_Front11', 'work'),
						'timeout'		=> 0,
						),
					),
				),
			),
		);

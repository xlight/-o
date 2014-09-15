<?php
return array(
		'client'	=> array(
			'livescore'	=> array(
				'driver'	=> 'zmq',
				'server'	=> 'tcp://192.168.8.144:7777',
				'topic'		=> 'broadcast',
				),
			),
		);

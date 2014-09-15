<?php
/**
 * Socket Client
 *
 * @package		Socket
 * @author 		Artisan Gao
 * @copyright	(c) 2014 Artisan Gao
 */
class Socket_Client_Zmq extends Socket_Client {

	/**
     * socket连接对象
     *
     * @var ZMQSocket
     */
    protected $_socket = NULL;

	protected function __construct(array $config)
	{
		parent::__construct($config);

		$this->_socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_PUB);

		$this->_socket->connect($this->config['server']);

	}

	public function send_topic($message)
	{
		$this->_socket->send($this->config['topic'], ZMQ::MODE_SNDMORE);

        $this->_socket->send($message);	
	}

}

<?php
namespace Illuminate\Mail\Transport;

use Swift_Transport;
use GuzzleHttp\Client;
use Swift_Mime_Message;
use Swift_Events_EventListener;

class MandrillTransport implements Swift_Transport
{

	/**
	 * The Mandrill API key.
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * Create a new Mandrill transport instance.
	 *
	 * @param string $key        	
	 * @return void
	 */
	public function __construct($key)
	{
		$this->key = $key;
	}

	/**
	 * @ERROR!!!
	 */
	public function isStarted()
	{
		return true;
	}

	/**
	 * @ERROR!!!
	 */
	public function start()
	{
		return true;
	}

	/**
	 * @ERROR!!!
	 */
	public function stop()
	{
		return true;
	}

	/**
	 * @ERROR!!!
	 */
	public function send(Swift_Mime_Message $message, &$failedRecipients = null)
	{
		$client = $this->getHttpClient();
		
		$client->post('https://mandrillapp.com/api/1.0/messages/send-raw.json', [
			'body' => [
				'key' => $this->key,
				'raw_message' => (string) $message,
				'async' => false
			]
		]);
	}

	/**
	 * @ERROR!!!
	 */
	public function registerPlugin(Swift_Events_EventListener $plugin)
	{
		//
	}

	/**
	 * Get a new HTTP client instance.
	 *
	 * @return \GuzzleHttp\Client
	 */
	protected function getHttpClient()
	{
		return new Client();
	}

	/**
	 * Get the API key being used by the transport.
	 *
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Set the API key being used by the transport.
	 *
	 * @param string $key        	
	 * @return void
	 */
	public function setKey($key)
	{
		return $this->key = $key;
	}
}

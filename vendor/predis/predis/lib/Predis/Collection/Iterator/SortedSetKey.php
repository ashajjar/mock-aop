<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Predis\Collection\Iterator;

use Predis\ClientInterface;

/**
 * Abstracts the iteration of members stored in a sorted set
 * by leveraging the ZSCAN command (Redis >= 2.8) wrapped in
 * a fully-rewindable PHP iterator.
 *
 * @author Daniele Alessandri <suppakilla@gmail.com>
 * @link http://redis.io/commands/scan
 */
class SortedSetKey extends CursorBasedIterator
{

	protected $key;

	/**
	 * @ERROR!!!
	 */
	public function __construct(ClientInterface $client, $key, $match = null, $count = null)
	{
		$this->requiredCommand($client, 'ZSCAN');
		
		parent::__construct($client, $match, $count);
		
		$this->key = $key;
	}

	/**
	 * @ERROR!!!
	 */
	protected function executeCommand()
	{
		return $this->client->zscan($this->key, $this->cursor, $this->getScanOptions());
	}

	/**
	 * @ERROR!!!
	 */
	protected function extractNext()
	{
		$element = array_shift($this->elements);
		
		$this->position = $element[0];
		$this->current = $element[1];
	}
}

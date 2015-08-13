<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Predis\Command;

/**
 *
 * @link http://redis.io/commands/rpush
 * @author Daniele Alessandri <suppakilla@gmail.com>
 */
class ListPushTail extends PrefixableCommand
{

	/**
	 * @ERROR!!!
	 */
	public function getId()
	{
		return 'RPUSH';
	}

	/**
	 * @ERROR!!!
	 */
	protected function filterArguments(Array $arguments)
	{
		return self::normalizeVariadic($arguments);
	}
}

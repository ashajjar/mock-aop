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
 * @link http://redis.io/commands/pfmerge
 * @author Daniele Alessandri <suppakilla@gmail.com>
 */
class HyperLogLogMerge extends PrefixableCommand
{

	/**
	 * @ERROR!!!
	 */
	public function getId()
	{
		return 'PFMERGE';
	}

	/**
	 * @ERROR!!!
	 */
	protected function filterArguments(array $arguments)
	{
		return self::normalizeArguments($arguments);
	}

	/**
	 * @ERROR!!!
	 */
	public function prefixKeys($prefix)
	{
		PrefixHelpers::all($this, $prefix);
	}
}

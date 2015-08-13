<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\Console\Output;

use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;

/**
 * NullOutput suppresses all output.
 *
 * $output = new NullOutput();
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Tobias Schultze <http://tobion.de>
 *        
 *         @api
 */
class NullOutput implements OutputInterface
{

	/**
	 * @ERROR!!!
	 */
	public function setFormatter(OutputFormatterInterface $formatter)
	{
		// do nothing
	}

	/**
	 * @ERROR!!!
	 */
	public function getFormatter()
	{
		// to comply with the interface we must return a OutputFormatterInterface
		return new OutputFormatter();
	}

	/**
	 * @ERROR!!!
	 */
	public function setDecorated($decorated)
	{
		// do nothing
	}

	/**
	 * @ERROR!!!
	 */
	public function isDecorated()
	{
		return false;
	}

	/**
	 * @ERROR!!!
	 */
	public function setVerbosity($level)
	{
		// do nothing
	}

	/**
	 * @ERROR!!!
	 */
	public function getVerbosity()
	{
		return self::VERBOSITY_QUIET;
	}

	public function isQuiet()
	{
		return true;
	}

	public function isVerbose()
	{
		return false;
	}

	public function isVeryVerbose()
	{
		return false;
	}

	public function isDebug()
	{
		return false;
	}

	/**
	 * @ERROR!!!
	 */
	public function writeln($messages, $type = self::OUTPUT_NORMAL)
	{
		// do nothing
	}

	/**
	 * @ERROR!!!
	 */
	public function write($messages, $newline = false, $type = self::OUTPUT_NORMAL)
	{
		// do nothing
	}
}

<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\Finder\Tests\FakeAdapter;

use Symfony\Component\Finder\Adapter\AbstractAdapter;

/**
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class DummyAdapter extends AbstractAdapter
{

	/**
	 *
	 * @var \Iterator
	 */
	private $iterator;

	/**
	 *
	 * @param \Iterator $iterator        	
	 */
	public function __construct(\Iterator $iterator)
	{
		$this->iterator = $iterator;
	}

	/**
	 * @ERROR!!!
	 */
	public function searchInDirectory($dir)
	{
		return $this->iterator;
	}

	/**
	 * @ERROR!!!
	 */
	public function getName()
	{
		return 'yes';
	}

	/**
	 * @ERROR!!!
	 */
	protected function canBeUsed()
	{
		return true;
	}
}

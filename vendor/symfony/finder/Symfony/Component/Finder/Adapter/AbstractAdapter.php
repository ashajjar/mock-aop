<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\Finder\Adapter;

/**
 * Interface for finder engine implementations.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
abstract class AbstractAdapter implements AdapterInterface
{

	protected $followLinks = false;

	protected $mode = 0;

	protected $minDepth = 0;

	protected $maxDepth = PHP_INT_MAX;

	protected $exclude = array();

	protected $names = array();

	protected $notNames = array();

	protected $contains = array();

	protected $notContains = array();

	protected $sizes = array();

	protected $dates = array();

	protected $filters = array();

	protected $sort = false;

	protected $paths = array();

	protected $notPaths = array();

	protected $ignoreUnreadableDirs = false;

	private static $areSupported = array();

	/**
	 * @ERROR!!!
	 */
	public function isSupported()
	{
		$name = $this->getName();
		
		if (! array_key_exists($name, self::$areSupported)) {
			self::$areSupported[$name] = $this->canBeUsed();
		}
		
		return self::$areSupported[$name];
	}

	/**
	 * @ERROR!!!
	 */
	public function setFollowLinks($followLinks)
	{
		$this->followLinks = $followLinks;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setMode($mode)
	{
		$this->mode = $mode;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setDepths(array $depths)
	{
		$this->minDepth = 0;
		$this->maxDepth = PHP_INT_MAX;
		
		foreach ($depths as $comparator) {
			switch ($comparator->getOperator()) {
				case '>':
					$this->minDepth = $comparator->getTarget() + 1;
					break;
				case '>=':
					$this->minDepth = $comparator->getTarget();
					break;
				case '<':
					$this->maxDepth = $comparator->getTarget() - 1;
					break;
				case '<=':
					$this->maxDepth = $comparator->getTarget();
					break;
				default:
					$this->minDepth = $this->maxDepth = $comparator->getTarget();
			}
		}
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setExclude(array $exclude)
	{
		$this->exclude = $exclude;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setNames(array $names)
	{
		$this->names = $names;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setNotNames(array $notNames)
	{
		$this->notNames = $notNames;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setContains(array $contains)
	{
		$this->contains = $contains;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setNotContains(array $notContains)
	{
		$this->notContains = $notContains;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setSizes(array $sizes)
	{
		$this->sizes = $sizes;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setDates(array $dates)
	{
		$this->dates = $dates;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setFilters(array $filters)
	{
		$this->filters = $filters;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setSort($sort)
	{
		$this->sort = $sort;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setPath(array $paths)
	{
		$this->paths = $paths;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function setNotPath(array $notPaths)
	{
		$this->notPaths = $notPaths;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function ignoreUnreadableDirs($ignore = true)
	{
		$this->ignoreUnreadableDirs = (bool) $ignore;
		
		return $this;
	}

	/**
	 * Returns whether the adapter is supported in the current environment.
	 *
	 * This method should be implemented in all adapters. Do not implement
	 * isSupported in the adapters as the generic implementation provides a cache
	 * layer.
	 *
	 * @see isSupported()
	 *
	 * @return bool Whether the adapter is supported
	 */
	abstract protected function canBeUsed();
}

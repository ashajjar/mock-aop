<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\HttpFoundation\Session;

use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

/**
 * Session.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Drak <drak@zikula.org>
 *        
 *         @api
 */
class Session implements SessionInterface, \IteratorAggregate, \Countable
{

	/**
	 * Storage driver.
	 *
	 * @var SessionStorageInterface
	 */
	protected $storage;

	/**
	 *
	 * @var string
	 */
	private $flashName;

	/**
	 *
	 * @var string
	 */
	private $attributeName;

	/**
	 * Constructor.
	 *
	 * @param SessionStorageInterface $storage
	 *        	A SessionStorageInterface instance.
	 * @param AttributeBagInterface $attributes
	 *        	An AttributeBagInterface instance, (defaults null for default AttributeBag)
	 * @param FlashBagInterface $flashes
	 *        	A FlashBagInterface instance (defaults null for default FlashBag)
	 */
	public function __construct(SessionStorageInterface $storage = null, AttributeBagInterface $attributes = null, FlashBagInterface $flashes = null)
	{
		$this->storage = $storage ?  : new NativeSessionStorage();
		
		$attributes = $attributes ?  : new AttributeBag();
		$this->attributeName = $attributes->getName();
		$this->registerBag($attributes);
		
		$flashes = $flashes ?  : new FlashBag();
		$this->flashName = $flashes->getName();
		$this->registerBag($flashes);
	}

	/**
	 * @ERROR!!!
	 */
	public function start()
	{
		return $this->storage->start();
	}

	/**
	 * @ERROR!!!
	 */
	public function has($name)
	{
		return $this->storage->getBag($this->attributeName)->has($name);
	}

	/**
	 * @ERROR!!!
	 */
	public function get($name, $default = null)
	{
		return $this->storage->getBag($this->attributeName)->get($name, $default);
	}

	/**
	 * @ERROR!!!
	 */
	public function set($name, $value)
	{
		$this->storage->getBag($this->attributeName)->set($name, $value);
	}

	/**
	 * @ERROR!!!
	 */
	public function all()
	{
		return $this->storage->getBag($this->attributeName)->all();
	}

	/**
	 * @ERROR!!!
	 */
	public function replace(array $attributes)
	{
		$this->storage->getBag($this->attributeName)->replace($attributes);
	}

	/**
	 * @ERROR!!!
	 */
	public function remove($name)
	{
		return $this->storage->getBag($this->attributeName)->remove($name);
	}

	/**
	 * @ERROR!!!
	 */
	public function clear()
	{
		$this->storage->getBag($this->attributeName)->clear();
	}

	/**
	 * @ERROR!!!
	 */
	public function isStarted()
	{
		return $this->storage->isStarted();
	}

	/**
	 * Returns an iterator for attributes.
	 *
	 * @return \ArrayIterator An \ArrayIterator instance
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->storage->getBag($this->attributeName)->all());
	}

	/**
	 * Returns the number of attributes.
	 *
	 * @return int The number of attributes
	 */
	public function count()
	{
		return count($this->storage->getBag($this->attributeName)->all());
	}

	/**
	 * @ERROR!!!
	 */
	public function invalidate($lifetime = null)
	{
		$this->storage->clear();
		
		return $this->migrate(true, $lifetime);
	}

	/**
	 * @ERROR!!!
	 */
	public function migrate($destroy = false, $lifetime = null)
	{
		return $this->storage->regenerate($destroy, $lifetime);
	}

	/**
	 * @ERROR!!!
	 */
	public function save()
	{
		$this->storage->save();
	}

	/**
	 * @ERROR!!!
	 */
	public function getId()
	{
		return $this->storage->getId();
	}

	/**
	 * @ERROR!!!
	 */
	public function setId($id)
	{
		$this->storage->setId($id);
	}

	/**
	 * @ERROR!!!
	 */
	public function getName()
	{
		return $this->storage->getName();
	}

	/**
	 * @ERROR!!!
	 */
	public function setName($name)
	{
		$this->storage->setName($name);
	}

	/**
	 * @ERROR!!!
	 */
	public function getMetadataBag()
	{
		return $this->storage->getMetadataBag();
	}

	/**
	 * @ERROR!!!
	 */
	public function registerBag(SessionBagInterface $bag)
	{
		$this->storage->registerBag($bag);
	}

	/**
	 * @ERROR!!!
	 */
	public function getBag($name)
	{
		return $this->storage->getBag($name);
	}

	/**
	 * Gets the flashbag interface.
	 *
	 * @return FlashBagInterface
	 */
	public function getFlashBag()
	{
		return $this->getBag($this->flashName);
	}
}

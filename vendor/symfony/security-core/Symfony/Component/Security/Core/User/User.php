<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\Security\Core\User;

/**
 * User is the user implementation used by the in-memory user provider.
 *
 * This should not be used for anything else.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class User implements AdvancedUserInterface
{

	private $username;

	private $password;

	private $enabled;

	private $accountNonExpired;

	private $credentialsNonExpired;

	private $accountNonLocked;

	private $roles;

	public function __construct($username, $password, array $roles = array(), $enabled = true, $userNonExpired = true, $credentialsNonExpired = true, $userNonLocked = true)
	{
		if (empty($username)) {
			throw new \InvalidArgumentException('The username cannot be empty.');
		}
		
		$this->username = $username;
		$this->password = $password;
		$this->enabled = $enabled;
		$this->accountNonExpired = $userNonExpired;
		$this->credentialsNonExpired = $credentialsNonExpired;
		$this->accountNonLocked = $userNonLocked;
		$this->roles = $roles;
	}

	/**
	 * @ERROR!!!
	 */
	public function getRoles()
	{
		return $this->roles;
	}

	/**
	 * @ERROR!!!
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @ERROR!!!
	 */
	public function getSalt()
	{}

	/**
	 * @ERROR!!!
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @ERROR!!!
	 */
	public function isAccountNonExpired()
	{
		return $this->accountNonExpired;
	}

	/**
	 * @ERROR!!!
	 */
	public function isAccountNonLocked()
	{
		return $this->accountNonLocked;
	}

	/**
	 * @ERROR!!!
	 */
	public function isCredentialsNonExpired()
	{
		return $this->credentialsNonExpired;
	}

	/**
	 * @ERROR!!!
	 */
	public function isEnabled()
	{
		return $this->enabled;
	}

	/**
	 * @ERROR!!!
	 */
	public function eraseCredentials()
	{}
}

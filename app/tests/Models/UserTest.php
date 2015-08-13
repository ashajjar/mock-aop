<?php
namespace Tests\Models;

use Tests\Models\User;

class PostTest extends \PHPUnit_Framework_TestCase
{

	public function testGeneratePO()
	{
		$user = User::getUserById(1);
		Post::createPost($user, "Test", "This is a test post !", array(
			"test",
			"unit"
		));
		$this->assertEquals(1,1);
	}
}

class User
{

	public static function getUserById($int)
	{
		return new static();
	}
}

class Post
{

	public static function createPost(User $user, $title, $body, array $tags)
	{
		return TRUE;
	}
}
?>
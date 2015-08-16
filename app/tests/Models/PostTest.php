<?php
namespace Tests\Models;

use Helpers\AopTestUtils;
use Helpers\AopMocker;
use Models\Post;

class PostTest extends \TestCase
{

	public $user_sample = '{
		"_id" : "55d03b592e82abf6180041a7",
		"name" : "Ahmad Hajjar",
		"email" : "abc1234@gmail.com",
		"password" : "$2y$10$qURei/MZi5h0JA.y.ZTPBuDSi9aUETm3EmBoHXY58xRZ1ewmX83Pu",
		"updated_at" : "2015-08-16T07:27:21.206Z",
		"created_at" : "2015-08-16T07:27:21.206Z"
	}';

	public function testCreatePost()
	{
		$obj = json_decode($this->user_sample);
		// Casts a stdObject to the type passed in the second argument
		$user = AopTestUtils::cast($obj, 'Models\User');
		
		// when post->save() is invoked return true
		AopMocker::mock('Models\Post', 'save', true);
		// when User::getUser() is called the sample user will be returned
		AopMocker::mock('Models\User', 'getUser', $user);
		
		$result = Post::createPost($user->_id, "Test", "This is a test post !", array(
			"test",
			"unit"
		));
		$this->assertTrue($result >= 0);
	}
}

?>
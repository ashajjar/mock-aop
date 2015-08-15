<?php
namespace Tests\Models;

use Models\User;
use Helpers\AopMocker;

class UserTest extends \TestCase
{

	public function testCreateUser()
	{
		AopMocker::mock("Models\\User", "save", true);
		
		$res=User::createUser(array(
			'name' => 'Ahmad Hajjar',
			'email' => 'ash852006@gmail.com',
			'password' => '12345678'
		));
		
		$this->assertNotFalse($res);
	}
}
?>
<?php
namespace Controllers;

use Models\User;
use \MongoId;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * This class is the Controller class for the Users model.
 *
 * @author Ahmad Hajjar
 */
class UserController extends Controller
{

	public function showAllUsers()
	{
		$page = Input::get('page', 0);
		$offset = Input::get('offset', 50);
		
		$start = $page * $offset;
		
		$users = User::getAllUsers($start, $offset);
		return Response::make($users, 200);
	}

	public function addUser()
	{
		$input['email'] = Input::get('email');
		$input['name'] = Input::get('name');
		$input['password'] = Input::get('password');
		
		$rules = array(
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:8',

		);
		$validator = Validator::make($input, $rules);
		
		if ($validator->fails()) {
			return Response::make($validator->messages(), 400);
		}
		
		$res = User::createUser($input);
		
		if (MongoId::isValid($res)) {
			return Response::make(array("_id"=>$res), 200);
		} else {
			return Response::make("failed to add user", 500);
		}
	}
}

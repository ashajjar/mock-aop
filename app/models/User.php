<?php
namespace Models;

use \MongoId;
use Jenssegers\Mongodb\Model;
use Illuminate\Support\Facades\Hash;
use Traits\MockableModel;
/**
 * This class represents a blog user
 *
 * @property string $email User's E-Mail address.
 * @property string $name The name to be displayed for the user.
 * @property string $password the hashed form of this user's password.
 *          
 * @author Ahmad Hajjar
 */
class User extends Model
{
	use MockableModel;
	
	/**
	 * The mongodb collection to be used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'users';

	/**
	 * Get a user by MongoID
	 *
	 * @param MongoID $id        	
	 * @return User: A user
	 */
	public static function getUser($id)
	{
		return User::find(new MongoId($id));
	}

	/**
	 * Create new user.
	 *
	 * @param Array $data
	 *        	an array containing the following fields :<pre>
	 *        	name
	 *        	email
	 *        	password
	 *        	</pre>
	 * @return MongoId of the user if it was successfully created, false otherwise.
	 */
	public static function createUser(array $data)
	{
		$user = new User();
		$user->name = $data['name'];
		$user->email = $data['email'];
		$user->password = Hash::make($data['password']);
		return ($user->save()) ? $user->_id : false;
	}

	/**
	 * Update the given user.
	 *
	 * @param Users $user
	 *        	The user to update
	 * @param array $data
	 *        	an array that contains the following fields :<pre>
	 *        	name
	 *        	email
	 *        	password
	 *        	</pre>
	 * @return boolean true if there is nothing to update or updating was done successfully, false otherwise.
	 *        
	 */
	public static function updateUser(User $user, $data = array())
	{
		if (! $user instanceof User)
			return false;
		
		$needsUpdate = false;
		
		if (isset($data['name'])) {
			$user->display_name = $data['display_name'];
			$needsUpdate = true;
		}
		
		if (isset($data['password'])) {
			$user->password = Hash::make($data['password']);
			$needsUpdate = true;
		}
		
		if ($needsUpdate) {
			return $user->save();
		} else {
			return true;
		}
	}

	/**
	 * Delete the specified user
	 *
	 * @param
	 *        	MongoId user's $id
	 * @return boolean true if the user was deleted, false otherwise.
	 */
	public static function deleteUser($id)
	{
		$user = User::find($id);
		if (! ($user instanceof User)) {
			return false;
		}
		
		return $user->delete();
	}

	/**
	 * Get a paginated list of users
	 *
	 * @param integer $start
	 *        	How many users to skip
	 * @param integer $offset
	 *        	How many users to get
	 * @param string $order_by
	 *        	Field name to sort by
	 * @param string $order
	 *        	order direction desc or asc
	 * @return Collection of users
	 */
	public static function getAllUsers($start, $offset, $order_by = "_id", $order = "asc")
	{
		return User::take($offset)->skip($start)
			->orderBy($order_by, $order)
			->get();
	}

	/**
	 * Gets a user by the given E-Mail address
	 *
	 * @param String $email        	
	 * @return Users the user with the given email
	 */
	public static function getUserByEmail($email)
	{
		return User::where("email", "=", $email)->first();
	}
}

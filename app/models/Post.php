<?php
namespace Models;

use Jenssegers\Mongodb\Model;
use Traits\MockableModel;

class Post extends Model
{
	use MockableModel;

	public static function createPost($user_id, $title, $body, array $tags)
	{
		$user = User::getUser($user_id);
		if (! $user instanceof User) {
			return - 1; // User does not exist
		}
		if ($title == "") {
			return - 2;
		}
		if (count($tags) < 2) {
			return - 3;
		}
		$post = new Post();
		$post->title = $title;
		$post->tags = $tags;
		$post->body = $body;
		$post->creator = $user;
		if ($post->save())
			return 0;
		else
			return - 3;
	}
}
?>
<?php
namespace Tests\Models;

use Jenssegers\Mongodb\Model;

class Post extends Model
{

	public static function createPost(User $user, $title, $body, array $tags)
	{
		if ($title == "") {
			return - 1;
		}
		if (count($tags) < 2) {
			return - 2;
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

class User
{
}
?>
<?php
class User extends Eloquent
{
	public static $timestamps = true; // so laravel auto inserts created/updated data

	public function user_profile()
	{
		return $this->has_one('User_Profile');
	}

	public function user_avatar()
	{
		return $this->has_one('Avatar');
	}

	/*public function friends()
	{
		return $this->has_many_and_belongs_to('User', 'relationships', 'followed_id', 'follower_id');
	}

	public function enemies()
	{
		return $this->has_many_and_belongs_to('User', 'relationships', 'follower_id', 'followed_id');
	}*/
}
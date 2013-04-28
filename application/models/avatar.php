<?php
class Avatar extends Eloquent
{
	public static $timestamps = true;
	public static $table = 'avatars';

	public function user()
	{
		return $this->belongs_to('User');
	}
}
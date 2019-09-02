<?php

/**
* Manages admin user data and session.
*/

class userModel extends BaseModel implements ModelInterface
{
	public $id;

	private $table = 'users';

	# Checks for login session and validates it.
	public function loggedIn()
	{
		$id = Session::get('id');

		if($this->validateUserId($id))
		{
			$this->id = $id;
			return true;
		}

		return false;
	}

	# Validates the session ID with database information.
	public function validateUserId($id)
	{
		return $this->db->fetchOne('id', $this->table, array('id'=>$id));
	}

	# Validates the email+password combination.
	public function validateLogin($email, $password)
	{
		return $this->db->fetchOne('id', $this->table, array('email'=>$email, 'password'=>$this->encryptPassword($password)));
	}

	# Log in, create session.
	public function logIn($id)
	{
		Session::set('id', $id);
	}

	# Can have more security, not aim in this assignment.
	private function encryptPassword($password)
	{
		return sha1($password);
	}

	# Destroy session, logout.
	public function logOut()
	{
		Session::destroy();
	}
}
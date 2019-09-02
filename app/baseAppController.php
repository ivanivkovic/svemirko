<?php

# First line parent to application controllers, to load boring data or do frequent checkups for most page loads.
# Optional, is not mandatory for MVC.

class BaseAppController extends BaseController implements ControllerInterface
{
	protected $user;			# Guest model data
	protected $messages;		# Messages for success / error messages

	public function __construct($route, $db)
	{
		parent::__construct($route, $db);
		$this->user = new userModel($this->db);
	}

	# Ads a message for success/failure messages
	protected function addMessage($type, $message)
	{
		$entry = [
			'type' => $type,
			'message' => $message
		];

		$this->messages[] = $entry;
	}

	/**
	*
	* Check for login.
	* If the user is logged in, deny him the login page / redirect to a default controller.
	* If the user is not logged in, redirect 
	* Run only on pages which demand login
	*
	* @param string | $redirect - customizes the redirect for the logged out guest if needed 
	*/

	protected function checkLogin($redirect = '')
	{
		if($redirect == '')
		{
			$redirect = 'login';
		}

		# Deny the logged out user to visit anything but the login or $redirect page
		if(!$this->user->loggedIn())
		{
			if($this->controller != 'login')
			{
				$this->redirect(BASE_PATH . $redirect);
			}
		}
		else
		{
			# Deny the logged in guest to visit the login site.
			if($this->controller === 'login')
			{
				$this->redirect(BASE_PATH . DEFAULT_CONTROLLER);
			}
		}
	}
}
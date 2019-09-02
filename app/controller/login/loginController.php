<?php 

class loginController extends baseAppController implements ControllerInterface
{
	# Login site
	public function index()
	{
		$this->checkLogin();

		# Login functionality
		if(!empty($this->post_fields))
		{
			if(libForm::contains($this->post_fields, array('email', 'password')))
			{
				if($user_id = $this->user->validateLogin($this->post_fields['email'], $this->post_fields['password']))
				{
					$this->user->logIn($user_id);
					$this->redirect(BASE_PATH . DEFAULT_CONTROLLER);
				}
				else
				{
					$this->addMessage('danger', 'Login unsuccessful. Your email or password are incorrect.');
				}
			}
			else
			{
				$this->addMessage('danger', 'Login unsuccessful. Please check your data or contact technical support.');
			}
		}

		# Show login page
		$data['title'] = 'svemirko | log in';

		$this->addTpl('header-login');
		$this->addTpl('messages');
		$this->addView('login');
		$this->addTpl('footer');

		$this->runHTML($data);
	}
}
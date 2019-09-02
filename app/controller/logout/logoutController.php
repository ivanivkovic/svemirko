<?php 

class logoutController extends baseAppController implements ControllerInterface
{
	public function index()
	{
		$this->user->logOut();
		$this->redirect(BASE_PATH);
	}
}
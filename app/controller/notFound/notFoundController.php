<?php

class notFoundController extends baseAppController implements ControllerInterface
{
	public function index()
	{
		$data['title'] = 'svemirko | 404 - Page Not Found';

		$this->addHTTPStatusCode('404');

		$this->addTpl('header');
		$this->addView('404');
		$this->addTpl('footer');

		$this->runHTML($data);
	}
}
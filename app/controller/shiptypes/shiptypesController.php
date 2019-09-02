<?php

class shipTypesController extends baseAppController implements ControllerInterface
{
	public function index()
	{
		$this->checkLogin();

		$ships = new shipModel($this->db);

		$data['title'] = 'svemirko | ship type management';

		# Initate data for breadcrumbs
		$data['breadcrumbs'] = [
			['title' => 'Home', 'link' => ''],
			['title' => 'Ship Type Management Log']
		];

		# Prepare page specific Javascript
		$data['js'][] = 'scripts.js';

		# Cities list for the search form
		$data['ship_types'] = $ships->getTypes();

		# Prepare views
		$this->addTpl('header');
		$this->addTpl('breadcrumbs');
		$this->addTpl('messages');
		$this->addView('insert-form');
		$this->addView('search-results');
		$this->addTpl('footer');

		# Output
		$this->runHTML($data);
	}

	public function insert()
	{
		$this->checkLogin();

		if(!empty($this->post_fields))
		{
			if(libForm::contains($this->post_fields, array('name')))
			{
				$ship = new shipModel($this->db);

				if($insert_id = $ship->insert($this->post_fields))
				{
					$this->addMessage('success', 'You have successfully added a ship type.');
				}
				else
				{
					$this->addMessage('danger', 'Insert unsuccessful. Please contact customer support.');
				}
			}
			else
			{
				$this->addMessage('danger', 'Insert unsuccessful. Please check your data or contact technical support.');
			}
		}

		$this->index();
	}

	public function delete()
	{
		$this->checkLogin();

		if(!empty($this->params) && $this->params[0] > 0)
		{
			$ship = new shipModel($this->db);

			if($ship->deleteShipType($this->params[0]))
			{
				$this->addMessage('success', 'You have successfully deleted a ship type entry.');
			}
			else
			{
				$this->addMessage('danger', 'Deletion unsuccessful. Please contact customer support.');
			}
			
		}
		else
		{
			$this->addMessage('danger', 'Deletion unsuccessful. Please check your data or contact technical support.');
		}

		$this->index();
	}
}
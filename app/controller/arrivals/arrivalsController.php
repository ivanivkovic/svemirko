<?php

class arrivalsController extends baseAppController implements ControllerInterface
{
	# Home page, displays AJAX search form 
	public function index()
	{
		$this->checkLogin();

		$ships = new shipModel($this->db);

		$data['title'] = 'svemirko | arrival log';

		# Initate data for breadcrumbs
		$data['breadcrumbs'] = [
			['title' => 'Home', 'link' => ''],
			['title' => 'Ship Arrival Log']
		];

		# Prepare page specific Javascript
		$data['js'][] = 'scripts.js';
		$data['js'][] = 'arrivals.js';

		# Cities list for the search form
		$data['ship_types'] = $ships->getTypes();

		# Prepare views
		$this->addTpl('header');
		$this->addTpl('breadcrumbs');
		$this->addTpl('messages');

		$this->addView('insert-form');
		$this->addView('search-form');
		
		$this->addTpl('footer');

		# Output
		$this->runHTML($data);
	}

	# Insert arrival entry
	public function insert()
	{
		$this->checkLogin();

		if(!empty($this->post_fields))
		{
			if(libForm::contains($this->post_fields, array('type_id', 'name')))
			{
				$arrivals = new arrivalModel($this->db);

				if($insert_id = $arrivals->insert($this->post_fields))
				{
					$this->addMessage('success', 'You have successfully added an arrival log.');
				}
				else
				{
					$this->addMessage('danger', 'Insert unsuccessful. Please contact customer support.');
				}

				# "Kod ponovnog učitavanja stranice (nakon unosa novog zapisa u bazu), polje za unos naziv broda bi trebalo biti prazno, a dropdown meni bi trebao imati selektirani prethodni odabir."
				$this->view_data['type_id'] = $this->post_fields['type_id'];
			}
			else
			{
				$this->addMessage('danger', 'Insert unsuccessful. Please check your data or contact technical support.');
			}
		}


		$this->index();
	}

	# AJAX method, lists arrival entries
	public function list()
	{
		if(!$this->user->loggedIn())
		{
			$this->addHTTPStatusCode('401');
			$this->addMessage('danger', 'You are not logged in. Please log in.');
			$this->addTpl('messages');

			$this->runHTML();
		}

		$arrivals = new arrivalModel($this->db);

		# Load GET variables
		$type_id 	= ! empty($this->params[0]) ? $this->params[0] : false;
		$name 		= ! empty($this->params[1]) ? $this->params[1] : false;

		$data['arrivals'] 			= $arrivals->getArrivals($type_id, $name);
		$data['arrival_statistics'] = $arrivals->getArrivalStatistics($type_id, $name);

		if(empty($data['arrivals']))
		{
			$this->addMessage('danger', 'There are no search results available.');
		}

		$this->addTpl('messages');
		$this->addView('search-results');

		$this->runHTML($data);
	}

	# Delete arrival entry
	public function delete()
	{
		$this->checkLogin();

		if(!empty($this->params) && $this->params[0] > 0)
		{
			$arrival = new arrivalModel($this->db);

			if($arrival->delete($this->params[0]))
			{
				$this->addMessage('success', 'You have successfully deleted an arrival entry.');
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
<?php

interface ModelInterface
{
	public function __construct($db);
}

class BaseModel implements ModelInterface
{
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
}
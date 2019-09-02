<?php

class shipModel extends BaseModel implements ModelInterface
{
	private $table_ship_types = 'ship_types';	
	private $table_ship_arrival_logs = 'ship_arrival_logs';

	public function getTypes()
	{
		return $this->db->fetch('*', $this->table_ship_types);
	}

	public function insert($data)
	{
		return $this->db->insert($data, $this->table_ship_types);
	}

	public function deleteShipType($id)
	{
		return $this->db->delete( array('id'=>$id), $this->table_ship_types);
	}
}
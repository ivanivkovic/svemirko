<?php

class arrivalModel extends BaseModel implements ModelInterface
{
	private $table_ship_arrival_logs = 'ship_arrival_logs';
	private $table_ship_types = 'ship_types';

	public function getArrivals($type_id = false, $name = false)
	{
		$query = "

			SELECT 
					?{$this->table_ship_arrival_logs}.*, 
			       	?{$this->table_ship_types}.name AS type_name

			FROM   	?{$this->table_ship_arrival_logs} 

			JOIN   	?{$this->table_ship_types}  
			ON     	?{$this->table_ship_arrival_logs}.type_id = ?{$this->table_ship_types}.id

		";

		if($type_id !== false || $name !== false)
		{
			$query .= ' WHERE ';
		}

		if($type_id !== false)
		{
			$query .= " ?{$this->table_ship_arrival_logs}.type_id = {$type_id}";
		}

		if($type_id !== false && $name !== false)
		{
			$query .= " AND ";
		}

		if($name !== false)
		{
			$query .= " ?{$this->table_ship_arrival_logs}.name LIKE '%{$name}%'";
		}

		$data = $this->db->fetchSQL($query);

		// Format date values into strings
		foreach($data as $key => $item)
		{
			$data[$key]['time'] = libTime::getDateFromTimestamp($item['time'], 'd.m.o h:m:s');
		}

		return $data;
	}

	public function getArrivalStatistics($type_id = false, $name = false)
	{
		$query = "

			SELECT 
					COUNT( ?{$this->table_ship_arrival_logs}.id) as count, 
			       	?{$this->table_ship_types}.name AS type_name

			FROM   	?{$this->table_ship_arrival_logs} 

			JOIN   	?{$this->table_ship_types}  
			ON     	?{$this->table_ship_arrival_logs}.type_id = ?{$this->table_ship_types}.id

		";

		if($type_id !== false || $name !== false)
		{
			$query .= ' WHERE ';
		}

		if($type_id !== false)
		{
			$query .= " ?{$this->table_ship_arrival_logs}.type_id = {$type_id}";
		}

		if($type_id !== false && $name !== false)
		{
			$query .= " AND ";
		}

		if($name !== false)
		{
			$query .= " ?{$this->table_ship_arrival_logs}.name LIKE '%{$name}%'";
		}

		$query .= " GROUP BY ?{$this->table_ship_arrival_logs}.type_id ";

		$query .= "

			UNION 

			SELECT 
				count(*) as Count, 
				'Total' as Name 

			FROM ?{$this->table_ship_arrival_logs}

		";

		return $this->db->fetchSQL($query);
	}

	public function insert($data)
	{
		$data['time'] = libTime::getCurrentTimestamp();

		return $this->db->insert($data, $this->table_ship_arrival_logs);
	}

	public function delete($id)
	{
		return $this->db->delete( array('id'=>$id), $this->table_ship_arrival_logs);
	}
}
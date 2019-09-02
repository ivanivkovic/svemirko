<?php

class Database
{
	private $db;
	private $prefix;
	private $log;
	private $connected = false;

	/**
	* Init, if config set, connect to database.
	*
	* @return void
	*/

	public function __construct($config = [])
	{
		if(!empty($config))
		{
			$this->connect($config);
		}
	}

	/**
	* Connect to the database.
	*
	* @return void
	*/

	public function connect($config)
	{
		try 
		{
			$this->db = new PDO('mysql:host=' . $config['server'] . ';dbname=' . $config['database'], $config['username'], $config['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->connected = true;
			$this->prefix = $config['prefix'] . '_';
		}
		catch (PDOException $e)
		{
		    $this->log = $e->getMessage();
		}
	}

	/**
	* Disconnect from the database.
	*
	* @return void
	*/
	
	public function disconnect()
	{
		$this->db = null;
	}
	/**
	* Checks for connection.
	*
	* @return bool
	*/

	public function connected()
	{
		return $this->connected;
	}


	/**
	* Return last database log.
	*
	* @return log|string
	*/

	public function getLastLog()
	{
		return $this->log;
	}

	/**
	* 
	* Simple SQL query method. Runs a query and returns the result.
	*
	* @param string $query
	* @return log|string
	*
	*/
	
	public function SQL($query)
	{
		if(!is_object($this->db))
		{
			return false;
		}
		else
		{
			$query = str_replace("\t", ' ', $query);
			$query = preg_replace('/ +\?(?=[a-z]+)/i', ' ' . $this->prefix, $query);
			$query = str_replace('\?', '?', $query);
			
			#debug($query);

			# Clear the query / SQL injection.
			$result = $this->db->prepare($query);
			
			if(!$result || !$result->execute())
			{
				$this->log = $this->db->errorInfo(); return false;
			}
			
			return $result;
		}
	}
	
	/**
	* Insert method.
	*
	* @param array $info array key/value 
	* @param string $table
	*
	* @return bool success/failure
	*/
	
	public function insert($info, $table)
	{
		if( is_array($info) && !empty($info) )
		{
			$query = 'INSERT INTO ' . $this->prefix . $table . ' SET ';
			
			foreach($info as $column => $value)
			{
				if(isset($fdone)){ $query .= ','; }
				
				if(strpos($value, '(') && strpos($value, ')'))
				{
					$query .= $column . ' = ' . $value;
				}
				else
				{
					$query .= $column . ' = "' . $value . '"';
				}
				
				$fdone = true; # Don't add commas for the first interval.
			}
			
			#debug($query);
			
			if( $this->SQL($query) !== false)
			{
				return $this->getInsertId() === 0 || $this->getInsertId() === "0" ? true : $this->getInsertId();
			}
			else
			{
				return false;				
			}
		}

		return false;
	}
	
	/* 
	*
	* Simple update
	*
	* @param $col array of key/values for update
	* @param $table string table name
	* @param $where string WHERE clause
	*
	* @return bool success
	* 
	*/
	
	public function update($col, $table, $where = '')
	{
		if( is_array($col) && !empty($col) )
		{
			$query = 'UPDATE ' . $this->prefix . $table . ' SET ';
			
			foreach($col as $column => $value)
			{
				if(isset($fdone)){ $query .= ','; }
				
				/** 
				* This enables subqueries in $col variable 
				*/
				if( ! is_array($value) )
				{
					if(strpos($value, '(') && strpos($value, ')'))
					{
						$query .= $column . ' = ' . $value . ' ';
					}
					else
					{
						$query .= $column . ' = "' . $value . '" ';			
					}
				}
				
				$fdone = true; # No commans in first interval
			}
			
			if( is_array( $where ) )
			{
				$query .= ' WHERE ';
				
				foreach($where as $column => $value)
				{
					if(isset($fdone2)){ $query .= ' AND '; }
					
					# Enable subqueries.
					if(strpos($value, '(') && strpos($value, ')'))
					{
						$query .= $column . ' = ' . $value . ' ';
					}
					else
					{
						$query .= $column . ' = "' . $value . '" ';
					}
					
					$fdone2 = true;
				}
			}
			
			#debug($query);
			return $this->SQL($query) !== false ? true : false;
		}
		
		return false;
	}
	
	/**
	*
	* Query generator
	*
	* @param $col array vrijednosti i kolona
	* @param $table string table name
	* @param $where string WHERE clause
	* @param $limit int limit data
	* @param $order array column name + direction
	*/
	
	public function query($col, $table, $where = array(), $limit = '', $order = array())
	{
		$query = 'SELECT ';
		
		if(is_array($col))
		{
			$c = 0;
			
			foreach($col as $key => $value)
			{
				if($c !== 0)
				{
					$query .= ',';
				}
				
				if( is_numeric($key) )
				{	
					$query .= $value;
				}
				else if( is_string( $key ) )
				{
					$query .= $key . ' AS ' . $value;
				}
				
				++$c;
			}
		}
		else
		{
			$query .= $col;
		}
		
		$query .= ' FROM ' . $this->prefix . $table;
		
		if( ! empty( $where ) )
		{
			$query .= ' WHERE ';
			
			$c = 0;
			
			foreach($where as $key => $value)
			{
				if($c !== 0)
				{
					$query .= ' AND ';
				}
				
				$query .= $key . '="' . $value . '"';
				
				++$c;
			}
		}
	
		if( $limit !== '' )
		{
			$query .= ' LIMIT ' . $limit;
		}
		
		if( ! empty( $order ) )
		{
			$query .= ' ORDER BY ' . key($order) . ' ' . $order[key($order)];
		}

		# debug(str_replace('?', 'pos_', $query));

		return $this->SQL($query);
	}
	
	/**
	* Fetches object data, easy helper.
	*/
	public function fetch($col, $table, $where = array(), $limit = '', $order = array() )
	{
		$result = $this->query($col, $table, $where, $limit, $order);
		
		if( $result && $result->rowCount() )
		{
			while( $fetch = $result->fetch(PDO::FETCH_ASSOC) )
			{
				$data[] = $fetch;
			}
			
			return $data;
		}
		
		return array();
	}
	
	/**
	*
	* Fetches data and formats into a single object.
	*/
	public function fetchOne($col, $table, $where = '', $order = array())
	{
		$result = $this->query($col, $table, $where, 1, $order);
		
		if($result !== false)
		{
			$fetch = $result->fetch(PDO::FETCH_ASSOC);
			
			if( ! empty ( $fetch ) && $fetch !== false )
			{
				if( $col === '*' )
				{
					return $fetch;
				}
				else if( is_string($col) && $col !== '*')
				{
					return $fetch[$col];
				}
				else if( is_array($col) )
				{
					foreach( $col as $v )
					{
						$data[$v] = $fetch[$v];
					}
					
					return $data;
				}
			}
			else
			{
				return array();
			}
		}

		return false;
	}
	
	/** 
	* Fetch by SQL
	*
	* @param $single bool regulates whether it's a single array or an array of arrays
	*/
	public function fetchSQL($query, $single = false)
	{
		$result = $this->SQL($query);
		
		# debug(str_replace("?", $this->prefix, $query));

		if($result !== false)
		{
			$data = [];

			if( $single )
			{
				$data = $result->fetch(PDO::FETCH_ASSOC);
			}
			else
			{
				while($fetch = $result->fetch(PDO::FETCH_ASSOC))
				{
					$data[] = $fetch;
				}
			}
			
			return $data;
		}

		return false;
	}
	
	/**
	*
	* Deletion helper
	*
	* @param $table string table name
	* @param $where string WHERE clause
	*/
	
	public function delete($where, $table)
	{
		$query = 'DELETE FROM ?' . $table . ' WHERE ';
		
		if( is_array( $where ) )
		{
			$c = 0;
			
			foreach($where as $key => $value)
			{
				if($c !== 0)
				{
					$query .= ' AND ';
				}
				
				$query .= $key . '="' . $value . '"';
				
				++$c;
			}
		}
		
		// debug(str_replace('?', $this->prefix, $query));
		
		return $this->SQL($query);
	}
	
	public function getInsertId()
	{
		return $this->db->lastInsertId();
	}
}
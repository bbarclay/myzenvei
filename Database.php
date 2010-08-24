<?php

	class Database
	{
		private $host;
		private $user;
		private $password;
		public $con;
		private $rs;
		private $stmt;
		
		public function __construct()
		{
			$this->host = "localhost";
			$this->user = "myzenvei_testing";
			$this->password = "TbTOpEgpWf7t";
			$this->con = new mysqli($this->host, $this->user, $this->password);
			if (mysqli_connect_errno()) 
			{
    			printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
			}
			$this->rs  = null;
			$this->stmt = null;
			//var_dump($this->con);
		}
		/**
		 * Selects/Changes Database
		 *
		 * @param string $dbname
		 */
		
		public function selectDB($dbname)
		{
			$this->con->select_db($dbname);
		}
		
		/**
		 * Returns number of affected rows for last insert, update, delete query
		 *
		 * @return unknown
		 */
		
		public function affectedRows()
		{
			return $this->con->affected_rows;
		}
		
		/**
		 * Closes Mysql connection, no further calls should be made to this object after calling this method
		 */
		
		public function close()
		{
			$this->con->close();
		}
		
		/**
		 * Returns the error message for last query
		 *
		 * @return unknown
		 */
		public function error()
		{
			return $this->con->error;
		}
		
		/**
		 * Returns the number of columns for the most recent query
		 *
		 * @return int
		 */
		
		public function columnCount()
		{
			return $this->con->field_count;
		}
		
		/**
		 * Return auto incremented id of last insert statement. Applies only when primary key of a table is auto_incremented
		 *
		 * @return unknown
		 */
		public function insertID()
		{
			return $this->con->insert_id;
		}
		
		/**
		 * Prepares a statment object
		 *
		 * @param unknown_type $query
		 * @return unknown
		 */
		
		public function prepareStatement($query)
		{
			return $this->con->prepare($query);
		}
		
		/**
		 * Used for select query
		 *
		 * @param string $query
		 * @return True if query executed successfuly otherwise false
		 */
		
		public function query($query)
		{
			//echo $query;
			$this->rs = $this->con->query($query);
			if(!$this->error())
				return true;
			return false;
		}
		
		/**
		 * Used for insert, update and delete
		 *
		 * @param unknown_type $query
		 * @return unknown
		 */
		
		public function execute($query)
		{
			$this->con->query($query);
			if(!$this->error())
				return true;
			return false;
		}
		
		/**
		 * Prepares a string for query
		 *
		 * @param unknown_type $str
		 * @return unknown
		 */
		public function escapeString($str)
		{
			return $this->con->real_escape_string($str);
		}
		
		/**
		 * Moves database pointer to the specific row
		 *
		 * @param unknown_type $num
		 * @return unknown
		 */
		public function moveToRow($num)
		{
			if($num>=0 && $this->rs)
			{
				return $this->con->data_seek($num);
			}
			return 1;
		}	
		
		/**
		 * Returns all rows in a result set in form of associative array
		 *
		 * @return unknown
		 */
		public function fetchAll()
		{
			$ret = array();
			while($r = $this->rs->fetch_assoc())
				array_push($ret, $r);
			return $ret;
		}
		
		/**
		 * Returns a record in associative array
		 *
		 * @return unknown
		 */
		
		public function fetchRow()
		{
			
			return $this->rs->fetch_assoc();
		}
		
		/**
		 * Returns a record in a numerated array
		 *
		 * @return unknown
		 */
		
		public function fetchNumericRow()
		{
			return $this->rs->fetch_array(MYSQLI_NUM);
		}
		
		/**
		 * Fetches the name of fields of current result set
		 *
		 * @return unknown
		 */
		public function fetchFields()
		{
			return $this->rs->fetch_fields();
		}
		
		/**
		 * Fetches record as an object
		 *
		 * @return unknown
		 */
		public function fetchObject()
		{
			return $this->rs->fetch_object();
		}
		
		/**
		 * Frees the result set
		 *
		 */
		public function freeResult()
		{
			$this->rs->free();
		}
		
		/**
		 * Returns number of rows in result set
		 *
		 * @return unknown
		 */
		public function rowCount()
		{
			return $this->rs->num_rows;
		}
		
		/**
		 * Used for single column query, returns the value of that column
		 *
		 * @param unknown_type $query
		 * @return unknown
		 */
		
		public function fetch($query)
		{
			if($this->query($query))
			{
				$row = $this->fetchNumericRow();
				return $row[0];
			}
			else 
				return false;
		}
		
	}
?>
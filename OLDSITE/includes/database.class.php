<?



class Database

{



	var $language;

	var $lastQuery;

	var $lastQueryText;

	var $lastRow;

	var $db;

	

	var $success;

	var $errorNumber;

	var $errorMessage;

	

	var $row;

	var $fields;

	var $fieldsRow;

	var $primaryKeyField;

	var $numRows;

	var $i;

	

	

	function Database($language = "mysql")

	{

		$this->$language = "mysql";

		$this->lastQuery = "";

		$this->lastQueryText = "";

		$this->lastRow = "";

		

		$this->numRows = 0;

		$this->i = 0;

		$this->row = array();

		$this->primaryKeyField = "";

	}

	

	function connect($host, $username, $password, $db)

	{

		$this->db = mysql_connect( $host, $username, $password )

			or die("Could not connect: ".mysql_error());

	

		mysql_select_db( $db );

	}

	

	function disconnect()

	{

		mysql_close($this->db);

	}

	

	function query( $queryText )

	{

		$this->lastQueryText = $queryText;

		$this->lastQuery = mysql_query( $this->lastQueryText );

		

		$this->errorNumber = mysql_errno();

		

		if ( $this->errorNumber == 0 )

		{

			$this->success = true;

			$this->i = 0;		

			$this->row = array();

			

			if ( strpos( $this->lastQueryText, "SELECT" ) === 0 )

			{

				$this->numRows = mysql_num_rows($this->lastQuery);

				$this->getFieldNames();

			}

		}

		else

		{

			$this->errorMessage = mysql_error();

		}



		return ( $this->errorNumber == 0 ) ? $this : false;

	}

	

	function result( $queryText = "", $key = 0 )

	{

		if ( empty( $queryText ) )

		{

			$queryText = $this->lastQueryText;

		}

		

		$this->query( $queryText );

		

		if ( $this->success )

		{

			if ( $this->numRows <= 0 )

			{

				return false;

			}

			else

			{

				$array = mysql_fetch_array( $this->lastQuery );

				return $array[$key];

			}

		}

		else

			return false;

	}

	

	function getFieldNames( $queryText = "" )

	{

		$this->fields = array();

		$this->fieldsRow = array();



		if ( !empty( $queryText ) )

			$this->query( $queryText );



		while( $field = mysql_fetch_field( $this->lastQuery ) )

		{

			if ( $field->primary_key )

				$this->primaryKeyField = $field->name;



			$this->fields[$field->name] = $field->name;

			$this->fieldsRow[] = $field->name;

		}

		

		return $this->fields;

	}

	

	function nextRow()

	{

		if ( $next = mysql_fetch_assoc( $this->lastQuery ) )

		{

			$this->i++;

			$this->row = $next;

			return $this->row;

		}

		else

			return false;

				

	}

	

	function lastInsertId()

	{

		return mysql_insert_id();

	}

	

	function arrayFromQuery( $queryText, $seperator = "", $valueIsKey = false )

	{

		$array = array();

		

		$this->query( $queryText );

		

		while( $this->nextRow() )

		{

			$key = array_shift( $this->row );

			$value = "";

			

			if ( $valueIsKey )

				$value = $key;

			else

			{

				$values = array();

				

				while( !empty( $this->row ) )

				{

					$values[] = array_shift( $this->row ); 

				}

				

				$value = implode( $seperator, $values );

			}

			

			$array[$key] = $value;

		}



		return $array;

	}

	

	

	// query must specifically give the id, category, and value

		

	function arrayFromQueryCategorized( $queryText, $indent = "&nbsp; &nbsp; - " )

	{

		$array = array();

		$category = "";

		

		$dbState = $this->query( $queryText );

		

		while( $this->nextRow() )

		{

			$key = $this->row['id'];

			

			if ( $category != $this->row['category'] )

			{

				$array[] = array( "key" => "", "value" => "" );

				$array[] = array( "key" => $key, "value" => $this->row['category'] );

				$category = $this->row['category'];

			}

			

			if ( !empty( $this->row['value'] ) )

				$array[] = array( "key" => $key, "value" => $indent . $this->row['value'] );

		}

			

		return $array;

	}

	

	function arrayFromQueryTree( $table, $id, $name, $parentId, $startParentId = 0, $level = 0, $whereExtras = "", $indent = "&nbsp; &nbsp; " )

	{

		global $arrayTree;

		

		if ( $level == 0 )

			$arrayTree = array();

			

		$sql = "SELECT " . $id . " as id, " . $name . " as name FROM " . $table . " WHERE " . $parentId . " = " . $startParentId . " " . ( empty( $whereExtras ) ? "" : " AND " . $whereExtras ) . " ORDER BY name";

		

		$dbState = clone $this;

		$dbState->query( qcSql($sql) );

		

		while( $dbState->nextRow() )

		{

			$arrayTree[] = array( "key" => $dbState->row['id'], "value" => str_repeat( $indent, $level + 1 ) . $dbState->row['name'] );

			$dbState->arrayFromQueryTree( $table, $id, $name, $parentId, $dbState->row['id'], $level + 1, $whereExtras, $indent );		

		}

		

		return $arrayTree;

	}

	

	function insertFromArray( $table, $array, $last = false, $key = "" )

	{

		$queryFields = array();

		$queryValues = array();

		

		$fieldQuery = mysql_query( "SELECT * FROM " . $table . " LIMIT 1" );

		

		while( $field = mysql_fetch_field( $fieldQuery ) )

		{

			if ( $field->primary_key )

			{

				array_push( $queryFields, $field->name );

				

				if ( !empty( $array[$field->name] ) )

					array_push( $queryValues, $this->sanitize( $array[$field->name] ) );

				else if ( $last )

					array_push( $queryValues, "LAST_INSERT_ID()" );

				else if ( $key  )

					array_push( $queryValues, $this->sanitize( $key ) );

				else

					array_push( $queryValues, "NULL" );

			}

			else if ( isset( $array[$field->name] ) )

			{

				array_push( $queryFields, $field->name );

				

				if ( strpos( $array[$field->name], "()" ) !== FALSE )

					array_push( $queryValues, $array[$field->name] );

				else

					array_push( $queryValues, "'" . $this->sanitize( $array[$field->name] ) . "'" );

			}

		}

		

		return "INSERT INTO " . $table . " ( " . implode( ", ", $queryFields ) . " ) VALUES ( " . implode( ", ", $queryValues ) . " )";

	}

	

	function updateFromArray( $table, $array )

	{

		$whereConditions = array();

		$setConditions = array();

		

		$fieldQuery = mysql_query( "SELECT * FROM " . $table . " LIMIT 1" );

		

		while( $field = mysql_fetch_field( $fieldQuery ) )

		{

			if ( $field->primary_key )

				array_push( $whereConditions, $field->name . " = '" . $this->sanitize( $array[$field->name] ) . "'" );

			else if ( isset( $array[$field->name] ) )

			{

				if ( strpos( $array[$field->name], "()" ) !== FALSE )

					array_push( $setConditions, $field->name . " = " . $array[$field->name] );

				else

					array_push( $setConditions, $field->name . " = '" . $this->sanitize( $array[$field->name] ) . "'" );

			}

		}

		

		return "UPDATE " . $table . " SET " . implode( ", ", $setConditions ) . " WHERE " . implode( ", ", $whereConditions );

	}

	

	function deleteFromId( $table, $id )

	{

		$keys = array();

		

		$fieldQuery = mysql_query( "SELECT * FROM " . $table . " LIMIT 1" );

		

		while( $field = mysql_fetch_field( $fieldQuery ) )

		{

			if ( $field->primary_key )

				array_push( $keys, $field->name );

		}

		

		$conditions = array();

		

		if ( count( $keys ) > 1 )

		{

			for( $i = 0; $i < count( $keys ); $i++ )

			{

				$conditions[] = $keys[$i] . " = '" . $id[$i] . "'";

			}

		}

		else

			$conditions[] = $keys[0] . " = '" . $id . "'";

			

			return "DELETE FROM " . $table . " WHERE " . implode( ", ", $conditions );



	}

	

	function sanitize($s)

	{

		if(get_magic_quotes_gpc())  // get rid of magic_quotes escapes 

		{ 

			$s = stripslashes($s); 

		} 



		return mysql_real_escape_string($s);

	}

}


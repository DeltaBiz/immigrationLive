<?

class Session
{
	var $allowedTypes;
	var $started;
	var $secured;
	
	function Session()
	{
		session_start();
		
		$this->allowedTypes = array();
		$this->started = true;

		if ( $_SERVER["HTTPS"] != "on" )
			$this->secured = false;
		else
			$this->secured = true;
	}
	
	function secure()
	{
		$long = ip2long($_SERVER["HTTP_HOST"]);
		
		if ( strpos( $_SERVER["HTTP_HOST"], "www." ) !== 0 && ( $long == -1 || $long === FALSE ) )
			$wwwPrefix = "www.";
	
		if ( $_SERVER["HTTPS"] != "on" )
			header ( "Location: https://" . $wwwPrefix . $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"]  );
		else if ( !empty( $wwwPrefix ) )
			header ( "Location: https://" . $wwwPrefix . $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"]  );
			
		$this->secured = true;
	}
	
	function unsecure()
	{
		$long = ip2long($_SERVER["HTTP_HOST"]);
		
		if ( strpos( $_SERVER["HTTP_HOST"], "www." ) !== 0 && ( $long == -1 || $long === FALSE ) )
			$wwwPrefix = "www.";
	
		if ( $_SERVER["HTTPS"] != "on" )
			header ( "Location: http://" . $wwwPrefix . $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"]  );
		else if ( !empty( $wwwPrefix ) )
			header ( "Location: http://" . $wwwPrefix . $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"]  );

		$this->secured = false;
	}
	
	function allow($typeCategory, $type)
	{
		if ( empty( $this->allowedTypes[$typeCategory] ) )
			$this->allowedTypes[$typeCategory] = array();
			
		$this->allowedTypes[$typeCategory][] = $type;
	}

	function auth()
	{
		foreach( $this->allowedTypes as $category => $types )
		{
			if ( !empty ( $_SESSION[$category] ) )
			{
				if ( !in_array( $_SESSION[$category], $types ) )
					return false;
			}
			else
				return false;
		}
		
		return true;
	}	
	
	function get($category)
	{
		if ( $this->started )
			return $_SESSION[$category];
		else
		{
			trigger_error( "Cannot get session information until session is initialized", E_USER_WARNING );
			return false;
		}
	}	
	
	function set($category, $value)
	{
		if ( $this->started )
			$_SESSION[$category] = $value;
		else
		{
			trigger_error( "Cannot set session information until session is initialized", E_USER_WARNING );
			return false;
		}
	}
	
	function add($category, $value)
	{
		if ( $this->started )
			$_SESSION[$category][] = $value;
		else
		{
			trigger_error( "Cannot set session information until session is initialized", E_USER_WARNING );
			return false;
		}
	}
	
	function clear()
	{
		session_destroy();
		
		foreach( $_SESSION as $key => $val )
			unset( $_SESSION[$key] );
	}
}
		
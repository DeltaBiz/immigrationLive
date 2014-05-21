<?

	require_once( "session.class.php" );

	require_once( "image.class.php" );

	require_once( "database.class.php" );

	//require_once( "form.class.php" );

	//require_once( "output.class.php" );



	define( _RULE_SEP, ";" );

	define( _COST_SEP, ":" );
	
	
	
	function sendSTMLMail($to,$replyto="",$subject,$body)
	{
		require_once "/home/justchar/php/Mail.php";
		$host = "mail.rainmark.com";
		$username = "info@rainmark.com";
		$password = "Rainmark1";
		$smtp_fromname="Rainmark Mgt Inc";
		$mailfrom="info@rainmark.com";
		$bcc = $replyto;

		$body="<HTML>".$body."</HTML>";
		
		$headers = array (
		'MIME-Version' => '1.0',
		'Content-Type' => "text/html; charset=ISO-8859-1",
		'From' => $smtp_fromname." <".$mailfrom.">",
		'To' => $to,
		'Bcc' =>  $bcc,
		'Reply-To' => ($replyto=="" ? "info@rainmark.com" : $replyto),
		'Subject' => $subject,
		);
		
		$smtp = Mail::factory('smtp',
		array ('host' => $host,
		'auth' => true,
		'username' => $mailfrom,
		'password' => $password));
		
		$mail = $smtp->send(array($to,$bcc), $headers, $body);
		
		if (PEAR::isError($mail)) {

		} else {
		echo("<p>--</p>");
		}
		
		
	}
	

	function getFileSize($path, $sigFigs = 3 )

	{

		if ( !file_exists( $path ) )

			return false;

			

		$levels = array( "bytes", "KB", "MB", "GB" );

		

		$i = 0;

		

		$step = 1024;

		

		$filesize = filesize($path);

		

		while ( $filesize > $step && $i < count( $levels ) )

		{

			$i++;

			$filesize /= $step;

		}

		

		if ( $i > 0 )

			$filesize = number_format( $filesize, $sigFigs - strlen( intval( $filesize ) ) );

			

		return $filesize . " " . $levels[$i];

	}

	

	function arrayNumberRange( $min, $max, $increment )

	{

		$array = array();

		

		for( $i = $min; $i <= $max; $i += $increment )

			$array["$i"] = $i;

		

		return $array;

	}

	

	function arrayAppend( $a, $pre = "", $post = "" )

	{

		$newA = array();

		

		foreach( $a as $key => $value )

		{

			$newA[$key] = $pre . $value . $post;

		}

		

		return $newA;

	}

		

	function isMalicious($message)

	{

		if ( strpos( strtolower($message), "content-type" ) !== FALSE ||

			 strpos( strtolower($message), "cc:" ) !== FALSE || 

			 strpos( strtolower($message), "content-transfer-encoding" ) !== FALSE ||

			 strpos( strtolower($message), "<html>" ) !== FALSE )

			 return true;

		

		return false;

			 

	}

	

	function processPost()

	{

		// Format Dates

		foreach( $_POST as $key => $value )

		{

			$needle = "Check";

			$type = "_Month";

			

			if ( strpos( $key, "Check" ) === 0 && strpos( $key, $type ) !== false )

			{	

				$dateKey = substr( $key, strlen($needle), -strlen($type) );

				

				$_POST[$dateKey] = $_POST[$needle.$dateKey."_Year"]."-".($_POST[$needle.$dateKey."_Month"] + 1)."-".$_POST[$needle.$dateKey."_Date"];

			}

		}

	}

	

	function imagesFromDir( $path )

	{

		$images = array( 

			"hasThumbnails" => false,

			"files" => array(),

		);

			

		if( is_dir( $path ) ) 

		{

			if( $handle = opendir( $path ) ) 

			{

				while( false !== ( $file = readdir( $handle ) ) ) 

				{

					if( $file != "." && $file != ".." ) 

					{

						if( is_dir( $path . "/" . $file ) && $file == "tn" )

							$images["hasThumbnails"] = true;

						else

							$images["files"][] = $file;

					}

				}

				closedir( $handle );

			}

		}

		

		natsort( $images["files"] );

		

		return $images;

	}

	function thumbsFromPress( $path )

	{

		$files=  array();

			

		if( is_dir( $path ) ) 

		{

			if( $handle = opendir( $path ) ) 

			{

				while( false !== ( $dir = readdir( $handle ) ) ) 

				{

					if(is_dir($path.$dir) && $handle2 = opendir( $path.$dir )) 

					{

						while( false !== ( $file = readdir( $handle2 ) ) ) 

						{

							if( strchr($file,'thumb') !== false ) 

							{

								$files[] = $dir."/".$file;

							}

						}

					closedir ($handle2);

					}

				}

				closedir( $handle );

			}

			else echo 'could not open '.$path;

		}

		else echo $path.' is not a directory.';

		

		natsort( $files );

		

		return $files;

	}

	function getPress( $path )

	{

		$files =  array();

			

		if( is_dir( $path ) ) 

		{

			if( $handle = opendir( $path ) ) 

			{

				while( false !== ( $dir = readdir( $handle ) ) ) 

				{

					if($dir != '.' && $dir != '..' && is_dir($path.$dir)) 

					{

						$files['thumb'][] = $dir."/thumb.jpg";

						$tempFile = file($path.$dir."/blurb.txt");

						$files['size'][] = (strpos($tempFile[0],"X") !== FALSE) ? explode("X",array_shift($tempFile)) : array('800','600');

						$files['blurb'][] = @txt2html(implode('', $tempFile));

						 //$files['size'][] = array('height'=>'600','width'=>'800');

						$files['images'][] = glob($path.$dir."/*.{jpg,gif,png}", GLOB_BRACE);

					}

				}

				closedir( $handle );

			}

			else echo 'could not open '.$path;

		}

		

		natsort( $files );

		

		return $files;

	}

	

	function songsFromDir( $path )

	{

		$songs = array( );

			

		if( is_dir( $path ) ) 

		{

			if( $handle = opendir( $path ) ) 

			{

				while( false !== ( $file = readdir( $handle ) ) ) 

				{

					if( $file != "." && $file != ".." ) 

					{

						$songs[] = $file;

					}

				}

				closedir( $handle );

			}

		}

		

		natsort( $songs );

		

		return $songs;

	}

	

	function dirsFromDir( $path )

	{

		$dirs = array( 

			"files" => array(),

		);

			

		if( is_dir( $path ) ) 

		{

			if( $handle = opendir( $path ) ) 

			{

				while( false !== ( $file = readdir( $handle ) ) ) 

				{

					if( $file != "." && $file != ".." ) 

					{

						if( is_dir( $path . "/" . $file ) )

							$dirs["files"][] = $file;

					}

				}

				closedir( $handle );

			}

		}

		

		natsort( $dirs["files"] );

		

		return $dirs;

	}

	

	function dircopy($srcdir, $dstdir, $offset, $verbose = false) {

	if(!isset($offset)) $offset=0;

	  $num = 0;

	  $fail = 0;

	  $sizetotal = 0;

	  $fifail = '';

	  if(!is_dir($dstdir)) mkdir($dstdir);

	  if($curdir = opendir($srcdir)) {

		while($file = readdir($curdir)) {

		  if($file != '.' && $file != '..') {

			$srcfile = $srcdir . '\\' . $file;

			$dstfile = $dstdir . '\\' . $file;

			if(is_file($srcfile)) {

			  if(is_file($dstfile)) $ow = filemtime($srcfile) - filemtime($dstfile); else $ow = 1;

			  if($ow > 0) {

				if($verbose) echo "Copying '$srcfile' to '$dstfile'...";

				if(copy($srcfile, $dstfile)) {

				  touch($dstfile, filemtime($srcfile)); $num++;

				  $sizetotal = ($sizetotal + filesize($dstfile));

				  if($verbose) echo "OK\n";

				}

				else {

					 echo "Error: File '$srcfile' could not be copied!\n";

					 $fail++;

					 $fifail = $fifail.$srcfile."|";

				}

			  }                  

			}

			else if(is_dir($srcfile)) {

			  $res = explode(",",$ret);

			  $ret = dircopy($srcfile, $dstfile, $verbose);

			  $mod = explode(",",$ret);

			  $imp = array($res[0] + $mod[0],$mod[1] + $res[1],$mod[2] + $res[2],$mod[3].$res[3]);

			  $ret = implode(",",$imp);

			}

		  }

		}

		closedir($curdir);

	  }

	  $red = explode(",",$ret);

	  $ret = ($num + $red[0]).",".(($fail-$offset) + $red[1]).",".($sizetotal + $red[2]).",".$fifail.$red[3];

	  return $ret;

	}

	function stri_replace( $find, $replace, $string ) {

// Case-insensitive str_replace()



  $parts = explode( strtolower($find), strtolower($string) );



  $pos = 0;



  foreach( $parts as $key=>$part ){

    $parts[ $key ] = substr($string, $pos, strlen($part));

    $pos += strlen($part) + strlen($find);

  }



  return( join( $replace, $parts ) );

}





function txt2html($txt) {

// Transforms txt in html



  //Kills double spaces and spaces inside tags.

  while( !( strpos($txt,'  ') === FALSE ) ) $txt = str_replace('  ',' ',$txt);

  $txt = str_replace(' >','>',$txt);

  $txt = str_replace('< ','<',$txt);



  //Transforms accents in html entities.

  $txt = htmlentities($txt);



  //We need some HTML entities back!

  $txt = str_replace('&quot;','"',$txt);

  $txt = str_replace('&lt;','<',$txt);

  $txt = str_replace('&gt;','>',$txt);

  $txt = str_replace('&amp;','&',$txt);



  //Ajdusts links - anything starting with HTTP opens in a new window

  $txt = stri_replace("<a href=\"http://","<a target=\"_blank\" href=\"http://",$txt);

  $txt = stri_replace("<a href=http://","<a target=\"_blank\" href=http://",$txt);



  //Basic formatting

  $eol = ( strpos($txt,"\r") === FALSE ) ? "\n" : "\r\n";

  $html = '<p>'.str_replace("$eol$eol","</p><p>",$txt).'</p>';

  $html = str_replace("$eol","<br />\n",$html);

  $html = str_replace("</p>","</p>\n\n",$html);

  $html = str_replace("<p></p>","<p>&nbsp;</p>",$html);



  //Wipes <br> after block tags (for when the user includes some html in the text).

  $wipebr = Array("table","tr","td","blockquote","ul","ol","li");



  for($x = 0; $x < count($wipebr); $x++) {



    $tag = $wipebr[$x];

    $html = stri_replace("<$tag><br />","<$tag>",$html);

    $html = stri_replace("</$tag><br />","</$tag>",$html);



  }



  return $html;

}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
	

?>


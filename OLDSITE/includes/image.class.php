<?

$imageSizes = array( 
	"tiny" => 	array( "w" => 27,  "h" => 25,  "keepRatio" => false ),
	"icon" => 	array( "w" => 54,  "h" => 51,  "keepRatio" => false ),
	"thumb" => 	array( "w" => 200, "h" => 130, "keepRatio" => false ),
	"save" =>	array( "w" => 640, "h" => 480, "keepRatio" => true ),
);

$imageTypes = array(
	".jpg" => "image/jpeg",
	".jpeg" => "image/jpeg",
	".png" => "image/png",
	".gif" => "image/gif",
);	

$imageCreateFunctions = array(
	"image/jpeg" => "imagecreatefromjpeg",
	"image/pjpeg" => "imagecreatefromjpeg",
	"image/png" => "imagecreatefrompng",
	"image/gif" => "imagecreatefromgif",
);

$colorModeFunctions = array(
	"gray" => "imagecopygray",
	"copy" => "imagecopy",
);


class Image
{
	var $src;
	var $writtenSrc;
	var $destDir;
	var $colorMode;
	
	function Image($src,$type = "") 
	{
		global $imageTypes;
		
		$this->src = $src;
		
		if ( empty( $type ) )
		{
			if ( strpos( $this->src, "." ) !== FALSE )
			{
				$ext = strtolower( strrchr( $this->src, "." ) );
				
				$type = $imageTypes[$ext];
			}
			else
			{
				trigger_error("Image must be given a type", E_USER_ERROR);
			}
		}
		
		$this->type = $type;
		$this->writtenSrc = "";
		$this->destDir = "";
		$this->colorMode = "copy";
	}
	
	function resize( $destFilename, $w, $h, $keepRatio = true )
	{
		global $imageCreateFunctions;
		
		if ( file_exists( $this->src ) )
			$src = $this->src;
		else if ( !empty( $this->writtenSrc ) )
			$src = $this->writtenSrc . ".full.jpg";
		else
		{
			trigger_error("No source image to resize", E_USER_WARNING);
			return;
		}
		
		$size = array( "w" => $w, "h" => $h );

		$image = $imageCreateFunctions[$this->type]( $src );
		list($w, $h, $type, $attr) = getimagesize($src);	

		if ( $keepRatio )
			$resizedImage = $this->createResized($image, $w, $h, $size);
		else
			$resizedImage = $this->createCropped($image, $w, $h, $size);
		
		imagejpeg($resizedImage, $destFilename, $this->getJpegQuality(min($size['w'], $size['h'])) );
	}
	
	function resizeAll($id = 0, $destDir = "") 
	{
		global $imageSizes, $imageCreateFunctions;
		
		$destDir = $this->getDir($destDir);
		
		$image = $imageCreateFunctions[$this->type]( $this->src );
		list($w, $h, $type, $attr) = getimagesize($this->src);	
		
		foreach( $imageSizes as $name => $size )
		{
			if ( $size['keepRatio'] )
				$resizedImage = $this->createResized($image, $w, $h, $size);
			else
				$resizedImage = $this->createCropped($image, $w, $h, $size);
			
			imagejpeg($resizedImage, $destDir . $id . "." . $name . ".jpg", $this->getJpegQuality(min($size['w'], $size['h'])) );
		}
		
		$this->destDir = $destDir;
		$this->writtenSrc = $this->destDir . $id;
	}
	
	function createResized($image, $w, $h, $size)
	{
		global $colorModeFunctions;
		
		$ratio = $size['w'] / $size['h'];
		
		if ( $w > $h * $ratio )
		{
			$newW = round($size['w']);
			$newH = round($size['w'] * $h/$w);
		}
		else
		{
			$newH = round($size['h']);
			$newW = round($size['h'] * $w/$h);
		}
		
		$resizedImage = imagecreatetruecolor($newW, $newH);
		imagecopyresampled( $resizedImage, $image, 0, 0, 0, 0, $newW, $newH, $w, $h );
		
		$colorModeFunctions[$this->colorMode]( $resizedImage, $resizedImage, 0, 0, 0, 0, $newW, $newH );
		
		return $resizedImage;
	}

	function createCropped($image, $w, $h, $size)
	{
		global $colorModeFunctions;
		
		$ratio = $size['w'] / $size['h'];
		
		if ( $w/$h > $ratio )
		{
			// height dominates
			$wSide = $h * $ratio;
			$hSide = $h;
		}
		else if ( $w/$h < $ratio )
		{
			// width dominates
			$wSide = $w;
			$hSide = $w / $ratio;
		}
		else
			$wSide = $hSide = min( $w, $h );
		
		$iconImage = imagecreatetruecolor($size['w'], $size['h']);
		
		imagecopyresampled( $iconImage, $image, 0, 0, $w/2 - $wSide/2, $h/2 - $hSide/2, $size['w'], $size['h'], $wSide, $hSide );
		
		$colorModeFunctions[$this->colorMode]( $iconImage, $iconImage, 0, 0, 0, 0, $size['w'], $size['h'] );

		return $iconImage;
	}
	
	function displayAll($debugTitles = false)
	{
		global $imageSizes;

		foreach( $imageSizes as $name => $size )
		{
			if ( $debugTitles )
				print "<h1>" . $name . "</h1>";
				
			print "<img src='" . $this->writtenSrc . "." . $name . ".jpg?rand=" . rand( 0, 100000 ) . "' />" . "<br />";
		}
	}
		
	function getDir($destDir)
	{
		if ( empty( $destDir ) )
		{
			if ( ( $lastSlash = strrpos( $this->src, "/" ) ) !== FALSE )
				$destDir = substr( $this->src, 0, ++$lastSlash );
			else
				$destDir = "./";
		}
		else
		{
			if ( ( $lastSlash = strrpos( $destDir, "/" ) ) !== FALSE )
				$destDir = substr( $destDir, 0, ++$lastSlash );
		}
			
		
		return $destDir;
	}
	
	function getJpegQuality($ls)
	{
		if ( $ls > 250 )
			return 85;
		else if ( $ls > 100 )
			return 93;
		else
			return 98;
	}
}

function imagecopygray( $dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h )
{
	for ( $i = 0; $i < 256; $i++) 
	{
		$palette[$i] = imagecolorallocate($dst_im,$i,$i,$i);
	}

	for ( $y = $src_y; $y < $src_h; $y++ ) 
	{
		for ( $x = $src_x; $x < $src_w; $x++ ) 
		{
			$rgb = imagecolorat($src_im,$x,$y);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
		
			$gs = yiq( $r, $g, $b );
			
			imagesetpixel( $dst_im, $x, $y, $palette[$gs] );
		}
	}
}

function yiq($r,$g,$b) 
{
	return (($r*0.299)+($g*0.587)+($b*0.114));
} 
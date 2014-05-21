<?php

$gallery = (isset($gal)) ? $gal : "weddingland";
$galleryDir = BASE_DIR."images\\".$gallery."\\";
$galleryUrl = BASE_URL."images/".$gallery."/";
$photos = array();
$thumbs = array();

if ( is_dir( $galleryDir ) ) {
	if($dh = opendir($galleryDir)) {
		while(false !== ($file = readdir($dh))) {
			if(is_file($galleryDir.$file) && $file != "." && $file != ".." && $file != "Thumbs.db" && $file != "blurb.gif") {
				$photos[] = $galleryUrl.$file;
				$thumbs[] = $galleryUrl."tn/".$file;
			}
		}
	}
}

natsort($thumbs);
natsort($photos);

//print nl2br( print_r( $thumbs, true ) );
//print nl2br( print_r( $photos, true ) );

if ( empty( $photosSetting ) )
	$scripting = "\n" . "var photos = new Gallery('photos', 696, 464, 3000, 1000 );" . "\n";
else
	$scripting = "\n" . $photosSetting . "\n";
	
$thumbsString = "";
$i=0;
foreach($photos as $key=>$value) {
	//print $key . "<br />";
	$scripting .= 'photos.add("'.$value.'", "");';
	$scripting .= "\n";
	$thumbsString .= '<a href="#NULL" onClick="photos.goTo('.$i.')" class="thumblink"><img src="'.$thumbs[$key].'" alt="okanagan Photographer" class="thumb" ' . ( true ? "" : 'onmouseover="this.className=\'thumb_over\'" onmouseout="this.className=\'thumb\'"' ) . '></a>';
	$thumbsString .= "\n";
	$i++;
}

//$scripting .= 'setTimeout("switchPic()",1500);';
//$scripting .= "\n";

?>
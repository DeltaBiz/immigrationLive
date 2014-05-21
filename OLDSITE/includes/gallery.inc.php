<?php
$gallery = (isset($_GET['gallery'])) ? $_GET['gallery'] : "weddingland";
$galleryDir = BASE_DIR."images\\".$gallery."\\";
$galleryUrl = BASE_URL."images/".$gallery."/";
$photos = array();
$thumbs = array();
if($dh = opendir($galleryDir)) {
	while(false !== ($file = readdir($dh))) {
		if(is_file($galleryDir.$file) && $file != "." && $file != ".." && $file != "Thumbs.db" && $file != "blurb.gif") {
			$photos[] = $galleryUrl.$file;
			$thumbs[] = $galleryUrl."tn/".$file;
		}
	}
}
natsort($thumbs);
natsort($photos);
$scripting = "\nvar photos = new Array();\n";

$thumbsString = "";
$i=0;
foreach($photos as $key=>$value) {
	$scripting .= 'photos['.$i.'] = "'.$value.'";';
	$scripting .= "\n";
	$thumbsString .= '<a href="#NULL" onClick="switchPic(\''.$key.'\')"><img src="'.$thumbs[$i].'" alt="okanagan Photographer" class="thumb" onmouseover="this.className=\'thumb_over\'" onmouseout="this.className=\'thumb\'"></a>';
	$thumbsString .= "\n";
	$i++;
}
$scripting .= 'setTimeout("switchPic()",1500);';
$scripting .= "\n";
?>
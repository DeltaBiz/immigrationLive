<?php

#functions used throughout the website



// test to ensure not requesting content pages directly. if so append pagename to querystring and 

// load page

function checkBadRequest($page = NULL) {

	$pageTest = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/'));

	if($pageTest != "/loadPage.php" && $pageTest != "/index.php")

	{

		$redirect = ($page != NULL) ? BASEURL."index.php?p=".$page : BASEURL."index.php?p=home";

		header("Location: $redirect");

	}

}



function makeURLFriendly($input){

	$output = trim($input);

	//$output = preg_replace('/>\s*</', '><', $output);

	$output = preg_replace('/>\s*/', '>', $output);

	$output = preg_replace('/\s*</', '<', $output);

	$output = preg_replace('/\s{2,999}/','&nbsp;', $output);

	$output = str_replace('"',"'",$output);
	$output = str_replace('/', '-', $output);
	$output = str_replace(',', '', $output);
	$output = str_replace('?', '', $output);
	$output = str_replace("'", "", $output);
	$output = str_replace(' ', '-', $output);

	return $output; 

}



function getSlides($start,$length,$slidesdir) 

{

	$photosArray = array();

	if($handle = opendir(SLIDES_DIR.$slidesdir)) {

	

		while(false !== ($file = readdir($handle))) {

			if($file != "." && $file != "..") {

				$photosArray[] = SLIDES_URL.$slidesdir."tn/".$file;

			}

		}

	}

	sort($photosArray);

	return array_slice($photosArray, $start, $length);

}



function spanWrapWords($str) {

	$words = explode(" ",$str);

	$returnArr = array();

	foreach ($words as $word) {

		$returnArr[] = '<span>'.strtoupper(substr($word,0,1)).'</span>'.substr($word,1);

	}

	return implode(" ",$returnArr);

}
?>
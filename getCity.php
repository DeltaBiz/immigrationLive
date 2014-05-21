<?
require_once 'includes/init.php';
$maxResults = 5;


$matches = array();

if(isset($_GET['searchTerm'])) {
	if($_GET['mobile'] === '1') {
		$linkUrl = 'http://m.impaireddriving.ca/';
	}
	else $linkUrl = BASE_URL."Divorce_Family_Law_Lawyers/";
	$cities = $db->arrayFromQuery( "SELECT areas.areaId,areas.name,regions.code FROM areas,regions WHERE areas.regionId=regions.regionId AND areas.name LIKE '".$_GET['searchTerm']."%'",',' );
	//print_r($cities);
	$i=0;
	foreach($cities as $city) {
 			$item = explode(',',$city);
			$urlCity = rawurlencode($item[0]);
			$matches[] = "<a href='".$linkUrl.$item[1]."/".$urlCity."/'><span id='term_".$i."'>".$item[0]."</span>, <span id='prov_".$i."'>".$item[1]."</span></a>";
			$i++;
	}

}

//print_r($matches);

echo implode("<br />",array_slice($matches,0,$maxResults));
?>


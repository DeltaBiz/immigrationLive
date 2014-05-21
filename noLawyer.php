<?php
session_start();
require_once 'includes/init.php';
$db->query("SELECT * FROM content WHERE contentId='136'");
$db->nextRow();
$title = $db->row['title'];
$metaDesc = $db->row['metaDesc'];
$metaKeywords = $db->row['metaKeywords'];
$bannerTittle = $db->row['bannerTittle'];
$banner = $db->row['banner'];
$content = $db->row['content'];
$page = $db->row['slug'];
$video = $db->row['video'];
$image = $db->row['image'];
$showSearch = true;
$noLawyer=true;
//Clear the home LINK
$_SESSION['homeLink']="/";
include 'header.php';
$prevCity = $_SESSION['landingCity'];
unset($_SESSION['landingCity']);

?>
<div class="leftContent">

<p>Below is a listing of the lawyers that are located in your province. If you are looking for a lawyer in another province, please use the search box located above the video player.</p>
<p>&nbsp;</p>
		<?
		$my_db = clone $db;
		$regionId = $my_db->result("SELECT regionId FROM `areas` WHERE name LIKE '".$prevCity."' LIMIT 0,1");
		if(empty($regionId)) {
			$regionId = $db->result("SELECT regionId FROM `regions` WHERE name LIKE '".ucwords(strtolower($_SESSION['provFromIp']))."' LIMIT 0,1");
		}
		//echo "SELECT DISTINCT clients.*,areas.name as area,regions.name as region,regions.code as code FROM clients,areas,regions WHERE clients.siteId='2' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND areas.regionId = '".$regionId."' ORDER BY RAND()*(IF( clients.clientId=10,3,2)) DESC";
		$my_db->query("SELECT DISTINCT clients.*,areas.name as area,regions.name as region,regions.code as code FROM clients,areas,regions WHERE clients.siteId='10' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND areas.regionId = '".$regionId."' ORDER BY RAND()*(IF( clients.clientId=10,3,2)) DESC");
		if($my_db->numRows > 0 ) {
			while($my_db->nextRow()) {
				?>
				<div class="noLawyerImg">
                <a href="/Divorce_Family_Law_Lawyers/<?=$my_db->row['code'];?>/<?=$my_db->row['area'];?>/">
				<? if(is_file(BASE_MASTER_DIR.'images/lawyerThumbs/'.$my_db->row['clientId'].'.small.png')) { ?><img src="<?=BASE_MASTER_URL;?>images/lawyerThumbs/<?=$my_db->row['clientId'];?>.small.png"  /><? } ?>
                <? if(is_file(BASE_MASTER_DIR.'images/lawyerThumbs/'.$my_db->row['clientId'].'.small.jpg')) { ?><img src="<?=BASE_MASTER_URL;?>images/lawyerThumbs/<?=$my_db->row['clientId'];?>.small.jpg" /><? } ?>
                </a>
				</div>
                
                <div style="width:200px; float:left;" class="noLawyerLawyer">
				<a href="/Divorce_Family_Law_Lawyers/<?=$my_db->row['code'];?>/<?=$my_db->row['area'];?>/">
                <h4><?=$my_db->row['name'];?></h4>
                <span><?=$my_db->row['area'];?>, <?=$my_db->row['code'];?></span></a>
				</div>
                
                <div class="noLawyerClear"></div>	
			<?
			
			}
		
		}
		else {	
		}
		?>
<div class="clear"></div>

<div id="searchArea">
    <form name="search3" action="/search_for_a_lawyer.php" method="get" id="search3" autocomplete="off" onsubmit="return getTerm3();">
    <span >Search By City</span>
    <input type="text" name="SearchTerm" class="texta" id="liveTerm3" value="" onfocus="this.value=''" onkeyup="showResult3(this.value)" autocomplete="off" /></span>
    <div id="livesearch3" style="display:none;"></div>
    </form>
</div>        
        
        
</div>

<div class="rightContent">
	<? 
	
	//Only when they are in NoLawyer I use the IP City.
	//do geo search here also.
	include('includes/ip2locationlite.class.php');
	//Load the class
	$ipLite = new ip2location_lite;
	//Get errors and locations $location = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
	$ip = (!empty($testIP)) ? $testIP : $_SERVER['REMOTE_ADDR'];
	$location = $ipLite->getResult($ip);
	
	$errors = $ipLite->getError();
	$city = (!empty($location['geolocation_data']['city'])) ? ucwords(strtolower($location['geolocation_data']['city'])) : '';
	$provFromIp = (!empty($location['geolocation_data']['region_name'])) ? ucwords(strtolower($location['geolocation_data']['region_name'])) : '';
	
	$_SESSION["adsenseBlock"]="YES";
	$_SESSION["adsenseCity"]=$city;
	//make home session link plain
	$_SESSION['homeLink'] = "http://".$_SERVER['HTTP_HOST']."/";

	include 'lawyer_window.php'; ?>
    <div class="clear"></div>
	<? include 'divorce_news.php'; ?>
     <div class="clear"></div>
</div>



<div class="clear"></div>

<? $enqScript .= "var slider2 = new Control.Slider('handle2', 'track2', {
				axis: 'vertical',
				onSlide: function(v) { scrollVertical(v, $('newsInner'), slider2);  },
				onChange: function(v) { scrollVertical(v, $('newsInner'), slider2); }
			});
if ($('newsInner').scrollHeight <= $('newsInner').offsetHeight) {
	slider2.setDisabled();
	$('wrap2').hide();
}";

include 'footer.php'; 

?>


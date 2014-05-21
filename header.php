<?php
if($_GET['debug'] == '1') {
	$ips = array(
		"BC" => "174.6.129.66",
		"ON" => "174.88.13.91",
		"ONnone" => "69.171.100.25",
		"AB" => "68.148.137.103",
		"SK" => "207.195.114.48",
		"MB" => "206.45.11.138",
		"QC" => "174.142.19.30"		
	);
	if(!empty($_GET['p'])) {
		$testIP = $ips[$_GET['p']];
	}
	else $testIP = $_GET['ip'];
}
// mobile detection. if a mobile device is detected redirect to m.impaireddriving.ca
#IGNORE MOVILE ntil MOVILE VERSION OF THIS WEB WORKS
/*
include 'includes/Mobile_Detect.php';
$detect = new Mobile_Detect();
if ($detect->isMobile() && !$detect->isTablet()) {
    header("Location: http://m.impaireddriving.ca".$_SERVER["REQUEST_URI"]);
}
*/
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 60 minutes ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

require_once 'includes/init.php';
#sendSTMLMail("manuel@delta-biz.com","","test","test");
if(empty($_SESSION["adsenseCity"]))
{ //if adsenseCity is not set, do regular function....

if(empty($_SESSION['landingCity']) && isset($_GET['city'])) {
	$city = $_GET['city'];	
}
else if(empty($_SESSION['landingCity'])) {
	// ip location
	include('includes/ip2locationlite.class.php');
 
	//Load the class
	$ipLite = new ip2location_lite;
	
	//Get errors and locations $location = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
	$ip = (!empty($testIP)) ? $testIP : $_SERVER['REMOTE_ADDR'];
	$location = $ipLite->getResult($ip);
	
	$errors = $ipLite->getError();
	$city = (!empty($location['geolocation_data']['city'])) ? ucwords(strtolower($location['geolocation_data']['city'])) : '';
	$provFromIp = (!empty($location['geolocation_data']['region_name'])) ? ucwords(strtolower($location['geolocation_data']['region_name'])) : '';
}

if(!empty($city)) {
if($_GET['debug'] == '1') { echo $city;}
	if ($city == 'Toronto1'){
		$city = 'Toronto';
		$_SESSION['myCity'] = 'Toronto1';
	}else{
		$_SESSION['myCity'] = '';
	}

	$city = str_replace('Mcmurray', 'McMurray', $city);
	$cityfile = str_replace(' ', '_', $city);
	$cityfile = trim($cityfile);
		
	//$_SESSION['adsenseCity'] = $city;
	
	$_SESSION['landingCity'] = $city;
	$_SESSION['provFromIp'] = $provFromIp;
	$_SESSION['landingLink'] = "http://".$_SERVER['HTTP_HOST']."/Divorce_Family_Law_Lawyers/PPC/".$city;
	$_SESSION['homeLink'] = "http://".$_SERVER['HTTP_HOST']."/dfl/".$_SESSION['landingCity'];
}
}else
{
	// adsenseCity is set. 
	$city=$_SESSION['adsenseCity'];
	$_SESSION['landingCity'] = $_SESSION['adsenseCity'];
	$_SESSION['landingLink'] = "http://".$_SERVER['HTTP_HOST']."/Divorce_Family_Law_Lawyers/PPC/".$_SESSION['adsenseCity'];
	$_SESSION['homeLink'] = "http://".$_SERVER['HTTP_HOST']."/dfl/".$_SESSION['landingCity'];

}

header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?= str_replace("{city}",$city,$title); ?></title>

<meta name="description" content="<? if(!empty($metaDesc)) { echo str_replace("{city}",$city,$metaDesc); } else { echo $title." - Divorce Family Law Lawyers Information."; } ?> " />

<meta name="keywords" content="personal injury lawyer, medical malpractice lawyer, medical negligence lawyer, slip and fall, automobile accident lawyer, injury lawyer, car accident lawyer, icbc lawsuit, whiplash, soft tissue damage, motor vehicle accident, mva" />

<meta name="google-site-verification" content="XaVoZ0iDoZ7wkxWfOs_o4KldzNpF1N_3bUw9FaGDceY" />
<meta name="google-site-verification" content="Fia9uwKMw3j5GeOO_VoJjq7UZVW8NZcG3-Xm4wSaVg8" />
<link href="/css/reset.css" rel="stylesheet" type="text/css" />

<link href="/css/baseStyles.css?v=3" rel="stylesheet" type="text/css" />

<link href="/css/viewbox.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>

<link rel="shortcut icon" href="<?=BASE_URL;?>favicon.ico" />

<script src="/js/prototype.js" type="text/javascript"></script>
<script src="/js/scriptaculous.js" type="text/javascript"></script>
<script src="/js/lightbox.js"  type="text/javascript"></script>
<script src="/js/functions.js"  type="text/javascript"></script>
<script src="/js/viewbox.js"  type="text/javascript"></script>
<script src="/js/videoPlayer-min.js" type="text/javascript"></script>
<script src="/js/MF_RunActiveContent.js" type="text/javascript"></script>
<script type='text/javascript' src='/js/jwplayer.js'></script>
<script src="http://jwpsrv.com/library/pAaLnDhYR0EbhIVgHNgdp8lTM+LpP0y/T+LFVw==.js" ></script>

<script type="text/javascript">
function showSubmit2(){
	if($('read').checked){
		$('submit').enable(); 
	}else{
		$('submit').disable(); 
	}
}

function checkForm(){
	if (($('senderName').value != '') && ($('senderEmail').value != '') && ($('senderPhone').value != '')){
	
		window.alert('Thank you for submitting your information. Please expect to be contacted in the manner you requested.');
		
		$('LawyerContactRequest').submit();
	}else{
		window.alert('Please fill in all the required fields');
	}
}
</script>
<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36403885-1']);
  _gaq.push(['_trackPageview']);
  setTimeout("_gaq.push(['_trackEvent', '20_seconds', 'read'])",20000);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>

</head>



<body>

<div id="header">
	<div class="outer">
    <div id="bannerbg">&nbsp;</div>
	<?
	if(!empty($noLawyer))
	{
		?>
		<section id="namebar"><div class="wrap">&nbsp;</div></section>
		<?
	unset($noLawyer);
	}else
	{
		$regionId = $db->result("SELECT regionId FROM `areas` WHERE name LIKE '".$_SESSION['landingCity']."' LIMIT 0,1");
		if(empty($regionId)) {
		$regionId = $db->result("SELECT regionId FROM `regions` WHERE name LIKE '".ucwords(strtolower($provFromIp))."' LIMIT 0,1");
		}
		$db->query("SELECT DISTINCT clients.*,areas.name as area,regions.name as region,regions.code as code FROM clients,areas,regions WHERE clients.siteId='10' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND areas.regionId = '".$regionId."'");
		//echo "SELECT DISTINCT clients.*,areas.name as area,regions.name as region,regions.code as code FROM clients,areas,regions WHERE clients.siteId='1' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND areas.regionId = '".$regionId."'";
		if (isset($_SESSION['landingCity']) && $db->numRows > 0 ){
		include 'headerLinks.php';
		}else{
		$showSearch = true;
		}
		if(!isset($_SESSION['landingCity']) || $showSearch == true){ 
		$_SESSION["adsenseBlock"]="YES";
		//show empty wrap/
		?>
		<section id="namebar"><div class="wrap">&nbsp;</div></section>
		<?
		}
	}
	?>
    <div id="logoBox"><div id="divorceandfamily"></div><div id="cityholder"><? include("cityHolder.php");?></div></div>	
	<?php include 'menu.php'; ?>
	</div>
</div><!--header-->
<div class="clear"></div>
<div id="fullouter">
<div id="preouter">
<div class="outer" id="outer">
	<div class="inner" id="inner">
<div id="mainContent" class="mainContent">

<div id="homeUpper">
<div id="bannerPageInfo">
<h2><? echo str_replace("{city}",$city,$bannerTittle); ?></h2>
<div id="watchourvideos"><a href="Javascript:void(0);" onclick="jwplayer().play();">Watch this video</a></div>
<h3><? echo str_replace("{city}",$city,$banner); ?></h3>
</div>

<div id="homeUpperVideo">
<div id='videoFrame'>Unable to load video.</div>
<?
if(!empty($video))
{
?>
<script type='text/javascript'>
		  jwplayer('videoFrame').setup({
			modes: [
			{ type: 'html5' },
			{ type: 'flash', src: '/player/player.swf' }
			],
			file: '/videos/html5/<?=$video;?>',
			skin: "/player/deltabiz/deltabiz.xml",
			image: '/videoThumbs/<?=$image;?>',
			controlbar: 'bottom',
			width: '388',
			height: '266',	
			frontcolor: '000000',
			lightcolor: '333333',
			screencolor: '396f8f',
			stretching: 'exactfit'
		  });
		</script>
<? } ?>
</div>
</div>
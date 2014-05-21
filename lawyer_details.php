<?php
session_start();
require_once 'includes/init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $title; ?></title>
<meta name="description" content="<? if(!empty($metaDesc)) { echo $metaDesc; } else { echo $title." - Divorce Family Law Website and Divorce Family  Lawyers Information."; } ?> " />
<meta name="keywords" content="<?= implode(",",$keywords);?>" />
<link href="/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/css/baseStyles.css" rel="stylesheet" type="text/css" />
<link href="/css/viewbox.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript" src="/js/scriptaculous.js"></script>
<script src="/js/lightbox.js"  type="text/javascript"></script>
<script src="/js/functions.js"  type="text/javascript"></script>
<script src="/js/viewbox.js"  type="text/javascript"></script>
<script src="/js/videoPlayer-min.js" type="text/javascript"></script>
<script src="/js/MF_RunActiveContent.js" type="text/javascript"></script>
<script type='text/javascript' src='/js/jwplayer.js'></script>
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
</head>
<body>
<div id="header" >
	<div class="outer">
    <div id="bannerbg">&nbsp;</div>
	<?
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
			//show empty wrap/
			?>
			 <section id="namebar"><div class="wrap">&nbsp;</div></section>
			<?
			}
			
	?>
    <div id="logoBox"><div id="divorceandfamily"></div><div id="cityholder"><? include("cityHolder.php");?></div></div>	
	<?php include 'menu.php'; ?>
	</div>
</div>
<div class="clear"></div>

<div id="fullouter">
<div id="preouter">
<div class="outer" id="outer">
	<div class="inner" id="inner">
<div id="mainContent" class="mainContent">
	<? include "lawyer_info.php" ?>
</div>
	</div>
</div>
</div>
</div>    
  
<div class="outer" id="outer">
	<div class="inner" id="inner">
<div id="mainContent" class="mainContent">
<!-- Google Code for Profile Page Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 998459318;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "PBnqCOKY4wMQto-N3AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/998459318/?value=0&amp;label=PBnqCOKY4wMQto-N3AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</div>

<div class="clear"></div>

<? include 'footer.php';  ?>


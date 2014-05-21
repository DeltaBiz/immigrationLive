<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 60 minutes ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
//check if set landing page, if so, set the session
if(!empty($city2header))
{
	$_SESSION["landingCity"]=$city2header;
	$_SESSION["homeLink"]=$link2header;
}
require_once 'includes/init.php';
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
		if (!empty($_SESSION['landingCity']))
		{
			include 'headerLinks.php';
			if($showSearch != true)
			{ // In some cases in headerlinks can be set as true, and need to be kept as true.
			$showSearch = false;
			}else
			{
			echo '<section id="namebar"><div class="wrap">&nbsp;</div></section>';
			}
		}
		else{ 
		$_SESSION["adsenseBlock"]="YES";
		$showSearch = true;
		?>
		<section id="namebar"><div class="wrap">&nbsp;</div></section>
		<?
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
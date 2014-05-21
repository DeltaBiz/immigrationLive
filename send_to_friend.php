<?php
require_once 'includes/init.php';
$title = "Send to a friend - DivorceFamilyLaw.ca";

$sendURL = (isset($_REQUEST['sendURL'])) ? $_REQUEST['sendURL'] : "".BASE_URL."";


if(isset($_POST['sendURL']) && $_POST['sendURL'] != '' && isset($_POST['senderName'])&& $_POST['senderName'] != '' && isset($_POST['sendeeName']) && $_POST['sendeeName'] != '' && isset($_POST['sendeeEmail'])&& $_POST['sendeeEmail'] != '') {
	$msg = "\n\r\n\r <br /><br />Dear ".$_POST['sendeeName'].",\n\r\n\r <br /><br /> The following link has been suggested to you by ".$_POST['senderName'].": \n\r\n\r <br /><br /><a href='".urldecode($_POST['sendURL'])."'>".urldecode($_POST['sendURL'])."</a>\n\r\n\r <br /><br /><strong>Message:</strong> ".$_POST['message']." \n\r\n\r <br /><br />ImpairedDriving.ca - A site dedicated to providing good information when you have been charged with Impaired Driving.  Learn about the charge against you and talk to a lawyer today.<br><br> Thank You.";
	/*$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: info@impaireddriving.ca' . "\r\n" .
    'Reply-To: info@impaireddriving.ca' . "\r\n" .
    'X-Mailer: PHP/' . phpversion(); */
	#mail($_POST['sendeeEmail'],'The following link has been suggested to you by a friend.', $msg,$headers);	
	sendSTMLMail($_POST['sendeeEmail'],"info@divorcefamilylaw.ca","The following link has been suggested to you by a friend.",$msg);
	$output = 'Thank you for sending the link!';
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?= $title; ?></title>

<meta name="description" content="<? if(!empty($metaDesc)) { echo $metaDesc; } else { echo $title." - Divorce Family Law"; } ?> " />

<meta name="keywords" content="<?= implode(",",$keywords);?>" />

<meta name="google-site-verification" content="XaVoZ0iDoZ7wkxWfOs_o4KldzNpF1N_3bUw9FaGDceY" />
<meta name="google-site-verification" content="Fia9uwKMw3j5GeOO_VoJjq7UZVW8NZcG3-Xm4wSaVg8" />
<link href="/css/reset.css" rel="stylesheet" type="text/css" />

<link href="/css/baseStyles.css" rel="stylesheet" type="text/css" />

<script src="/js/prototype.js" type="text/javascript"></script>

<script src="/js/scriptaculous.js" type="text/javascript"></script>

<script src="/js/videoPlayer.js" type="text/javascript"></script>

<script src="/js/MF_RunActiveContent.js" type="text/javascript"></script>

<script src="/js/functions.js"  type="text/javascript"></script>

</head>
<body style="width:600px;">

<style>
label { float:left; height:15px; width:100px; font-weight:bold; padding-left:30px; }
strong { font-weight:bold; }
a:link,a { color:#333; text-decoration:underline; }
#EmailMsg { width:580px; padding:20px; margin-bottom:30px; border:1px dotted #ccc; text-align:left;}
textarea { width:500px; }
</style>

<div id="search" style="width:670px; height:480px; margin-top:30px; overflow:auto;">

  <div id="homeColumnTwo">


    <? if($output != '') { echo '<h1>'.$output.'</h1>'; } else {?>
    
    <h1>Send a link to a friend</h1>
    <p>Fill out this form to recommend the selected page to a friend.</p>
    <form name="sendToFriend" method="post">
    <div style="width:600px; text-align:left;">
        <p><input type="hidden" name='sendURL' id="sendURL" value="<?=$sendURL;?>" /><strong>Selected Page:</strong> <?=urldecode($sendURL);?></p>
    <label>*Your Name:</label> <input type="text" id="senderName" name="senderName" value="<?= $_POST['senderName']; ?>" onchange="updateEmailMsg()" /><br /><br /><br />
    <label>*To (name):</label> <input type="text" id="sendeeName" name="sendeeName" value="<?= $_POST['sendeeName']; ?>" onchange="updateEmailMsg()" /><br /><br /><br />
    <label>*To (email):</label> <input type="text" id="sendeeEmail" name="sendeeEmail" value="<?= $_POST['sendeeEmail']; ?>" onchange="updateEmailMsg()" /><br /><br /><br />
    <label>Message:</label> <textarea id="message" name="message" onchange="updateEmailMsg()" ><?= $_POST['message']; ?></textarea><br /><br />
    </div>
    <hr />
    <p>Preview:</p>
    <div id="EmailMsg"></div>
	<input type="submit" name="submit" value="Send Message" style="width:120px; height:30px;" />
    </form>
<script>
function updateEmailMsg() {
	var msg  = '<strong>Subject:</strong> The following link has been suggested to you by a friend.<br /><br /><strong>To:</strong> &lt;'+$('sendeeName').value+' - '+$('sendeeEmail').value+'&gt;<br /><br /> Dear '+$('sendeeName').value+',<br /><br / > The following link has been suggested to you by '+$('senderName').value+': <br /><br /><a href="'+$('sendURL').value+'">'+$('sendURL').value+'</a><br /><br /><strong>Message:</strong> '+$('message').value+' <br /><br />ImpairedDriving.ca - A site dedicated to providing good information when you have been charged with Impaired Driving.  Learn about the charge against you and talk to a lawyer today.<br><br> Thank You.';
	$('EmailMsg').innerHTML = msg;
}
</script>		

        <? } ?>

</div>


</div>
</body>
</html>


<?php

$title = "Contact a Lawyer - divorcefamilylaw.ca";

if (isset($_GET['ID'])) $_POST['lawyerID'] = $_GET['ID'];

require_once 'includes/init.php';

if(isset($_POST['lawyerID']) && $_POST['lawyerID'] != '' && isset($_POST['senderName'])&& $_POST['senderName'] != '' && isset($_POST['senderEmail']) && $_POST['senderEmail'] != '' && isset($_POST['senderPhone'])&& $_POST['senderPhone'] != '') {
$db->query( "SELECT clients.* FROM clients WHERE clients.clientId=".$_POST['lawyerID']." LIMIT 0,1");
	if( $db->nextRow() ) {
		$lawyer = $db->row;
		$db->query( "SELECT areas.* FROM areas WHERE areas.areaId=".$lawyer['areaId']." LIMIT 0,1");
		if( $db->nextRow() ) {
			$area = $db->row;
		}
	}
 
	$msg = "\n\r\n\r <br /><br />The following information was submitted through the contact form on divorcefamilylaw.ca.\n\r\n\r <br /><br />Lawyer:".$lawyer['name']." \n\r\n\r <br /><br /> Location:".$area['name']." \n\r\n\r <br /><br /> Name: ".$_POST['senderName'].": \n\r\n\r <br /><br />Email:".$_POST['senderEmail']."\n\r\n\r <br /><br />Phone:".$_POST['senderPhone']."\n\r\n\r <br /><br />Preferred Contact Method:".$_POST['contactMethod']."\n\r\n\r <br /><br />Contact Time:".$_POST['contactTime']."\n\r\n\r <br /><br />Message:".$_POST['message']."\n\r\n\r <br /><br /> Thank You.";
/*	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Rainmark Mgt Inc<info@impaireddriving.ca>' . "\r\n" .
	$headers .= 'BCC: info@impaireddriving.ca' . "\r\n" .
    'Reply-To: info@impaireddriving.ca' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();	
*/	
	//sendSTMLMail("manuel@delta-biz.com","info@divorcefamilylaw.ca","Contact_a_lawyer.",$msg);
	sendSTMLMail($lawyer['email'],"info@divorcefamilylaw.ca","The following information was submitted through the contact form on divorcefamilylaw.ca.",$msg);
	$output = 'Thank you.';
}

header('Content-type: text/html; charset=UTF-8');


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?= $title; ?></title>

<meta name="description" content="<? if(!empty($metaDesc)) { echo $metaDesc; } else { echo $title." - Impaired Driving Law Website and DUI Lawyers Information."; } ?> " />

<meta name="keywords" content="<?= implode(",",$keywords);?>" />

<meta name="google-site-verification" content="XaVoZ0iDoZ7wkxWfOs_o4KldzNpF1N_3bUw9FaGDceY" />
<meta name="google-site-verification" content="Fia9uwKMw3j5GeOO_VoJjq7UZVW8NZcG3-Xm4wSaVg8" />
<link href="/min/g=cssAll" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='/min/g=jsAll'></script>

</head>

<body style="width:600px;">

<style>
label { float:left; height:10px; width:100px; font-weight:bold; padding-left:30px; }
strong { font-weight:bold; }
a:link,a { color:#333; text-decoration:underline; }
textarea { width:500px; }
</style>

<div id="search" style="width:670px; height:480px; margin-top:30px; overflow:auto;">

  <div id="homeColumnTwo">

    <? if($output != '') { echo '<h1>'.$output.'</h1>'; } else {?>
    
    <h1>Lawyer Contact Request</h1>
    <p><strong>Please fill out the form below and press the submit button. This information will be forwarded to the lawyer you selected.</strong>	The information you provide in this form will only be used so that we can contact you, and will not be shared with anyone for any other purpose.</p>
    <form name="LawyerContactRequest" method="post">
    <div style="width:600px; text-align:left;">
        <p><input type="hidden" name='lawyerID' id="lawyerID" value="<?=$_POST['lawyerID'];?>" /></p>
    <label>*Name:</label> <input type="text" id="senderName" name="senderName" value="<?= $_POST['senderName']; ?>"  /><br /><br /><br />
    <label>*Email Adress:</label> <input type="text" id="senderEmail" name="senderEmail" value="<?= $_POST['senderEmail']; ?>"  /><br /><br /><br />
    <label>*Phone Number:</label> <input type="text" id="senderPhone" name="senderPhone" value="<?= $_POST['senderPhone']; ?>"  /><br /><br /><br />
    <p>* indicates mandatory fields</p>
    
    <label style="width:250px;">Contact Preference:</label><br /><br />
    <label style="text-align:right;">Email:</label><input type="radio" id="contactMethod" name="contactMethod" value="Email" checked="checked" /><br /><br /> 
    <label style="text-align:right;">Phone:</label><input type="radio" id="contactMethod" name="contactMethod" value="Phone" /><br /><br /><br />
    <label>When can we contact you?</label> <input type="text" id="contactTime" name="contactTime" value="<?= $_POST['contactTime']; ?>"  /><br /><br /><br />
    <p><strong>Briefly describe your legal issue:</strong><br />
    (Information such as custody, access, divorce etc. Have you been served with papers? Do you have an upcoming court appearance?)</p>
     <textarea id="message" name="message"  ><?= $_POST['message']; ?></textarea>
    <p>The use of the Internet or this form for communication does not establish a lawyer-client relationship. Confidential or time-sensitive information should not be sent through this form. </p>
    <p><input type="checkbox" name="read" id="read" onchange="showSubmit();" />I have read and understand the disclaimer.<input type="submit" id="submit" name="submit" value="Send Message" style="width:120px; height:30px; margin-left:15px; float:right; display:none;" /></p>
    
    
        </div>
	
    </form>
<script>
function showSubmit() { 
	if($('read').checked) { $('submit').show(); } 
}
</script>
        <? } ?>



</div>


</div>
</body>
</html>


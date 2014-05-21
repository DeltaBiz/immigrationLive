<?
require_once 'includes/init.php';
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
label { float:left; height:10px; width:100px; font-weight:bold; padding-left:30px; }
strong { font-weight:bold; }
a:link,a { color:#333; text-decoration:underline; }
textarea { width:500px; }
</style>

<div id="search" class="formPopup">

  <div id="homeColumnTwo">

    <? if($output != '') { echo '<h1>'.$output.'</h1>'; } else {?>
    
 <h1>Lawyer Contact Request</h1>
    <p><strong>Please fill out the secure form below and press the "Send Message" button. This information will be forwarded to the lawyer you selected.</strong> The information you provide in this form will only be used so that we can contact you, and will not be shared with anyone for any other purpose.</p>
    <p>* indicates mandatory fields.</p>
	<form name="LawyerContactRequest" id="LawyerContactRequest" method="post">
    <div style="width:100%; text-align:left;">
    <input type="hidden" name='lawyerID' id="lawyerID" value="<?=$_POST['lawyerID'];?>" />
	
	<table id="myForm">
		<tr>
			<td class="left">*Name:</td><td style="vertical-align:middle;"><input type="text" id="senderName" name="senderName" value="<?= $_POST['senderName']; ?>"  /></td>
		</tr>
		<tr>
			<td class="left">*Email Adress:</td><td><input type="text" id="senderEmail" name="senderEmail" value="<?= $_POST['senderEmail']; ?>"  /></td>
		</tr>
		<tr>
			<td class="left">*Phone Number:</td><td><input type="text" id="senderPhone" name="senderPhone" value="<?= $_POST['senderPhone']; ?>"  /></td>
		</tr>
		<tr>
			<td class="left" style="margin-top:20px;">Contact Preference:</td>
			<td class="radio">
				<span style="width:40px; height:20px; margin: 5px 0;  display:block; float:left;">Email:</span><input type="radio" id="contactMethod" name="contactMethod" value="Email" checked="checked" /><br/>
				<span style="width:40px; height:20px; margin: 5px 0;  display:block; clear:left; float:left;">Phone:</span><input type="radio" id="contactMethod" name="contactMethod" value="Phone" />
			</td>
		</tr>
		<tr>
			<td class="left">When can we contact you?</td><td><input type="text" id="contactTime" name="contactTime" value="<?= $_POST['contactTime']; ?>"  /></td>
		</tr>
		<tr>
			<td class="left">Briefly describe your legal issue:<br/><span style="font-weight:normal; font-size:11px;">(Information such as custody, access, divorce etc. Have you been served with papers? Do you have an upcoming court appearance?)</span></td>
			<td><textarea id="message" name="message"  ><?= $_POST['message']; ?></textarea></td>
		</tr>
	</table>
    <p><center>The use of the Internet or this form for communication does not establish a lawyer-client relationship. Confidential or time-sensitive information should not be sent through this form.</center></p>
   
   <p style="text-align:left;"><input type="checkbox" name="read" id="read" onClick="showSubmit2();" style="width:35px; margin-bottom:10px; margin-top:0px;" />I have read and understand the disclaimer.<input type="submit" id="submit" name="submit" onClick="checkForm(); return false;" DISABLED value="Send Message" style="width:120px; height:30px; margin-left:15px; float:right;" /></p>
    
    
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


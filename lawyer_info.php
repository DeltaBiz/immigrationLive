<?php
$_POST['lawyerID'] = $lawyer['clientId'];
require_once 'includes/init.php';
if (isset($_GET['ID'])) $_POST['lawyerID'] = $_GET['ID'];

$lawyer['clientId'] = $_POST['lawyerID'];
$db->query( "SELECT clients.*, areas.name as area,regions.name as region FROM clients,areas,regions WHERE clients.areaId=areas.areaId AND areas.regionId=regions.regionId AND clients.clientId=".$_POST['lawyerID']." LIMIT 0,1");
	if( $db->nextRow() ) {
		$lawyer = $db->row;

		if(isset($_POST['lawyerID']) && $_POST['lawyerID'] != '' && isset($_POST['senderName'])&& $_POST['senderName'] != '' && isset($_POST['senderEmail']) && $_POST['senderEmail'] != '' && isset($_POST['senderPhone'])&& $_POST['senderPhone'] != '') {

		$db->query( "SELECT areas.* FROM areas WHERE areas.areaId=".$lawyer['areaId']." LIMIT 0,1");
		if( $db->nextRow() ) {
			$area = $db->row;
		}
 
	$msg = "\n\r\n\r <br /><br />The following information was submitted through the contact form on divorcefamilylaw.ca.\n\r\n\r <br /><br />Lawyer:".$lawyer['name']." \n\r\n\r <br /><br /> Location:".$area['name']." \n\r\n\r <br /><br /> Name: ".$_POST['senderName'].": \n\r\n\r <br /><br />Email:".$_POST['senderEmail']."\n\r\n\r <br /><br />Phone:".$_POST['senderPhone']."\n\r\n\r <br /><br />Preferred Contact Method:".$_POST['contactMethod']."\n\r\n\r <br /><br />Contact Time:".$_POST['contactTime']."\n\r\n\r <br /><br />Message:".$_POST['message']."\n\r\n\r <br /><br /> Thank You.";
	//sendSTMLMail("manuel@delta-biz.com","info@divorcefamilylaw.ca","lawyer_info.",$msg);
	sendSTMLMail($lawyer['email'],"info@divorcefamilylaw.ca","The following information was submitted through the contact form on divorcefamilylaw.ca.",$msg);
	
	$output = 'Thank you.';
	
	$myquery = "INSERT INTO report_can (site, lawyerName, lawyerLocation, name, email, phone, contact_pref, contact_when, message) VALUES ";
	$myquery .= "('divorcfamilylaw.ca','".$lawyer['name']."', '".$area['name']."','".$db->sanitize($_POST['senderName'])."','".$db->sanitize($_POST['senderEmail'])."','".$db->sanitize($_POST['senderPhone'])."','".$db->sanitize($_POST['contactMethod'])."','".$db->sanitize($_POST['contactTime'])."','".$db->sanitize($_POST['message'])."')";
	$db->query($myquery);
	//echo $myquery;
}
	
}


//print_r($lawyer);?>
<div id="lawyerUpper">

	<div id="lawyerInfo">
		
		<h1><?= $city;?> Lawyers</h1>
		
		<h2><?= spanWrapWords($lawyer['name']); ?></h2>

		<div id="lawyerLeft">

        <p><?= $lawyer['firmName']; ?></p>
		<br />

        <p><?= $lawyer['address2']." ".$lawyer['address1']."<br />".$lawyer['area'].", ".$lawyer['region']."<br />".$lawyer['addressZip']; ?></p>
        
		<br /><br />
        <p>
        
        <? if($lawyer['phoneLocal'] != '') { $displayPhone = $lawyer['phoneLocal']; echo '<span>LOCAL PHONE:</span> '.$lawyer['phoneLocal']. '<br /> <br />'; }?>

        <? if($lawyer['phoneTollFree'] != '') { if (empty($displayPhone)){$displayPhone = $lawyer['phoneTollFree'];} echo '<span>TOLL FREE:</span> '.$lawyer['phoneTollFree'].'<br />'; }?>

        <? if($lawyer['phoneFax'] != '') { echo '<span>FAX:</span> '.$lawyer['phoneFax'].'<br />'; }?>

        <? if($lawyer['phoneAfterHours'] != '') { echo '<span>AFTER HOURS:</span> '.$lawyer['phoneAfterHours'].'<br />'; }?>

        </div>

		<div id="lawyerRight">
        	<h3 style='margin-top:-25px;'>Call Now!	<br/><?= $displayPhone;?> </h3>
        	<h2><a href="/contact_a_lawyer2.php?ID=<?=$lawyer['clientId'];?>" rel="viewbox" style="color:#ffffff; display:block; height:100%; width:100%;">Click Here To Submit Information</a></h2>
        </div>
		
     </div>

    <div id="lawyerUpperVideo">
    <!-- Video Player Here -->
	<?//echo $lawyer['clientId'];?>
<? if ((is_file(BASE_DIR."lawyerVideos/".$lawyer['clientId'].".flv")) && ($lawyer['clientId'] == 1)) { ?>
		<center><script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 266, 300, "../lawyerVideos/<?=$lawyer['clientId'];?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script></center>
<? }
	else if ((is_file(BASE_DIR."lawyerVideos/".$lawyer['clientId'].".flv")  && (($lawyer['clientId'] == 88) || ($lawyer['clientId'] == 213) || ($lawyer['clientId'] == 108) || ($lawyer['clientId'] == 11) || ($lawyer['clientId'] == 110) || ($lawyer['clientId'] == 12) || ($lawyer['clientId'] == 188) ))) { ?>
    <script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 350, 300, "../lawyerVideos/<?=$lawyer['clientId'];?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script>
<? }
else if ((is_file(BASE_DIR."lawyerVideos/".$lawyer['clientId'].".flv")  && ( ($lawyer['clientId'] == 121) ))) { ?>
    <script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 350, 300, "../lawyerVideos/<?=$lawyer['clientId'];?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script>
<? }
	else if (is_file(BASE_DIR."lawyerVideos/".$lawyer['clientId'].".flv") ) { ?>
    <script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 400, 300, "../lawyerVideos/<?=$lawyer['clientId'];?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script>
<? }
	else if(is_file(BASE_MASTER_DIR."images/lawyerThumbs/".$lawyer['clientId'].".png") && !is_file(BASE_DIR."lawyerVideos/".$lawyer['clientId'].".flv")) {?>
    <div style="text-align:center; width:360px; height:300px; padding: 0 40px 0 0; vertical-align:middle;"><img src="<?= BASE_MASTER_URL ?>/images/lawyerThumbs/<?=$lawyer['clientId'];?>.png" /></div>
    <? } 
    else if(is_file(BASE_MASTER_DIR."images/lawyerThumbs/".$lawyer['clientId'].".jpg")) {?>
    <div style="text-align:center; width:360px; height:300px; padding: 0 40px 0 0; vertical-align:middle;"><img src="<?= BASE_MASTER_URL ?>/images/lawyerThumbs/<?=$lawyer['clientId'];?>.jpg" /></div>
    <? } 
	else{
	?>
		<div style="margin: 0 auto; margin-top:70px; color:#3c7190; text-align:center; font-size: 36px; font-style: normal; font-weight: bold; letter-spacing: 1.15px; line-height: 46px;">
		Law Office<br/>of<br/><?= spanWrapWords($lawyer['name']); ?>
		</div>
	<?
	}
	?>
    </div>

</div>

<div class="leftContent"><?= $lawyer['biography'];?></div>
<div class="rightContent">
<? include 'actionBarNew.php';?>
<div id="map" style=" margin-top:40px;width: 350px; height: 300px; border:2px solid #ccc;-moz-border-radius: 8px;-webkit-border-radius: 8px;"></div>
<br />

<? if($lawyer['hours'] != '') { echo '<p><span>HOURS:</span>  '.$lawyer['hours'].'</p>';}?>

<? if($lawyer['parking'] != '') { echo '<p><span>PROXIMITY TO PARKING: </span>'.$lawyer['parking'].'</p>';} ?>

<? if($lawyer['publicTransit'] != '') { echo '<P><span>PUBLIC TRANSPORTATION: </span>'.$lawyer['publicTransit'].'</P>'; }?>

	 <? if($lawyer['languages'] != '') { echo '<p><span>LANGUAGES:</span>  '. $lawyer['languages'].'<br />';}?>

        <? if($lawyer['website'] != '') { echo '<p><span>WEBSITE:</span>   <a href="http://'. $lawyer['website']. '" target="_blank">'.$lawyer['website'].'</a></p>';}?>

        <? //if($lawyer['email'] != '') { echo '<span>EMAIL ADDRESS: </span> <a href="mailto:'. $lawyer['email'] .'" target="_blank">'.$lawyer['email'].'</a>  </p>';}?>

<br />


</div> 

<div class="clear"></div>

<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBKhsID6K3ldll99UppHJdbhOrS3Fn8IZA&sensor=false" type="text/javascript"></script>


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
<script>

	var map = new GMap2($("map"));

	var geocoder = new GClientGeocoder();

	showAddress("<?= $lawyer['addressZip'];?>","<?= $lawyer['address2']." ".$lawyer['address1']."<br />".$lawyer['area'].", ".$lawyer['region']."<br />".$lawyer['addressZip']; ?>","<p><?= $lawyer['firmName']; ?></p>");

	map.setUIToDefault();

</script>
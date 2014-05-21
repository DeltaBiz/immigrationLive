<?
require_once 'includes/init.php';
$my_db = clone $db;
$my_areaId = $my_db->result("SELECT areaId FROM `areas` WHERE name LIKE '".$_SESSION['landingCity']."' LIMIT 0,1");
$my_parentCityid = $my_db->result("SELECT majorAreaId FROM `areas` WHERE name LIKE '".$_SESSION['landingCity']."' LIMIT 0,1");

if($my_parentCityid !== FALSE && $my_parentCityid != '') {
	$my_parentCity = strtolower($my_db->result("SELECT name FROM `areas` WHERE areaID='".$my_parentCityid."' LIMIT 0,1"));	
	$my_where = "clients.areaId IN (".$my_areaId.",".$my_parentCityid.")";
}
else {
	$my_where = "clients.areaId='".$my_areaId."'";
}

$my_db->query("SELECT DISTINCT clients.*,areas.name as area,regions.name as region, regions.code as regioncode FROM clients,areas,regions WHERE clients.siteId='10' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND ".$my_where." ORDER BY RAND()*(IF( clients.clientId=10,3,2)) DESC LIMIT 1");
if($my_db->numRows == 1 ) {
	$_SESSION["firstTime"]="NO";
	$my_lawyer = $my_db->nextRow();
	$phoneFull = trim($my_lawyer['phoneLocal']); 
	if (empty($phoneFull)){
		$phoneFull = trim($my_lawyer['phoneTollFree']);
	}
	//Selected a city. Remove $_SESSION adsenseBlock
	$_SESSION["adsenseBlock"]="NO";
	unset($_SESSION["adsenseBlock"]);
	unset($_SESSION["adsenseCity"]);
	?>
    <section id="namebar">
        <div class="wrap">
            <a href="/lawyer_details/?ID=<? echo $my_lawyer['clientId']; ?>"><?= ucwords($my_lawyer['name']); ?></a>
            <h1 class="name"><?= ucwords($my_lawyer['name']); ?></h1>
            <p class="contact"><span class="label">Call Now!</span> <span class="number"><? echo $my_lawyer['phoneLocal']; ?></span></p>
            <!--<p class="consultation"><span class="uc">Free</span> Consultation</p>-->
        </div>
    </section>
	<?			
}else{
	// set adsenseBlock
	$_SESSION["adsenseBlock"]="YES";
	//if is the firsttime on site and there are other lawyer in the same province, do not redirect. Just keep in home page.	
	if($isHome=="YES")
	{
		$showSearch = true;
	} 
	if($_SERVER["SCRIPT_NAME"] !== "/noLawyer.php" && $isHome!="YES" && $my_db->numRows == 0 ) {
		//give value to firsttime session
		/*
		echo "<script>location.href='/noLawyer.php';</script>";
		*/
		$showSearch = true;
	}
	
}

if (isset($_GET['ID'])) $_POST['lawyerID'] = $_GET['ID'];
$_POST['lawyerID'] = $my_lawyer['clientId'];

if((isset($_POST['lawyerID']) && $_POST['lawyerID'] != '' && isset($_POST['senderName'])&& $_POST['senderName'] != '' && isset($_POST['senderEmail']) && $_POST['senderEmail'] != '' && isset($_POST['senderPhone'])&& $_POST['senderPhone'] != '') &&  ($page != 'find')){
$db->query( "SELECT clients.* FROM clients WHERE clients.clientId=".$_POST['lawyerID']." LIMIT 0,1");
	if( $db->nextRow() ) {
		$lawyer = $db->row;
		$db->query( "SELECT areas.* FROM areas WHERE areas.areaId=".$lawyer['areaId']." LIMIT 0,1");
		if( $db->nextRow() ) {
			$area = $db->row;
		}
	}
 
	$msg = "\n\r\n\r <br /><br />The following information was submitted through the contact form on divorcefamilylaw.ca.\n\r\n\r <br /><br />Lawyer:".$lawyer['name']." \n\r\n\r <br /><br /> Location:".$area['name']." \n\r\n\r <br /><br /> Name: ".$_POST['senderName'].": \n\r\n\r <br /><br />Email:".$_POST['senderEmail']."\n\r\n\r <br /><br />Phone:".$_POST['senderPhone']."\n\r\n\r <br /><br />Preferred Contact Method:".$_POST['contactMethod']."\n\r\n\r <br /><br />Contact Time:".$_POST['contactTime']."\n\r\n\r <br /><br />Message:".$_POST['message']."\n\r\n\r <br /><br /> Thank You.";
	/*$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Rainmark Mgt Inc<info@impaireddriving.ca>' . "\r\n" .
	$headers .= 'BCC: info@impaireddriving.ca' . "\r\n" .
	//$headers .= 'BCC: tim@delta-biz.com' . "\r\n" .
    'Reply-To: info@impaireddriving.ca' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();*/
	//mail('tim@delta-biz.com','The following information was submitted through the contact form on impaireddriving.ca.', $msg,$headers);	
	//sendSTMLMail("manuel@delta-biz.com","info@divorcefamilylaw.ca","headerlinks.",$msg);
	sendSTMLMail($lawyer['email'],"info@divorcefamilylaw.ca","The following information was submitted through the contact form on divorcefamilylaw.ca.",$msg);
	
	$output = 'Thank you.';
	
	$myquery = "INSERT INTO report_can (site, lawyerName, lawyerLocation, name, email, phone, contact_pref, contact_when, message) VALUES ";
	$myquery .= "('divorcefamilylaw.ca','".$lawyer['name']."', '".$area['name']."','".$db->sanitize($_POST['senderName'])."','".$db->sanitize($_POST['senderEmail'])."','".$db->sanitize($_POST['senderPhone'])."','".$db->sanitize($_POST['contactMethod'])."','".$db->sanitize($_POST['contactTime'])."','".$db->sanitize($_POST['message'])."')";
	$db->query($myquery);
	//echo $myquery;
	
}else if ($_SESSION['landingCity'] == 'Peace River'){
	//echo 'no';
	//print_r($_POST);
}

?>
<?php
ob_start();
require_once 'includes/init.php';
$title = "Find a divorce family law lawyer today - divorcefamilylaw.ca";
$page = "find";
$extraclassfound="";
if(!empty($_REQUEST['prov']))
{
	$prov = $cities = $db->result("SELECT name FROM regions WHERE code='".$_REQUEST['prov']."'");
}
else $Gsearch = true;

$searchTerm = (isset($_REQUEST['city'])) ? ucwords($_REQUEST['city'])." Lawyers" : "Divorce Family Law lawyers";

$location = (isset($_REQUEST['city'])) ? strtolower($_REQUEST['city']) : $Gsearch = true;
$areaId = $db->result("SELECT areaId FROM `areas` WHERE name LIKE '".$location."' LIMIT 0,1");
$parentCityid = $db->result("SELECT majorAreaId FROM `areas` WHERE name LIKE '".$location."' LIMIT 0,1");

if($areaId === FALSE && $Gsearch === FALSE) {
	echo 'The selected area is not in our database.';	
	exit;
}

if($parentCityid !== FALSE && $parentCityid != '') {
	$parentCity = strtolower($db->result("SELECT name FROM `areas` WHERE areaID='".$parentCityid."' LIMIT 0,1"));	
	$where = "clients.areaId IN (".$areaId.",".$parentCityid.")";
}
else {
	$where = "clients.areaId='".$areaId."'";
}

//include 'lawyersArray.php';

// are there lawyers in the loaction .. if not adsense page
if(isset($_COOKIE['toSeeded'])) 
{
$db->query("SELECT DISTINCT clients.*,areas.name as area,regions.name as region FROM clients,areas,regions WHERE clients.siteId='10' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND clients.clientId=".$_COOKIE['toSeeded']." LIMIT 1");

}
else 
{
$db->query("SELECT DISTINCT clients.*,areas.name as area,regions.name as region FROM clients,areas,regions WHERE clients.siteId='10' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND ".$where." ORDER BY RAND()*(IF( clients.clientId=10,3,2)) DESC LIMIT 1");
}



if($db->numRows == 0) 
{ 
$title =  ($Gsearch == true) ? $_GET['q'] : ucwords($location).' Divorce Family Law Lawyers'; 
$_SESSION['homeLink'] = "http://".$_SERVER['HTTP_HOST']."/";
include 'header2.php';
	?>
<div id="homeUpper">
<div id="bannerPageInfo">
<h2>Separating or divorcing?</h2>
<div id="watchourvideos"><a href="Javascript:void(0);" onclick="jwplayer().play();">Watch this video</a></div>
<h3>Ending your relationship? Talk to a family law lawyer.</h3>
</div>

<div id="homeUpperVideo">
<div id='videoFrame'>Unable to load video.</div>

<script type='text/javascript'>
		  jwplayer('videoFrame').setup({
			modes: [
			{ type: 'html5' },
			{ type: 'flash', src: '/player/player.swf' }
			],
			file: '/videos/html5/divorce_website_home_qtp.mp4',
			skin: "/player/deltabiz/deltabiz.xml",
			image: '/videoThumbs/home.png',
			controlbar: 'bottom',
			width: '388',
			height: '266',	
			frontcolor: '000000',
			lightcolor: '333333',
			screencolor: '396f8f',
			stretching: 'exactfit'
		  });
		</script>

</div>
</div>

<div class="leftContent adsense" style="overflow:visible;">
<? 

// if Gsearch is true these are custom search results to display.. no video and no adsense or search.
/*
if($Gsearch == true) {?>
<div style="padding-left:50px;">
<div id="cse-search-results"></div>

<script type="text/javascript">

  var googleSearchIframeName = "cse-search-results";

  var googleSearchFormName = "cse-search-box";

  var googleSearchFrameWidth = 800;

  var googleSearchDomain = "www.google.ca";

  var googleSearchPath = "/cse";

</script>

<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
</div>
<? } else {
	*/ ?>  
<? // adsense ads ?>
<h1>Talk to a divorce lawyer in <?=$_REQUEST['city'].", ".$_REQUEST['prov'];?>.</h1>

<div style="width:728px; display:none; overflow:visible;">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5889290780775145";
/* Leaderboard */
google_ad_slot = "2216747997";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<p>If your marriage or common law relationship is ending, you'll want to speak to a divorce/family law lawyer right away. You may be wondering how to find one and what to look for.</p>

<p>One of the best places to look is online. Many divorce and family law lawyers have great websites where you can learn about them and find out how they can help you.</p>

<h2>What to look for in a divorce / family law lawyer.</h2>

<p style="display:none;">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5889290780775145";
/* 468x60, created 10/6/10 */
google_ad_slot = "5335905503";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</p>

<p>From a family law lawyers website, you may be able to learn the following:</p>

<ul>
	<li>How long have they been practicing law?</li>
	<li>How much of their practice is devoted to divorce and family law?</li>
	<li>What is their success rate?</li>
	<li>What do they charge? Do they offer a free consultation?</li>
	<li>What are some of their clients saying about them?</li>
</ul>

<p>
Take out a pen and paper and jot down some notes as you read through different sites.  <br />
Compare lawyers and get a feel for who you'd like to call. Then call, and get the information you need regarding your specific legal needs.</p>

<h2>Searching online for a divorce lawyer.</h2>

<p>
Search engines try to display the most relevant search results. They look for pages that provide you with legitimate information that meets your search criteria. Their goal is to provide you with the information you're looking for.
</p>

<p>
If you don't see what you're looking for on one of our pages, try this:
</p>

<ul>
	<li>Pick a search engine (such as google) to conduct your search.</li>
	<li>Try keying in your specific location (such as "<?=$_REQUEST['city']?>" or "<?=$_REQUEST['prov']?>").</li>
	<li>Type in what you're looking for (such as "impaired driving lawyer" or "dui lawyer").</li>
	<li>Try using a phrase (such as "Can an impaired driving lawyer really help me?").</li>
</ul>

<p>
Take a look at the search results. Poke around a bit, and see who's out there. The nice thing about the Web is that you can learn a lot without leaving home.
</p>

<h2>What if you can't find a divorce lawyer online?</h2>

<p>
If you don't find what you're looking for online, call your provincial law society. They each have a lawyer referral program and can refer you to a lawyer who practices law relevant to your situation.
</p>
<?
	//Show the relevant law society information
	switch($_REQUEST['prov']){
		case "BC":
			?>
			<p>
			<b>Law Society of British Columbia</b>  <br/> 
			845 Cambie Street   <br/> 
			Vancouver, BC<br/> 
			V6B 4Z9<br/> 
			Tel: (604) 669-2533   <br/> 
			Fax: (604) 669-5232   <br/> 
			<a href="http://www.lawsociety.bc.ca/" target="_blank">http://www.lawsociety.bc.ca/</a>
			</p>
			<?
		break;
			
		case "AB":
			?>
			<p style="float:left; width:250px;">
			<b>Law Society of Alberta (Calgary)</b> <br/> 
			Suite 500, 919-11th Avenue S.W.   <br/> 
			Calgary. AB   <br/> 
			T2R 1P3<br/> 
			Tel: (403) 229-4700    <br/> 
			Fax: (403) 228-1728   <br/> 
			<a href="http://www.lawsociety.ab.ca/" target="_blank">http://www.lawsociety.ab.ca/</a>
			</p>
			<p style="float:left; width:250px;">
			<b>Law Society of Alberta (Edmonton)</b><br/> 
			Suite 800, 10104 103 Avenue    <br/> 
			Edmonton, AB<br/> 
			T5J 0H8<br/> 
			Tel: (780) 429-3343   <br/> 
			Fax: (780) 424-1620
			</p>
			<div style="clear:both;"></div>
			<?
		break;
			
		case "SK":
			?>
			<p style="float:left; width:260px;">
			<b>Law Society of Saskatchewan (Regina)</b><br/>
			2nd Floor, 2425 Victoria Ave.  <br/> 
			Regina, SK<br/>
			SK-S4P<br/>
			Tel: (306) 569-8020   <br/>
			Fax: (306) 569-0155   <br/>
			<a href="" target="_blank">http://www.lawsociety.sk.ca/</a>   
			</p>
			<p style="float:left; width:260px;">
			<b>Law Society of Saskatchewan (Saskatoon)</b><br/>
			520 Spadina Cres. E.   <br/>
			Saskatoon, SK<br/>
			S7K 3G7   <br/>
			Tel: (306) 933-5141   <br/>
			Fax: (306) 933-5166
			</p>
			<div style="clear:both;"></div>
			<?
		break;
		
		case "MB":
			?>
			<p>
			<b>Law Society of Manitoba</b><br/>
			219 Kennedy St   <br/>
			Winnipeg, MB<br/>
			R3C 1S8<br/>
			Tel: (204) 942-5571   <br/>
			Fax: (204) 956-0624   <br/>
			<a href="http://www.lawsociety.mb.ca/" target="_blank">http://www.lawsociety.mb.ca/</a>    
			</p>
			<?
		break;
		
		case "ON":
			?>
			<p>
			<b>Law Society of Upper Canada</b>   <br/> 
			Osgoode Hall<br/>
			130 Queen Street West   <br/>
			Toronto, ON<br/>
			M5H 2N6   <br/>
			Tel: (416) 947-3300    <br/>
			Fax: (416) 947-3924    <br/>
			<a href="http://www.lsuc.on.ca/" target="_blank">http://www.lsuc.on.ca/</a>    
			</p>
			<?
		break;
		
		case "QC":
			?>
			<p>
			<b>Qu&eacute;bec Bar</b><br/>  
			445, boulevard Saint-Laurent<br/>   
			Montr&eacute;al, QC   <br/>
			H2Y 3T8   <br/>
			Tel: (514) 954-3400   <br/>
			Fax: (514) 954-3464  <br/> 
			<a href="http://www.barreau.qc.ca/?Langue=en" target="_blank">http://www.barreau.qc.ca/?Langue=en</a>   
			</p>
			<?
		break;
		
		case "NB":
			?>
			<p>
			<b>Law Society of New Brunswick</b> <br/>
			68 Avonlea Court   <br/>
			Fredericton NB<br/>
			E3C 1N8   <br/>
			Tel: (506) 458-8540   <br/>
			Fax: (506) 451-1421   <br/>
			<a href="http://www.lawsociety-barreau.nb.ca/emain.asp" target="_blank">http://www.lawsociety-barreau.nb.ca/emain.asp </a>  
			</p>
			<?
		break;
		
		case "NS":
			?>
			<p>
			<b>Nova Scotia Barristers' Society</b><br/>   
			1101-1645 Granville Street<br/>   
			Halifax, NS<br/>
			B3J 1X3<br/>
			Tel: (902) 422-1491 <br/>  
			Fax: (902) 429-4869 <br/>  
			<a href="http://www.nsbs.org/" target="_blank">http://www.nsbs.org/   </a> 
			</p>
			<?
		break;
		
		case "PE":
			?>
			<p>
			<b>Law Society of Prince Edward Island</b><br/>
			PO Box 128, 49 Water Street<br/>
			Charlottetown, PE<br/>
			C1A 7K2<br/>
			Tel: (902) 566-1666<br/>   
			Fax: (902) 368-7557<br/>    
			<a href="http://www.lspei.pe.ca/" target="_blank">http://www.lspei.pe.ca/ </a>
			</p>
			<?
		break;
		
		case "NL":
			?>
			<p>
			<b>Law Society of Newfoundland & Labrador</b>  <br/>
			196-198 Water Street<br/>
			St. Johns, NL<br/>
			A1C 1A9   <br/>
			Tel: (709) 722-4740   <br/>
			Fax: (709) 722-8902   <br/>
			<a href="http://www.lawsociety.nf.ca/" target="_blank">http://www.lawsociety.nf.ca/<a/>    
			</p>
			<?
		break;
		
		case "NT":
			?>
			<p>
			<b>Law Society of the Northwest Territories</b> <br/>  
			4th Floor-5204 50th Avenue   <br/>
			Yellowknife, NT<br/>
			X1A 1E2   <br/>
			Tel: (867) 873-3828   <br/>
			Fax: (867) 873-6344   <br/>
			<a href="http://www.lawsociety.nt.ca/" target="_blank">http://www.lawsociety.nt.ca/ <a/> 
			</p>
			<?
		break;
		
		case "YT":
			?>
			<p>
			<b>Law Society of Yukon</b><br/>
			Suite 202 - 302 Steele Street<br/>   
			Whitehorse, YT<br/>
			Y1A 2C5<br/>
			Tel: (867) 668-4231   <br/>
			Fax: (867)667-7556   <br/>
			<a href="http://www.lawsocietyyukon.com/" target="_blank">http://www.lawsocietyyukon.com/</a> 
			</p>
			<?
		break;
		
		case "NU":
			?>
			<p>
			<b>Law Society of Nunavut </b><br/>
			Bldg. 917, 3rd Floor, Unit B  <br/> 
			Iqaluit, NU<br/>
			X0A 0H0   <br/>
			Tel: (867)979-2330   <br/>
			Fax: (867)979-2333   <br/>
			<a href="http://lawsociety.nu.ca/" target="_blank">http://lawsociety.nu.ca/</a>
			</p>
			<?
		break;
				
	}
?>
<h2>Use your local phone directory.</h2>

<p>
Finally, if all else fails, check your local phone directory. You can learn who is practicing law in your area, but you won't get much other information about a lawyer from a phone book listing.
</p>

<h2>The bottom line - Call a family law lawyer!</h2>

<p>
Once you've found a family law lawyer, contact them and arrange to meet with them. Meeting in person is the best way to find out how they can help you.
</p>


</div>
</div>
<div class="rightContent" style="text-align: left; width: 300px; float: right; margin-right: 30px;">

<? // adsense custom search ?>

<style type="text/css">

@import url(http://www.google.com/cse/api/branding.css);

</style>

<div class="cse-branding-right" >
<? 
//generate session.
$_SESSION["adsenseBlock"]="YES";
$_SESSION["adsenseCity"]=$_REQUEST["city"];
include("adsenseBlock.php"); ?>
</div>
<div class="clear"></div>
</div><div class="clear"></div>
<? // adsense custom search ?>

<style type="text/css">

@import url(http://www.google.com/cse/api/branding.css);

</style>

<div class="cse-branding-right" style="background-color:#FFFFFF;color:#000000; padding-bottom:30px; padding-top:30px; float:right;">

  <div class="cse-branding-form" style="padding-left:50px; display:none;">

    <form action="/search_for_a_lawyer.php" id="cse-search-box">

      <div>

        <input type="hidden" name="cx" value="partner-pub-5889290780775145:8u0sjcu3g2e" />

        <input type="hidden" name="cof" value="FORID:10" />

        <input type="hidden" name="ie" value="ISO-8859-1" />

        <input type="text" name="q" size="20" style="width:100px;" />

        <input type="submit" style="width:60px;height:25px;" name="sa" value="Search" />

      </div>

    </form>

  </div>

  <div class="cse-branding-logo" style="float:right; display:none;">

    <img src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" alt="Google" />

  </div>

<? include 'footer.php'; 

} else {
	$extraclassfound="found";
	//Lawyer Found.
	if($db->numRows == 1 ) {
		//Set to variables to read on  header2.php (cant set the session here due the ob_start(); 
	$city2header=$_REQUEST['city'];
	$link2header="http://".$_SERVER['HTTP_HOST']."/dfl/".$_REQUEST['city'];
	
	$lawyer = $db->nextRow();
	if($lawyer['clientId'] == '10' || $lawyer['clientId'] == '9') {
		setcookie('toSeeded',$lawyer['clientId'],time()+2592000);	
	}
			
	$title = (!empty($db->row['metaTitle'])) ? $db->row['metaTitle'] : $db->row['area']." family law lawyers, divorce lawyers and law";
	$metaDesc = (!empty($db->row['metaDesc'])) ? $db->row['metaDesc'] : " Ending your marriage or common law relationship? Family law is complex. A divorce lawyer can help you through this process. Browse our family law site, and then call a lawyer";

	include 'header2.php';

?>
<div style="clear:both"></div>
<div class="search" id="search">
<!-- Google Code for Profile Visit Conversion Page NEW ONE-->
<script type="text/javascript">
/*<![CDATA[ */
var google_conversion_id = 969685855;
var google_conversion_language = "ar";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "OrLmCOHy2AIQ3_awzgM";
var google_conversion_value = 0;
/* ]]>  */
</script>
<script type="text/javascript"
src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt=""
src="http://www.googleadservices.com/pagead/conversion/969685855/?label=OrLmCOHy2AIQ3_awzgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
			
<!-- Google Code for City Page Searches Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1069420457;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "000000";
var google_conversion_label = "kkXfCJfE0QEQqZ_4_QM";
var google_conversion_value = 0;
if (1.00) {
  google_conversion_value = 1.00;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1069420457/?value=1.00&amp;label=kkXfCJfE0QEQqZ_4_QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript">if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/792674b9-b3bd-442f-8588-00bde3ff4167/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("analytics", {dedup:"1",domainId:"909334",type:"1",actionid:"18535"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/792674b9-b3bd-442f-8588-00bde3ff4167/analytics.html?dedup=1&domainId=909334&type=1&actionid=18535" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden; display:none"> </iframe> </noscript>

<? include "lawyer_info.php" ?>

			<? }
			else {
				?><h1 style=" width:300px; float:right; padding-right:100px; margin-top:-70px;"><?=$searchTerm;?></h1>
                 <? include 'actionBar.php';
				while($db->nextRow() !== FALSE) {
		?>
       
    	    	<div class="lawyerList">
	        	    <a href="<?=BASE_URL;?>/Divorce_Family_Law_Lawyer/<?=$db->row['name'];?>/"><img src="<?=BASE_URL;?>images/viewLawyerButton.png" width="189" height="52" alt="View Lawyer" style="float:right;" /></a>

				<? if(is_file(BASE_DIR.'images/lawyerThumbs/'.$db->row['clientId'].'.png')) { ?><img src="<?=BASE_URL;?>images/lawyerThumbs/<?=$db->row['clientId'];?>.png" height="160" style="float:left; padding-right: 10px;" /><? } ?>

            	<h2><?=$db->row['name'];?></h2>

            	<h3><?=$db->row['firmName'];?></h3>

            	<p><?=substr( strip_tags( $db->row['biography'] ),0,180);?> . . .</p>

				</div>

			<? } 
			}   
?>
</div>
<div class="clear"></div>
<? include 'footer.php'; }
ob_end_flush();
?>
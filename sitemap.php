<?php
require_once 'includes/init.php';
$title = "Sitemap - divorcefamilylaw.ca";
$title = "Sitemap - divorcefamilylaw.ca";
$metaDesc = "Sitemap - divorcefamilylaw.ca";
$page = "home";
$banner = "";
$bannerTittle = "Sitemap";
$video = "divorce_website_home_qtp.mp4";
$image = "home.png";
include 'header.php';
$db->Query( "SELECT areas.areaId as id,areas.name as area,regions.code as code,regions.name as name FROM areas,regions WHERE areas.regionId=regions.regionId" );
	
?>


<style>
#homeColumnTwo a {color:#333;}
#homeColumnTwo a:hover {color:#666;}
#homeColumnTwo ul li { padding-left:50px; }
</style>


<div id="search">

  <div id="homeColumnTwo">

    <h1>Sitemap</h1>
    
<ul>
<li><a href="http://divorcefamilylaw.ca/"> Separating or divorcing? - Divorce and Family Law Lawyers</a></li><li><a href="http://divorcefamilylaw.ca/how-can-a-family-lawyer-help/"> How a lawyer can help - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/can-i-do-it-myself/"> Do it yourself divorce? - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/how-much-will-a-lawyer-cost/"> How much will this cost? - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/splitting-up/"> Divorce - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/splitting-up-common-law/"> Common Law - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/splitting-up-same-sex-relationships/"> Same-Sex Couples - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/children/"> Children - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/custody-and-access/"> Custody and Access - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/child-support/"> Child Support - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/property-division/"> Dividing Marital Assets - Divorce and Family Law Lawyers</a></li><li><a href="http://divorcefamilylaw.ca/property-division-common-law/"> Common Law Assets - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/separation-agreement/"> Separation Agreements - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/spousal-support/"> Spousal Support Payments - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/domestic-contracts/"> Domestic Contracts - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/why-have-a-contract/"> Do I need a contract? - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/making-a-valid-contract/"> Valid Contract? - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/independent-legal-advice/"> Independent Legal Advice - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/alternatives-to-court/"> Mediation - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/collaborative-law/"> Collaborative Law - Divorce and Family Law Lawyers</a></li>
<li><a href="http://divorcefamilylaw.ca/terms_of_use.php">Terms of Use - Divorcefamilylaw.ca</a></li>
<li><a href="http://divorcefamilylaw.ca/sitemap.php">Sitemap - Divorcefamilylaw.ca</a></li>
<li><a href="http://divorcefamilylaw.ca/privacy.php">Privacy Policy - Divorcefamilylaw.ca</a></li>
</ul>
<ul>
<?
while($db->nextRow() !== FALSE ) {
	echo '<li><a href="http://divorcefamilylaw.ca/Divorce_Family_Law_Lawyers/'.$db->row['code'].'/'.$db->row['area'].'/">'.utf8_encode($db->row['area']).', '.utf8_encode($db->row['name']).' Divorce and Family Law Lawyers</a></li>';
}
?>
</ul>
</div>
</div>

<div class="clear"></div>

<? include 'footer.php'; ?>


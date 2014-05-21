<?
require_once 'includes/init.php';
$my_db = clone $db;
$my_areaId = $my_db->result("SELECT a.areaId FROM `areas` AS a, regions AS r, countries AS c WHERE a.name LIKE '".$_SESSION['landingCity']."' AND r.countryId = c.countryId AND c.countryId = 1 AND a.regionId = r.regionId LIMIT 0,1");

$my_parentCityid = $my_db->result("SELECT majorAreaId FROM `areas` WHERE name LIKE '".$_SESSION['landingCity']."' LIMIT 0,1");

if($my_parentCityid !== FALSE && $my_parentCityid != '') {
	$my_parentCity = strtolower($my_db->result("SELECT name FROM `areas` WHERE areaID='".$my_parentCityid."' LIMIT 0,1"));	
	$my_where = "clients.areaId IN (".$my_areaId.",".$my_parentCityid.")";
}
else {
	$my_where = "clients.areaId='".$my_areaId."'";
}
$my_db->query("SELECT DISTINCT clients.*,areas.name as area,regions.name as region FROM clients,areas,regions WHERE clients.siteId='10' AND areas.regionId=regions.regionId AND clients.areaId=areas.areaId AND ".$my_where." ORDER BY RAND()*(IF( clients.clientId=10,3,2)) DESC LIMIT 1");

if($my_db->numRows == 1 ) {
	$my_lawyer = $my_db->nextRow();
	$_SESSION['hasLawyer'] = true;
	?>
    <section id="namebar">
        <div class="wrap">
            <a href="/lawyer_details/?ID=<? echo $my_lawyer['clientId']; ?>"><?= ucwords($my_lawyer['name']); ?></a>
            <h1 class="name"><?= ucwords($my_lawyer['name']); ?></h1>
            <p class="contact"><span class="label">Call Now!</span> <span class="number"><? echo $my_lawyer['phoneLocal']; ?></span></p>
            <p class="consultation"><span class="uc">Free</span> Consultation</p>
        </div>
    </section>
	<?			
}else{
	//Empty?
	$_SESSION['hasLawyer'] = false;
	?>
	<section id="namebar">
        <div class="wrap">
        </div>
    </section>
	<?
}
?>


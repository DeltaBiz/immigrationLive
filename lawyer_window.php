<?
//include 'actionBarSearch.php';
if(isset($my_lawyer)) {
?><div class="lawyer_window">
	<div class="lawyer_window_heading">Divorce & Family Lawyer<br />in <?=ucwords($_SESSION['landingCity']);?></div>
	<div id="lawyer_window_info">
		<div style="float:left;width:46%">
        <h1><?=ucwords($my_lawyer['name'])?></h1>
				<p><?=$my_lawyer['address1']?><br />
				<?=$my_lawyer['address2']?>
                <br /><?=ucwords($_SESSION['landingCity']);?>, <? echo (strlen($_SESSION['landingCity']."".$my_lawyer['region'])>22 ? $my_lawyer['regioncode'] : $my_lawyer['region']);?></p>
			<p>Local Phone<br /><?=$my_lawyer['phoneLocal']?></p>
         <!--<h3>FREE Consultation</h3>-->
		</div>
		
        <div style="float:left;">
		<div id="lawyer_map" ></div>
  <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBKhsID6K3ldll99UppHJdbhOrS3Fn8IZA&sensor=false" type="text/javascript"></script>
   <script language="javascript">         
    var map = new GMap2($("lawyer_map"));
	var geocoder = new GClientGeocoder();
	showAddress2("<?= $my_lawyer['addressZip'];?>","<?= $my_lawyer['address2']." ".$my_lawyer['address1']."<br />".$my_lawyer['region'].", ".$_SESSION['landingCity']."<br />".$my_lawyer['addressZip']; ?>");
	map.setUIToDefault();
    </script> 	
		</div>
        
	</div>
	<div id="lawyer_window_profile" class="plainbg"><a href="/lawyer_details/?ID=<?=$my_lawyer['clientId']?>">View <?= strtok($my_lawyer['name'], " ");?>'s expanded Profile</a></div>
    <div id="lawyer_window_profile" ><a href="/contact_a_lawyer2.php?ID=<?=$my_lawyer['clientId'];?>" title="Submit Information" rel="viewbox">Submit Information</a></div>
    
</div>
<? }
//include Block
include("adsenseBlock.php");
 ?>
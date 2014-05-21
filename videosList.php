<?php
//include 'actionBarSearch.php';

if (isset($_SESSION['landingCity']) && !empty($my_lawyer)){

?>
	<div id="videoList" class="rightColumnNew">
    
        <h3><? echo ucwords($_SESSION['landingCity']); ?> Personal Injury Lawyer</h3>

        <div id="videoInnerNew">
			<div class="lawyerSummaryNew">

				<div id="lawyerThumbRight">
					<div id="map" style="margin-left:-15px; margin-top:-10px; width: 160px; height: 180px; border:2px solid #ccc;-moz-border-radius: 6px;-webkit-border-radius: 6px;"></div>
				</div>
	
				
				<p style="font-size:20px; padding-bottom:30px;"><?= ucwords($my_lawyer['name']); ?></p>
				
				<p style="padding-bottom:15px; line-height:18px;">
				<?echo $my_lawyer['address2']." ".$my_lawyer['address1'];?><br/> <? echo ucwords($_SESSION['landingCity']); ?>
				<br/>
				<? if($my_lawyer['phoneLocal'] != '') { $displayPhone = $my_lawyer['phoneLocal']; echo $my_lawyer['phoneLocal']. ''; }?>
				</p>
				
				<!--<p style="font-size:18px;">
				<br/>FREE Consultation
				</p>-->
				
				<div class="contactLink">
				<a href="<?=$_SESSION['landingLink']?>">
				<?
					$name = $my_lawyer['name'];
					
					$firstname = explode(' ', $name);
					$firstname = $firstname[0];
				
				?>
				
					View <?= ucwords($firstname); ?>'s expanded profile
				</a>
				</div>
			<!--<a href="<?//=$_SESSION['landingLink']?>">	
			</a>-->
			
			
			</div>
        </div>



		

	

    </div>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAO-4vBzTmBZ9bFjXBmV9cbxR4HlPBVS10ThfoN9CgnLqDN6UI_xTef-PYyeoeiAisjVkycTUWJUmnSw&iwloc=&sensor=false" type="text/javascript"></script>

	<script>

	var map = new GMap2($("map"));

	var geocoder = new GClientGeocoder();

	showAddress2("<?= $my_lawyer['addressZip'];?>","<?= $my_lawyer['address2']." ".$my_lawyer['address1']."<br />".$my_lawyer['area'].", ".$my_lawyer['region']."<br />".$my_lawyer['addressZip']; ?>","<p><?= $my_lawyer['firmName']; ?></p>");

	map.setUIToDefault();

</script>



<?


}else{
$videos = array(

					array('title'=>'Never Plead Guilty.',

						  'blurb'=>'Find out your options before you enter your plea.',

						  'link'=>'/never_plead_guilty.php',

						  'src'=>'never_plead_guilty.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					array('title'=>'How can a lawyer help you?',

						  'blurb'=>'An impaired driving lawyer can help more than most people think.',

						  'link'=>'/impaired_driving_lawyer.php',

						  'src'=>'HOW CAN A LAWYER HELP YOU.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					array('title'=>'Can your charges be dismissed?',

						  'blurb'=>'Getting your impaired driving charges dismissed/reduced.',

						  'link'=>'/impaired_driving_charges_dismissed.php',

						  'src'=>'CAN YOUR CHARGES BE DISMISSED OR REDUCED.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					array('title'=>'When should you speak to a lawyer?',

						  'blurb'=>'It is best to consult with an impaired driving lawyer as early in the process as possible.',

						  'link'=>'/talk_to_a_lawyer.php',

						  'src'=>'WHEN SHOULD YOU TALK TO A LAWYER.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					array('title'=>'Can I represent myself?',

						  'blurb'=>'Legally, yes, you can represent yourself. But it is not recommended.',

						  'link'=>'/represent_yourself.php',

						  'src'=>'CAN YOU REPRESENT YOURSELF.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					array('title'=>'Legal Fees',

						  'blurb'=>'To pick up the phone and call us costs absolutely nothing, and you should make that call right now.',

						  'link'=>'/legal_fees.php',

						  'src'=>'LEGAL FEES.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					
					array('title'=>'Impaired driving legal overview.',

						  'blurb'=>'Impaired driving, drunk driving, DUI or DWI?',

						  'link'=>'/legal_overview.php',

						  'src'=>'LEGAL OVERVIEW.flv',

						  'thumb'=>'/images/videoThumb.png'),

					array('title'=>'What is impaired driving?',

						  'blurb'=>'Even if you were drinking and driving, you still might not have been impaired.',

						  'link'=>'/what_is_impaired_driving.php',

						  'src'=>'what_is_impaired_driving.flv',

						  'thumb'=>'/images/videoThumb.png'),


					array('title'=>'Driving over .08',

						  'blurb'=>'Breath tests can produce false results.',

						  'link'=>'/driving_over_08.php',

						  'src'=>'driving_over_08.flv',

						  'thumb'=>'/images/videoThumb.png'),

					
					

					array('title'=>'Refuse to provide a breath sample.',

						  'blurb'=>'Was the demand lawful? Do you have a reasonable excuse?',

						  'link'=>'/refuse_to_provide_breath_sample.php',

						  'src'=>'REFUSE TO PROVIDE A BREATH SAMPLE.flv',

						  'thumb'=>'/images/videoThumb.png'),

					

					array('title'=>'Blood alcohol calculator.',

						  'blurb'=>'Estimating your blood-alcohol content.',

						  'link'=>'/blood_alcohol_calculator.php',

						  'src'=>'BLOOD ALCOHOL CALCULATOR.flv',

						  'thumb'=>'/images/videoThumb.png'),

				

				array('title'=>'Penalties and Consequences.',

						  'blurb'=>'Estimating your blood-alcohol content.',

						  'link'=>'/penalties_and_consequences.php',

						  'src'=>'BLOOD ALCOHOL CALCULATOR.flv',

						  'thumb'=>'/images/videoThumb.png')

				

				

				);

?>

    <div id="videoList" class="rightColumn">

    	

        <h3>Impaired Driving Information Videos</h3>

        <div id="videoInner">

        <!-- start video loop -->

        <? foreach($videos as $video) {	?>

        <div class="videoItem">

            <a href="<?= $video['link']; ?>"><img src="<?= $video['thumb']; ?>" /></a>

            <h4><a href="<?= $video['link']; ?>"><?= $video['title']; ?></a></h4>

			<p><?= $video['blurb']; ?></p>

         </div>

		<? } ?>        

        </div>

        <div id="wrap1">

			<div id="track1-top"></div>



			<div id="track1">

				<div id="handle1"></div>

			</div>

            

            <div id="track1-bottom"></div>

		</div>

		

	

    </div>
<?
}
?>
<script>

	

var slider1 = new Control.Slider('handle1', 'track1', {

				axis: 'vertical',

				onSlide: function(v) { scrollVertical(v, $('videoInner'), slider1);  },

				onChange: function(v) { scrollVertical(v, $('videoInner'), slider1); }

			});

if ($('videoInner').scrollHeight <= $('videoInner').offsetHeight) {

	slider1.setDisabled();

	$('wrap1').hide();

}



</script>
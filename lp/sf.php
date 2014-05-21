<?php
ob_start();
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 60 minutes ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

require_once '../includes/init.php';
$city = $_GET['city'];

if ($city == 'Toronto1'){
	$city = 'Toronto';
	$_SESSION['myCity'] = 'Toronto1';
}else{
	$_SESSION['myCity'] = '';
}

$city = str_replace('Mcmurray', 'McMurray', $city);



$title = $city." slip and fall injury lawyers get you more money for your claim";

$metaDesc = $city." Slip and Fall Injury Lawyers are here to help you with  your Personal Injury Claim. Watch this VIDEO, then call.";

$page = "home";
//$keywords = Array();
//$keywords = "dui,".$city." dui,".$city." dui lawyers,drunk driving,".$city." drunk driving,".$city." drunk driving lawyers,impaired driving,".$city." impaired driving,".$city." impaired driving lawyers,refuse breathalyzer,driving over .08";



$_SESSION['landingCity'] = $city;

$_SESSION['landingLink'] = "http://injury-lawyer4u.com/Personal_Injury_Lawyers/PPC/".$city;

$_SESSION['homeLink'] = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];

include '../header.php';


?>

<div id="homeUpper">


<h2><?= $city; ?></h2>

   

    <!-- Video Player Here -->
	<?
		
		$city = str_replace(' ', '_', $city);
		$city= str_replace('%20', '_', $city);
		$city = str_replace('%20%', '_', $city);
	
	?>
	<div id="homeUpperVideo3">
    <script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 350, 300, "../videos/lp/sf_<?= $city; ?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script>


</div>
</div>
<div class="clear"></div>

<? include '../actionBarSearch_LP.php';?>

<div class="leftContent">

  <h1><?= $city; ?> Slip and Fall Injury Claims </h1>
	
	<p>
	Personal injuries can occur in cases where you've slipped, tripped or fallen due to a hazardous or dangerous condition on another person's property.
	</p>
	
	<h2>How do "slip and fall" accidents happen? </h2>
	
	<p>
	Slip and fall accidents can happen anywhere; someone else's home, a shopping mall, or a public park. They can happen inside or outside of a building. They can be caused by conditions such as bad flooring, wet floors, poorly lit steps, or, in the case of outdoor accidents, weather-related or hidden hazards. An icy patch outside a door or a crack, a raised ledge or pothole can be the cause of a slip and fall in a parking lot, for instance. In Edmonton, ice is often the cause of many very serious slip and fall accidents.
	</p>
	
	<p>
	Property owners, and their employees, have a "duty of care" to see that their property is reasonably safe under the circumstances. This includes ensuring that the building has no structural defects or unusual dangers that could cause an accident, both inside and out. Structural defects or unusual dangers can include: loose floor mats, rugs, or tiles; water on the floor; badly lit stairs or steps; cracks or holes in sidewalks or parking lots. Weather-related hazards may include standing water, snow and icy spots. 
	</p>
	
	<h2>Do you have a slip and fall" claim?</h2>
	
	<p>
	Our <?= $city; ?> lawyer can help you determine if you have a case, and lead you through your pursuit for compensation. You may be entitled to compensation for pain and suffering, loss of income, health care expenses, housekeeping costs and any other economic losses incurred.
	</p>
	
	<p>
	Call our <?= $city; ?> lawyer  now. They'll provide you with the legal advice you need to successfully pursue your claim for compensation.
	</p>
	
	
	<!--
<br /><br />
       <div id="lawyerSearch">
        	<a href="http://injury-lawyer4u.com.ca/Personal_Injury_Lawyers/PPC/<?//= $city; ?>/" style="color:#fff;font-size:16px; line-height:18px;">
				<h2>
					Click Here To View Our <?//= $city; ?> Personal Injury Lawyer
				</h2>
			</a>
        	    
        </div>
		-->
  
</div>

<div class="rightContent">

	<? include '../videosList.php'; ?>

    <div id="news" class="rightColumn">

    	<h3>Personal Injury Latest News</h3>

        <div id="newsInner">

        <!-- start blog loop -->

		<?
		
		
                    include './includes/rss_php.php';

                    $rss = new rss_php;

                    $rss->load('http://justcharged.com/blog/category/personalinjury/?feed=rss2');

                    $items = $rss->getItems();

                    $c = 0;

                    foreach ($items as $item)

                    {
						
                        $c++;

                        if ($c > 10)

                        {

                            break;

                        }

                        $href	= $item['link'];

                        $title	= $item['title'];
						
						$desc = $item['description'];

                        if (strlen($title) > 30)

                        {

                            $title	= substr($title, 0, 30);

                            $title .= '...';

                        }
						if (strlen($desc) > 80)

                        {

                            $desc	= substr($desc, 0, 80);

                            $desc .= '... <a href="' . $href .'" target="_blank">[Read More]</a>';

                        }

                       // $title	= str_replace(array(''', '…'), array('\'', '...'), $title);

                        echo '<h4><a href="' . $href .'" target="_blank">' . $title . '</a></h4>' . "\n";
						echo '<p>'.$desc.'</p>';

                    }

                    ?>

        </div>

        <div id="wrap2">

			<div id="track2-top"></div>



			<div id="track2">

				<div id="handle2"></div>

			</div>

            

            <div id="track2-bottom"></div>

		</div>

    </div>

    <div class="clear" style="height:20px;"></div>

</div>



<div class="clear"></div>

<script>



var slider2 = new Control.Slider('handle2', 'track2', {

				axis: 'vertical',

				onSlide: function(v) { scrollVertical(v, $('newsInner'), slider2);  },

				onChange: function(v) { scrollVertical(v, $('newsInner'), slider2); }

			});



if ($('newsInner').scrollHeight <= $('newsInner').offsetHeight) {

	slider2.setDisabled();

	$('wrap2').hide();

}



</script>

<? include '../footer.php'; ?>


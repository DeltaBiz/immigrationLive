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



$title = $city." Car Accident Injury Lawyer";

$metaDesc =  $city." Car and Auto Accident Injury Lawyers, Chadi and Company, are here to help you with your Personal Injury Claim. ";

$page = "home";
//$keywords = Array();
//$keywords = "dui,".$city." dui,".$city." dui lawyers,drunk driving,".$city." drunk driving,".$city." drunk driving lawyers,impaired driving,".$city." impaired driving,".$city." impaired driving lawyers,refuse breathalyzer,driving over .08";



$_SESSION['landingCity'] = $city;

$_SESSION['landingLink'] = "http://injury-lawyer4u.com/Personal_Injury_Lawyers/PPC/".$city;

$_SESSION['homeLink'] = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];

include '../header.php';


?>

<div id="homeUpper" class="<?= $city; ?>">


<h2><?= $city; ?></h2>

   

    <!-- Video Player Here -->
	<?
		
		$city = str_replace(' ', '_', $city);
		$city= str_replace('%20', '_', $city);
		$city = str_replace('%20%', '_', $city);
	
	?>
	<div id="homeUpperVideo3">
    <script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 350, 300, "../videos/lp/aa_<?= $city; ?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script>


</div>
</div>
<div class="clear"></div>

<? include '../actionBarSearch_LP.php';?>

<div class="leftContent">

  <h1><?= $city; ?> Car and Auto Accident Lawyers</h1>
	
<p>Have you been injured in <?= $city; ?> as the result of a car crash, or any other motor vehicle accident? Car accidents can occur without warning, and because of your injury, your life may be negatively impacted for years to come.</p>

<p>You may have sustained broken bones, tearing of soft tissue (torn ligaments, for example) or even head or spinal trauma; all of which may lead to permanent injuries, inability to work, and constant pain and suffering.</p>

<p>No matter what your injuries, there is legal information that you need to know, and you need to get it from a personal injury lawyer.</p>

<h2>Talk to a Personal Injury Lawyer</h2>

<p>Seeking compensation for your injuries can be a complicated process, and it's a process you shouldn't try to do yourself. You should not make any decisions without being completely aware of your rights, and a lawyer can tell you what those rights are.</p>

<p>A lawyer will handle the process of your claim. Your lawyer will also make sure that the proper claim forms are submitted to the insurer. A lawyer will properly investigate your claim, and compile the necessary medical documentation needed to support your claim. If necessary, they will start the lawsuit process within the allotted time limits. A lawyer is especially important to have when you are dealing with insurance companies.</p>

<h2>Dealing with the Insurance Company</h2>

<p>Insurance companies have lawyers, and you should have one too. If not, you're a great disadvantage; and they know it!</p>

<p>Usually, the insurance company will send an insurance adjuster to speak with you about the accident and the injuries you sustained from it. Here are some important points to remember when you meet with the adjuster;
<ul>
	<li>Be aware that anything you say to the insurance adjuster will become part of your file, and may affect your future accident benefit claims;</li>
	<li>Only talk to the adjuster when you are medically able;</li>
	<li>Get legal advice before speaking with the adjuster. It is important to have a lawyer involved as early in the process as possible because anything you say to your insurance company can hurt you immediately or in the future.</li>
</ul>

<p>Your lawyer will keep you informed of your rights and help you stay on a level playing field with the insurer.</p>

<p>Find out if you have a car accident injury claim, and how much it's worth</p>

<p>Our <?= $city; ?> lawyers can help you determine if you have a case, and lead you through your pursuit for compensation. You may be entitled to compensation for pain and suffering, loss of income, health care expenses, housekeeping costs and any other economic losses incurred.</p>

<p>Call our <?= $city; ?> lawyers now. They'll provide you with the legal advice you need to successfully pursue your claim for compensation.</p>
	
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

                       // $title	= str_replace(array(''', ''), array('\'', '...'), $title);

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


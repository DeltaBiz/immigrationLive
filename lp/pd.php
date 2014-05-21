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



$title = $city." personal injury lawyers for unsafe drugs and negligent prescriptions.";

$metaDesc =  $city." personal injury lawyers for injuries caused by unsafe prescription drugs or other medications";

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
    <script type="text/javascript">insertVideoPlayer( "/videoPlayer/videoPlayer.swf", 350, 300, "../videos/lp/pd_<?= $city; ?>.flv", "000000", false, "/images/playVideo.png", "/images/pauseVideo.png" );</script>


</div>
</div>
<div class="clear"></div>

<? include '../actionBarSearch_LP.php';?>

<div class="leftContent">

  <h1><?= $city; ?> Personal Injury Lawyers - unsafe prescription medication</h1>
	
<p>Have you been injured in <?= $city; ?> because you were prescribed the wrong drug or an unsafe drug? Talk to a personal injury lawyer now, before you do anything else!</p>

<h2>Not all prescription drugs are safe!</h2>

<p>When your doctor prescribes medication to you, there is an inherent trust that the drug you get will be safe for you to take. That isn't always the case. Pharmaceutical errors can cause serious injuries, or even death. If you've been injured through a pharmaceutical error, contact a personal injury lawyer immediately!</p>

<h2>Pharmaceutical errors. What are they?</h2>

<p>Pharmaceutical error's are mistakes made by a medical professional through the manufacture, distribution, prescription or administration of a drug to you, the patient. A medication error lawyer can help you understand whether you were the victim of this type of mistake.  Here are some examples of pharmaceutical errors:</p>

<ul>
<li><b>Prescribing, dispensing or administering too much or too little of a medication</b> - drugs must be prescribed in the right amounts to benefit the patient.  Doctors, pharmacists and nurses can all make mistakes, and those mistakes can cause serious injuries.</li>
<li><b>Prescribing, dispensing or administering the wrong medication</b> - This simple mistake cause cause serious injury. This often occurs in the hospital setting and puts both the patient who has not received his medication and the one who received the wrong type at risk.</li>
<li><b>Failing to recognize or investigate possible drug interactions</b> - Sometimes medications interact with other drugs, with horrible effects. A health care provider must consider drug interactions  before prescribing any medication. Sometimes, they don't.</li>
<li><b>Prescribing or administering drugs to which a patient is allergic</b> - Health care providers must consider all known allergies before they prescribe medications. </li>
</ul>

<h2>How can Pharmaceutical Errors occur?</h2>

<ul>
<li>A hospital staff member fails to properly  make note of allergies on a patients chart</li>
<li>A pharmacist incorrectly reading the name of a drug prescribed by a physician</li>
<li>A nurse giving a patient medication intended for someone in another bed or room</li>
<li>A nurse measuring the wrong amount of a medication for a patient</li>
</ul>

<p>Pharmaceutical errors have can have serious consequences. They can  lead to drug overdoses, and adverse reactions , which can result in serious injuries and even death.</p>

<h2>Drug Manufacturing</h2>

<p>Drug manufacturers must ensure that the drugs that they put on the market are safe. They must follow safety standards and guidelines before medications are distributed to the public. Sometimes those standards are ignored, in order to rush a drug to market. Some people refer tot his as "profits over people".</p>

<p>Other times, it's not about profits. It's simply a negligent mistake made by the manufacturer or distributor. No matter if whether the cause was ignoring safety standards, or through simple negligence, if you've bee injured you need legal assistance.</p>

<h2>Talk to a personal injury lawyer who knows about dangerous drugs</h2>

<p>Seeking compensation for your injuries can be a complicated process, and it's a process you shouldn't try to do yourself. You should not make any decisions without being completely aware of your rights, and a lawyer can tell you what those rights are.</p>

<p>A lawyer will handle the process of your claim. Your lawyer will also make sure that the proper claim forms are submitted to the insurer. A lawyer will properly investigate your claim, and compile the necessary medical documentation needed to support your claim. If necessary, they will start the lawsuit process within the allotted time limits. A lawyer is especially important to have when you are dealing with insurance companies.</p>

<h2>Dealing with the Insurance Company</h2>

<p>Insurance companies, which represent manufacturers and distributors, have lawyers, and you should have one too. If not, you're a great disadvantage; and they know it!</p>

<p>Usually, the insurance company will send an insurance adjuster to speak with you about your claim and the injuries you sustained from it. Here are some important points to remember when you meet with the adjuster:
<ul>
	<li>Be aware that anything you say to the insurance adjuster will become part of your file, and may affect your future accident benefit claims;</li>
	<li>Only talk to the adjuster when you are medically able;</li>
	<li>Get legal advice before speaking with the adjuster. It is important to have a lawyer involved as early in the process as possible because anything you say to your insurance company can hurt you immediately or in the future.</li>
</ul>

<p>Your lawyer will keep you informed of your rights and help you stay on a level playing field with the insurer.</p>

<h2>Find out if you have a personal injury claim</h2>

<p>Our <?= $city; ?> lawyers can help you determine if you have a case, and lead you through your pursuit for compensation. You may be entitled to compensation for pain and suffering, loss of income, health care expenses, housekeeping costs and any other economic losses incurred.</p>

<p>Call our <?= $city; ?> personal lawyers now. They'll provide you with the legal advice you need to successfully pursue your claim for compensation.</p>
	
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


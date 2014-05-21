<?php
ob_start();
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 60 minutes ago
    session_destroy();   // destroy session data in storage
    session_unset();     // unset $_SESSION variable for the runtime
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

require_once 'includes/init.php';
$city = $_GET['city'];

if ($city == 'Toronto1'){
	$city = 'Toronto';
	$_SESSION['myCity'] = 'Toronto1';
}else{
	$_SESSION['myCity'] = '';
}

$city = str_replace('Mcmurray', 'McMurray', $city);
$cityfile = str_replace(' ', '_', $city);
$cityfile = trim($cityfile);


$title = $city." DUI / Impaired Driving Lawyers";
$banner = $title;

$metaDesc = "Impaired Driving - DUI Lawyers can defend your impaired driving charge. Watch our Impaired Driving information videos and speak to an Impaired Driving lawyer.";

$page = "home";
//$keywords = Array();
//$keywords = "dui,".$city." dui,".$city." dui lawyers,drunk driving,".$city." drunk driving,".$city." drunk driving lawyers,impaired driving,".$city." impaired driving,".$city." impaired driving lawyers,refuse breathalyzer,driving over .08";



$_SESSION['landingCity'] = $city;

$_SESSION['landingLink'] = "http://impaireddriving.ca/Impaired_Driving_Lawyers/PPC/".$city;

$_SESSION['homeLink'] = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];

$lp = true;
$video = 'ca_id_lp_drunk_driving_qtp.mp4';

include 'header.php';

?>

<div class="leftContent">

  <h1>Drunk driving charges can be beaten!</h1>
	
	<p>
	Just because you've been charged with drunk driving, that doesn't mean you'll be convicted. Our <?= $city; ?> drunk driving lawyer knows that, and knows how to help you.
	</p>
 
	<p>
	Drunk driving is a different term for the charge of "impaired driving". No matter what you call it, if you're convicted you're facing serious consequences. But don't give up hope.
	</p>
	
	<p>
	You should know that 30% of all drunk driving charges that are laid in Canada go unproven. That number would probably be higher, but too many people simply plead guilty without ever talking to a lawyer. Don't make that mistake. Have your case reviewed by by our Toronto drunk driving lawyer before you enter your plea.
	</p>
	
	<h2>Don't make assumptions about your case.</h2>
	
	<p>
	Never assume that you'll be convicted. You might be thinking that drunk driving cases are cut and dried. They're not.
	</p>
	
	<p>
	Drunk driving is a criminal charge. And, like any other crime, you're presumed innocent until you're proven guilty. The prosecution may not be able to prove the case against you. Find out if that's the case before you enter your plea. How can that happen?
	</p>
	
	<p>
	Drunk driving laws are complex There are hundreds of rules and procedures that the police and the prosecutors must follow in order to prove their case.  Sometimes they can't, and when they can't the charges must be dismissed. And even if the case can be proven, you might have a defence.
	</p>
	
	<p>
	There are many defences to drunk driving charges, and you need to find out if one applies to you and your case. Don't assume that you don't have a defence. Something that might seem insignificant to you could be the very thing that keeps you from being convicted.
	</p>
	
	<h2>Get advice from our <?= $city; ?> drunk driving lawyer.</h2>
	
	<p>
	Get the opinion of a lawyer who practices drunk driving law in Toronto.
	</p>
	
	<p>
	While drunk driving is a criminal offence (and the Criminal Code applies all across Canada), each province deals with drunk driving charges in their own way. A lawyer who practices law in Toronto will have the knowledge you need if you've been charged anywhere in Ontario.
	</p>
	
	<h2>Should you enter plea negotiations?</h2>
	
	<p>
	Sometimes it's best to try and enter into a "plea bargain". You're lawyer can tell you if this is the case after a careful review of your file.
	</p>
	
	<p>
	Our Toronto drunk driving lawyer knows whom to talk to and how best to present your case to them. Keep in mind that prosecutors and judges are human too. Our lawyer knows which prosecutors are open to discussion, and which ones are not.
	</p>
	
	<p>
	The same can be said of judges. A good drunk driving lawyer will know what judges like to hear, and what should never be said in front of them. That's a very powerful tool that a layman doesn't possess.
	</p>
	
	<h2>Call now!</h2>
	
	<p>
	Don't wait to call. What happens now, at the beginning of your case, can have a huge impact on what happens later. Picking up the phone and calling costs you nothing, so don't wait. Call now!
	</p>
	
	<h2>The bottom line</h2>
	
	<p>
	Find out if you can keep your drivers licence, or avoid a criminal record. You'll learn your options and you'll be able to make an informed decision. But do this before you go to court and enter your plea.
	</p>
	
	
	
<br /><br />
       <div id="lawyerSearch">
        	<h2 style="padding:30px 0 0 0px;"><a href="http://impaireddriving.ca/Impaired_Driving_Lawyers/PPC/<?= $city; ?>/" style="color:#fff;font-size:16px; line-height:18px;">Click Here To View Our <?= $city; ?> DUI Lawyer</a></h2>
        	    
        </div>
  
</div>

<div class="rightContent">

	<? include 'videosList.php'; ?>

    <div id="news" class="rightColumn">

    	<h3>Impaired Driving Latest News</h3>

        <div id="newsInner">

        <!-- start blog loop -->

		<?
		
		
                    include './includes/rss_php.php';

                    $rss = new rss_php;

                    $rss->load('http://justcharged.com/blog/category/impaireddriving/?feed=rss2');

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

<? include 'footer.php'; ?>


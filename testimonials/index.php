<?php


$title = "Does ImpairedDriving.ca Really Work?";

$metaDesc = "Impaired Driving - DUI Lawyers can defend your impaired driving charge.  Watch our Impaired Driving information videos and speaking to an Impaired Driving lawyer.";

$page = "home";

include '../header.php';
if ( !empty( $_POST['username'] ) ) {
	
	$sql = "SELECT c.clientId, c.username FROM clients c WHERE c.siteId = 4 AND  c.username = '" . $_POST['username'] . "' AND c.password = '" . $_POST['password'] . "'";
	$db->query( $sql );

	if ( $db->nextRow() )
	{
		$_SESSION['type'] = "client";
		$_SESSION['id'] = $db->row['clientId'];
		mail("info@impaireddriving.ca, rose@rainmark.com","A potential Client has accessed the testimonials page on impaireddriving.ca","A potential Client has accessed the testimonials page on impaireddriving.ca\r\n\r\n Client Username: ".$db->row['username']."\r\n\r\n Thank You..","From: info@impaireddriving.ca");
	}
	else $failed = true;
	
}

if($_SESSION['type'] != "client") 
{?>
	<br/><br/>
		
		<form method="post">
			<div align='center'>
			<table cellspacing='0' border='0' cellpadding='0' class='frame'><tr><td style='padding: 15px;'>
				<h1><?= $config_title ?> Login</h1>
				<?
					if ( $failed )
						print "<div class='special' style='margin-bottom: 14px;'>Invalid username or password</div>";
				?>
				<table border="0" style='text-align: left;'>
					<tr><td style='padding-right: 8px; text-align: right;'>Username</td><td><input style='width: 160px' type="text" name="username" /></td></tr>
					<tr><td style='padding-right: 8px; text-align: right;'>Password</td><td><input style='width: 160px' type="password" name="password"/></td></tr>
					<tr><td></td><td><input type="submit" value="Login" style="width:50px;"/></td></tr>
				</table>
			</td></tr></table>
			</div>
		</form>
<? } else {
	
?>


<a name="top"></a>
<div id="homeUpper">

<h2 style="margin-top:240px; line-height:18px; width:530px;">ImpairedDriving.ca – Delivering thousands of qualified leads to lawyers specializing in Impaired Driving across Canada for more than 10 years.</h2>

    <div id="homeUpperVideo">

    <!-- Video Player Here -->

    <script type="text/javascript">insertVideoPlayer( "../videoPlayer/videoPlayer.swf", 400, 300, "../videoTestimonials/Mark_McCook.flv", "000000", false, "../images/playVideo.png", "../images/pauseVideo.png" );</script>

    </div>

</div>
<div class="leftContent" >
<?
//if not logged in .. show login form.. else show videos.. ?>
<style>
p { font-size:14px; padding-right:140px; padding-left:60px;}
</style>

  <h1>Does ImpairedDriving.ca really work?</h1>

	<p>Yes it does.  But don't take our word for it.  Take a moment and listen to what current clients have to say.</p>
    
    <p>Watch the videos and feel free to contact our clients should you have any questions.</p>
    
    <p>Greg Dunn<br />
    Dunn & McKay<br />
    403-233-0443</p>
    
    <p>Jeremy Carr<br />
    Carr Buchan & Company<br />
    250-388-7571</p>

  
</div>

<div class="rightContent">

	<? include '../videosList_testimonials.php'; ?>
</div>
    
<? } include '../footer.php'; ?>


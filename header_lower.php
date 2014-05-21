<?
if (empty($video))
	$video = 'test.flv';
	

$cityfile = str_replace(' ', '_', $_SESSION['landingCity']);
$cityfile = trim($cityfile);

if (empty($banner))
	$banner = "Never Plead Guilty!<sup>&reg;</sup>";

if (!empty($_SESSION['landingCity']) && file_exists('images/headers/'.$cityfile.'.jpg')){
?>
<div id="neverUpper" style="background: url(/images/headers_sub/<?=$cityfile;?>.jpg) bottom center no-repeat;">
<?
}else{
?>
<div id="neverUpper">
<?}?>
<div id="subHeader">

	<a href="<?=BASE_URL;?>"><img src="images/drunkDriving.png" width="410" height="104" alt="Impaired Driving - Never Plead Guilty" /></a>

</div>

    <div id="neverUpperVideo" onClick="blur();">

    <!-- Video Player Here -->

    <script type="text/javascript">insertVideoPlayer( "videoPlayer/videoPlayer.swf", 350, 300, "../videos/<?=$video;?>", "000000", false, "images/playVideo.png", "images/pauseVideo.png" );</script>

    </div>
<div id="neverHeadCall"><h2><?=$banner;?></h2></div>
</div>
<? include 'actionBarNew.php';?>
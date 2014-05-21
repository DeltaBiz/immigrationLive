<?php

require_once 'includes/init.php';
$title = "Privacy Policy";
$metaDesc = "Privacy Policy";
$page = "home";
$banner = "";
$bannerTittle = "Privacy Policy";
$video = "divorce_website_spousal_support_qtp.mp4";
$image = "home.png";


include 'header.php';
?>
<div class="leftContent">
<? include 'content/divorce_ca/privacy.php'; ?>
 </div>

<div class="rightContent">

	<? include 'lawyer_window.php'; ?>
    <div class="clear"></div>
	<? include 'divorce_news.php'; ?>
</div>

<div class="clear"></div>

<? $enqScript .= "var slider2 = new Control.Slider('handle1', 'track1', {
				axis: 'vertical',
				onSlide: function(v) { scrollVertical(v, $('newsInner'), slider2);  },
				onChange: function(v) { scrollVertical(v, $('newsInner'), slider2); }
			});
if ($('newsInner').scrollHeight <= $('newsInner').offsetHeight) {
	slider2.setDisabled();
	$('wrap1').hide();
}";

include 'footer.php';  ?>
<?php
require_once 'includes/init.php';
$db->query("SELECT * FROM content WHERE contentId='136'");
$db->nextRow();
$title = $db->row['title'];
$metaDesc = $db->row['metaDesc'];
$metaKeywords = $db->row['metaKeywords'];
$bannerTittle = $db->row['bannerTittle'];
$banner = $db->row['banner'];
$content = $db->row['content'];
$page = $db->row['slug'];
$video = $db->row['video'];
$image = $db->row['image'];
$isHome="YES";
//set the redirect to NoLawyer as NO
include 'header.php';
?>
<div class="leftContent">
<?= $content; ?>
</div>

<div class="rightContent">
	<? include 'lawyer_window.php'; ?>
    <div class="clear"></div>
	<? include 'divorce_news.php'; ?>
     <div class="clear"></div>
</div>

<div class="clear"></div>

<script>
/*
var slider2 = new Control.Slider('handle2', 'track2', {

				axis: 'vertical',

				onSlide: function(v) { scrollVertical(v, $('newsInner'), slider2);  },

				onChange: function(v) { scrollVertical(v, $('newsInner'), slider2); }

			});
	
if ($('newsInner').scrollHeight <= $('newsInner').offsetHeight) {

	slider2.setDisabled();

	$('wrap2').hide();

}
*/		
</script>

<? include 'footer.php'; ?>


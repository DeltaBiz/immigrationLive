<?php
require_once 'includes/init.php';


$db->query("SELECT * FROM content WHERE contentId='139'");
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

include 'header.php';
?>
<div class="leftContent">
<?= $content; ?>

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
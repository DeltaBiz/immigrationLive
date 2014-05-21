<?php
/* COMMENTED BY REQUEST: 8. Divorce Law Latest News. Remove for the time being. . NEWS BOX.
$db->query("SELECT * FROM content WHERE slug<>'".$page."' and siteId = 10 ORDER BY contentId ");
?>
 <div id="videoList" class="rightColumn">
	<h3>Divorce Law Latest News</h3>
     <div id="videoInner">
		<?php
		while($db->nextRow()) {
			$data = $db->row;
			$page_content = str_replace("{city}",$city,$data["banner"]);
			if($data['slug']=="home"){ $data['slug']="index"; }
			$url = $data['slug'];
			
			$link = "/".$url .'';	
		?>
        <div class="videoItem">
			<h3><?=str_replace("{city}",$city,$data["title"]);?></h3>
			<p><?=$page_content?><br /><a href="<?=$link?>">more</a></p>
        </div>        
		<?php } //end while ?>
		 </div>

        <div id="wrap1">
			<div id="track1-top"></div>
			<div id="track1">
				<div id="handle1"></div>
			</div>
            <div id="track1-bottom"></div>
		</div>
    </div>

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
*/
?>
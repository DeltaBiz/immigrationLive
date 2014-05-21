			</div>

    </div>

</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>


<div class="clear"></div>
<br /><br />
<div id="footer">

	<div class="outer">

    	<div id="copyright">
        	<a href="http://divorcefamilylaw.ca/terms_of_use.php">Terms of Use </a> |  
            <a href="http://divorcefamilylaw.ca/sitemap.php">Site Map </a> | <a href="http://divorcefamilylaw.ca/privacy.php">Privacy Policy </a> |  Copyright <?= date("Y");?> Rainmark  |  <a href="mailto:Rose@rainmark.com?cc=Rick@rainmark.com" target="_blank">Contact Us</a> 
		</div>

    </div>

</div>
<div id="containerDiv"> 
	<a id="closeLink" href="javascript:lbox.close();">X CLOSE</a><iframe src="<?=BASE_URL;?>send_to_friend.php?sendURL=<?=urlencode(curPageURL());?>"></iframe> 
</div> 
<div id="containerDiv2"> 
	<a id="closeLink" href="javascript:lbox.close();">X CLOSE</a><iframe src="<?=BASE_URL;?>contact_a_lawyer.php?ID=<?=$lawyer['clientId'];?>"></iframe> 
</div>        
<script type="text/javascript">
	var lbox = new Lightbox('containerDiv');
	var lbox2 = new Lightbox('containerDiv2'); 
</script>
<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36403885-1']);
  _gaq.push(['_trackPageview']);
  setTimeout("_gaq.push(['_trackEvent', '20_seconds', 'read'])",20000);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
</body>

</html>
<?
ob_end_flush();
?>
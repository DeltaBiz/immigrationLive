<?
session_start();
if($_SESSION["adsenseBlock"]=="YES")
{
?>
<div class="clear">&nbsp;</div>
<div class="lawyer_window">
<div class="lawyer_window_heading">Find a divorce / family law lawyer<br />in <? if(empty($_SESSION["adsenseCity"])){ echo $_SESSION['landingCity']; }else{ echo $_SESSION["adsenseCity"]; } ;?></div>	
</div>
<div class="clear">&nbsp;</div>
<div style="text-align:center;  width: 347px; ">

<script type="text/javascript"><!--
google_ad_client = "ca-pub-5889290780775145";
/* Divorce Large Skyscraper */
google_ad_slot = "6906281222";
google_ad_width = 300;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<div class="clear">&nbsp;</div>
</div>
<?	
}
?>
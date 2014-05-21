<?php
if( empty($_SESSION['landingCity']) || $showSearch == true){ 
?>
<div id="searchArea">
    <form name="search2" action="/search_for_a_lawyer.php" method="get" id="search2" autocomplete="off" onsubmit="return getTerm2();">
    <span >Search By City</span>
    <input type="text" name="SearchTerm" class="texta" id="liveTerm2" value="" onfocus="this.value=''" onkeyup="showResult2(this.value)" autocomplete="off" /></span>
    
    <div id="livesearch2" style="display:none;"></div>
    </form>
</div>
<? } else
{ 	
	if(!empty($my_lawyer['clientId']) ){ ?>
	<a href="/contact_a_lawyer2.php?ID=<?=$my_lawyer['clientId'];?>" title="Submit Information" rel="viewbox" id="submitInfo">&nbsp;</a>
	<div id="currentCity">
	<span class="cityName"><?=$_SESSION['landingCity'];?></span>
	<a href="/noLawyer.php"  title="Not Looking For A Lawyer In <?=$_SESSION['landingCity'];?>?"><?= spanWrapWords("NOT IN " . strtoupper($_SESSION['landingCity']));?>?</a>
	</div>	
	<? } else
	{
	?>
	<span class="cityName"><?=$city;?></span>
	<?
	}
}

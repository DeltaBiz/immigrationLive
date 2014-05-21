<?
require_once 'includes/init.php';
$db->query("SELECT * FROM content WHERE contentId>100 order by contentId asc");
while($db->nextRow())
{
echo '<li><a href="http://divorcefamilylaw.ca/'.$db->row['slug'].'/"> '.$db->row['bannerTittle'].' - Divorce and Family Law Lawyers</a></li>';	
}
?>
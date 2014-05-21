<?php
define("BASE_URL","http://www.divorcefamilylaw.ca/");
define("BASE_MASTER_URL","http://www.justcharged.com/");

define("BASE_DIR","/home/justchar/public_html/divorcefamilylaw.ca/");
define("BASE_MASTER_DIR","/home/justchar/public_html/");

session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 60 minutes ago
    //session_destroy();   // destroy session data in storage
    //session_unset();     // unset $_SESSION variable for the runtime
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
if(isset($_GET['city']) && $_GET['city'] != '') { $city = ucwords($_GET['city']);  $_SESSION['landingCity'] = $_GET['city'];}
else { $city = ucwords($_SESSION['landingCity']);}

$cityfile = str_replace(' ', '_', $city);
$cityfile = trim($cityfile);
$cityfile = strtolower($cityfile);

$state= $_GET['state'];

$county= $_GET['county'];

$page = "home";

$_SESSION['landingLink'] = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."/".$city;

$_SESSION['homeLink'] = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];


include BASE_DIR.'includes/functions.php';

include BASE_DIR.'includes/std.lib.php';

$db = new Database();
$db->connect('localhost', 'justchar_user', 'sh3334', 'justchar_db');
$keywords = array('family law', 'divorce law', 'family lawyer', 'divorce lawyer', 'separation', 'divorce', 'common law', 'child support', 'spousal support', 'child maintenance', 'alimony', 'maintenance', 'custody', 'access', 'guardianship', 'separation agreement', 'domestic contract', 'husband', 'wife', 'partner', 'spouse');
$city = ucwords($_SESSION['landingCity']);
?>
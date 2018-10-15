<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];

//role check
if($role > 2) die('Insufficient permissions');

$get = $_GET;

$keys = [
    'sport','league','season','hometeam','awayteam','homescore','awayscore','scheduled','completed'
];

foreach($keys as $key){
    if(!isset($_GET[$key])) die("Missing parameters");
}

//values...
$sport = Sanitizer::sanitize($_GET['sport'],'select_int');
$league = Sanitizer::sanitize($_GET['league'],'select_int');
$season = Sanitizer::sanitize($_GET['league'],'select_int');
$hometeam = Sanitizer::sanitize($_GET['hometeam'],"text");
$awayteam = Sanitizer::sanitize($_GET['awayteam'],"text");
$homescore = Sanitizer::sanitize($_GET['homescore'],"select_int");
$awayscore = Sanitizer::sanitize($_GET['awayscore'],"select_int");
$scheduled = Sanitizer::sanitize($_GET['scheduled'],"datetime");
$completed = (integer)Sanitizer::sanitize($_GET['completed'],'bit');

$key = [$sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed];
$check = (new ScheduleController())->delete_schedule($key);

if($check){
    header("Location: ../../../views/admin/schedule/overview.php?status=ok&type=delete");
    return;
}else{
    header("Location: ../../../views/admin/schedule/overview.php?error=name-taken&type=delete");
return;
}
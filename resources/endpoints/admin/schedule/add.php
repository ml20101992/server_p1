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

$get = $_POST;

$keys = [
    'sls','hometeam','awayteam','homescore','awayscore','scheduled','completed'
];

foreach($keys as $key){
    if(!isset($_POST[$key])) die("Missing parameters");
}

//values...
$sls = Sanitizer::sanitize($_POST['sls'],'composite_key');
$sport = explode("-",$sls)[0];
$league = explode("-",$sls)[1];
$season = explode("-",$sls)[2];
$hometeam = Sanitizer::sanitize($_POST['hometeam'],"text");
$awayteam = Sanitizer::sanitize($_POST['awayteam'],"text");
$homescore = Sanitizer::sanitize($_POST['homescore'],"select_int");
$awayscore = Sanitizer::sanitize($_POST['awayscore'],"select_int");
$scheduled = Sanitizer::sanitize($_POST['scheduled'],"datetime");
$completed = (integer)Sanitizer::sanitize($_POST['completed'],'bit');

$schedule = new Schedule();
$schedule->setValue($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed);

$check = (new ScheduleController())->add_schedule($schedule);
if($check){
    header("Location: ../../../views/admin/schedule/add.php?status=ok");
    return;
}
else{
    header("Location: ../../../views/admin/schedule/add.php?error=name-taken");
    return;
}




?>
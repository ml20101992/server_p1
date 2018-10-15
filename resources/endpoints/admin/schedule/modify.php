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

if(isset($_POST['old_data'])){
    $old_data = Sanitizer::sanitize($_POST['old_data'],'json');
    $old_data = json_decode($old_data);
}else die("Missing Parameters");

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

$key = [$sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed];

//delete old key first
$check = (new ScheduleController())->delete_schedule($old_data);
if($check){
    //add the modified key as new key
    $new = new Schedule();
    $new->setValue($sport,$league,$season,$hometeam, $awayteam,$homescore,$awayscore,$scheduled,$completed);
    $check = (new ScheduleController())->add_schedule($new);
    if($check){
        header("Location: ../../../views/admin/schedule/overview.php?status=ok&type=modify");
        return;
    }
}
header("Location: ../../../views/admin/season/overview.php?error=unknown");
return;
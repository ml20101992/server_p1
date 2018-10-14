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

if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['mascot']) && isset($_POST['sls']) && isset($_POST['picture']) && isset($_POST['homecolor']) && isset($_POST['awaycolor']) && isset($_POST['maxplayers'])){
    $id = Sanitizer::sanitize($_POST['id'],'select_int');
    $name = Sanitizer::sanitize($_POST['name'],'text');
    $mascot = Sanitizer::sanitize($_POST['mascot'],'text');
    $sls = Sanitizer::sanitize($_POST['sls'],'composite_key');
    $sport = explode("-",$sls)[0];
    $league = explode("-",$sls)[1];
    $season = explode("-",$sls)[2];
    $picture = Sanitizer::sanitize($_POST['picture'],'text');
    $homecolor = Sanitizer::sanitize($_POST['homecolor'],'text');
    $awaycolor = Sanitizer::sanitize($_POST['awaycolor'],'text');
    $maxplayers = Sanitizer::sanitize($_POST['maxplayers'],'select_int');

}
else die("Whoops, error, missing data");

$team = new Team();
$team->setValues($name,$mascot,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers);

$check = (new TeamController())->modify_team($team,$id);

if($check){
    header("Location: ../../../views/admin/team/overview.php?status=ok&type=modify");
    return;
}
else{
    header("Location: ../../../views/admin/team/overview.php?error=name-taken");
    return;
}
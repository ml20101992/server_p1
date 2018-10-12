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

$descr = Sanitizer::sanitize($_POST['description'],"text");
$year = Sanitizer::sanitize($_POST['year'],'year');
$id = Sanitizer::sanitize($_POST['id'],'select_int');

$season_ctrl = new SeasonController();

$season = new Season();
$season->setValues($year, $descr);

$check = $season_ctrl->modify_season($season,$id);
if(!$check){
    header("Location: ../../../views/admin/season/overview.php?error=unknown");
    return;
}
else {
    header("Location: ../../../views/admin/season/overview.php?status=ok&type=modify");
    return;
}
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

$id = Sanitizer::sanitize($_GET['id'],'select_int');

$season_ctrl = new SeasonController();
$check = $season_ctrl->delete_season($id);

if(!$check){
    header("Location: ../../../views/admin/season/overview.php?error=unknown");
    return;
}
else {
    header("Location: ../../../views/admin/season/overview.php?status=ok&type=delete");
    return;
}
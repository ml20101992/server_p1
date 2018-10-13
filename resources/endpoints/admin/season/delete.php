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


//first delete slseason containing that season
$sls_ctrl = new SLSController();
$check = $sls_ctrl->cascade_season($id);

if($check){
    $season_ctrl = new SeasonController();
    $check_del = $season_ctrl->delete_season($id);

    if($check_del){
        header("Location: ../../../views/admin/season/overview.php?status=ok&type=delete");
        return;
    }
}

header("Location: ../../../views/admin/season/overview.php?error=unknown");
return;

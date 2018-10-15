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


//sanitization
$sport = Sanitizer::sanitize($_GET['sport'],'select_int');
$league  = Sanitizer::sanitize($_GET['league'],'select_int');
$season  = Sanitizer::sanitize($_GET['season'],'select_int');

$sls_ctrl = new SLSController();
$sls = new SLS();
$sls->setValue($sport,$league,$season);


$check = (new ScheduleController())->cascade_sls($sport,$league,$season);
if($check){
    $check = (new TeamController())->cascade_sls($sport,$league,$season);
    if($check){
        $check = $sls_ctrl->delete_sls($sls);
        if($check){
            header("Location: ../../../views/admin/sls/overview.php?status=ok&type=delete");
            return;

        }
    }
}

header("Location: ../../../views/admin/sls/overview.php?error=name-taken&type=delete");
return;
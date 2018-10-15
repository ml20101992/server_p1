<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];

//role check
if($role !== 1) die('Insufficient permissions');

$id = Sanitizer::sanitize($_GET['id'],'select_int');

$sls_ctrl = new SLSController();
$check = $sls_ctrl->cascade_sport($id);

if($check){

    $check = (new ScheduleController())->cascade_sport($id);

    if($check){
        $sport_ctrl = new SportController();
        $check_del = $sport_ctrl->delete_sport($id);

        if(!$check_del){
            header("Location: ../../../views/admin/sport/overview.php?status=ok&type=delete");
            return;
        }
    }
}


header("Location: ../../../views/admin/sport/overview.php?error=unknown");
return;

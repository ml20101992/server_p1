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

$sport_ctrl = new SportController();
$check = $sport_ctrl->delete_sport($id);

if(!$check){
    header("Location: ../../../views/admin/sport/overview.php?error=unknown");
    return;
}
else {
    header("Location: ../../../views/admin/sport/overview.php?status=ok&type=delete");
    return;
}
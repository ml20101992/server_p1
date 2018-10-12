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

$new_name = Sanitizer::sanitize($_POST['name'],"text");
$id = Sanitizer::sanitize($_POST['id'],'select_int');

$sport_ctrl = new SportController();

$new_sport = new Sport();
$new_sport->set_name($new_name);

$check = $sport_ctrl->modify_sport($new_sport,$id);
if(!$check){
    header("Location: ../../../views/admin/sport/overview.php?error=unknown");
    return;
}
else {
    header("Location: ../../../views/admin/sport/overview.php?status=ok&type=modify");
    return;
}
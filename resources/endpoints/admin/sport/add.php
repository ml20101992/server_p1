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


//sanitization
$name   = Sanitizer::sanitize($_POST['name'],'text');

if($name === "") {
    header("Location: ../../../views/admin/sport/add.php?error=name-not-set");
    return;
}

$sport_ctrl = new SportController();
$sport = new Sport();
$sport->set_name($name);

$check = $sport_ctrl->add_sport($sport);
if(!$check){
    header("Location: ../../../views/admin/sport/add.php?error=name-taken");
    return;
}
else {
    header("Location: ../../../views/admin/sport/add.php?status=ok");
    return;
}


?>
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
$sport = Sanitizer::sanitize($_POST['sport'],'select_int');
$league  = Sanitizer::sanitize($_POST['league'],'select_int');
$season  = Sanitizer::sanitize($_POST['season'],'select_int');


if($sport === "") {
    header("Location: ../../../views/admin/sls/add.php?error=sport-not-set");
    return;
}

if($season === "") {
    header("Location: ../../../views/admin/sls/add.php?error=season-not-set");
    return;
}

if($league === ""){
    header("Location: ../../../views/admin/sls/add.php?error=league-not-set");
    return;
}

$sls_ctrl = new SLSController();
$sls = new SLS();
$sls->setValue($sport,$league,$season);
$check = $sls_ctrl->add_sls($sls);

if(!$check){
    header("Location: ../../../views/admin/sls/add.php?error=name-taken");
    return;
}
else {
    header("Location: ../../../views/admin/sls/add.php?status=ok");
    return;
}


?>
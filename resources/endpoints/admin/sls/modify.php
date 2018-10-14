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

$old_sport = Sanitizer::sanitize($_POST['old_sport'],'select_int');
$old_league = Sanitizer::sanitize($_POST['old_league'],'select_int');
$old_season = Sanitizer::sanitize($_POST['old_season'],'select_int');

$old_sls = new SLS();
$old_sls->setValue($old_sport,$old_league,$old_season);

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

//check if the requested SLS exists
$sls_checked = $sls_ctrl->get_sls_by_key(['sport'=>$sport, 'league'=>$league, 'season'=>$season]);
if(!($sls_checked===null)){
    header("Location: ../../../views/admin/sls/overview.php?error=name-taken");
    return;
}

$check = $sls_ctrl->delete_sls($old_sls);
if($check){
$check = $sls_ctrl->add_sls($sls);

    if($check){
        header("Location: ../../../views/admin/sls/overview.php?status=ok&type=modify");
        return;
    }
}

header("Location: ../../../views/admin/sls/overview.php?error=name-taken&type=modify");
return;


?>
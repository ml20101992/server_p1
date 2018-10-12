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
$descr = Sanitizer::sanitize($_POST['description'],'text');
$year  = Sanitizer::sanitize($_POST['year'],'year_int');

if($descr === "") {
    header("Location: ../../../views/admin/season/add.php?error=desc-not-set");
    return;
}

if($year === "") {
    header("Location: ../../../views/admin/season/add.php?error=year-not-set");
    return;
}

$season_ctrl = new SeasonController();
$season = new Season();
$season->setValues($year, $descr);

$check = $season_ctrl->add_season($season);
if(!$check){
    header("Location: ../../../views/admin/season/add.php?error=name-taken");
    return;
}
else {
    header("Location: ../../../views/admin/season/add.php?status=ok");
    return;
}


?>
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

$team = (new TeamController())->get_team_by_id($id);
if($role === 2 && ($team->get_league() !== $_SESSION['session_data']['user_league'])) die("Insufficient Permissions");


$check = (new TeamController())->delete_team($id);

if($check){
    header("Location: ../../../views/admin/team/overview.php?status=ok&type=delete");
    return;
}


header("Location: ../../../views/admin/team/overview.php?error=unknown");
return;

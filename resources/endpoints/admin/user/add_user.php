<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];

//role check
if($role > 1) die('Insufficient permissions');


//sanitization
$username   = Sanitizer::sanitize($_POST['username'],'username');
$password   = Sanitizer::sanitize($_POST['password'],'password');
$role       = Sanitizer::sanitize($_POST['role'],'select_int');
$team       = Sanitizer::sanitize($_POST['team'],'select_int');
$league     = Sanitizer::sanitize($_POST['league'],'select_int');


//parameter check
if(!$role){
    header("Location: ../../../views/admin/user/add.php?error=role-not-set");
    return;
}

if($role >= 2 && (!$league || $league === 'null')) {
    header("Location: ../../../views/admin/user/add.php?error=league-not-set");
    return;
}

if($role >=3 && (!$team || $team === 'null')){
    header("Location: ../../../views/admin/user/add.php?error=team-not-set");
    return;
}

//admin can have both team and league null and league manager can have team null
if(!$team || $team = 'null') $team = null;
if(!$league || $league = 'null') $league = null;

//check if the role exists
if($role > 5 || $role < 1){
    header("Location: ../../../views/admin/user/add.php?error=invalid_value");
    return;
}

//check if the selected team/league combo exists
if($league != 'null'){
    $league_ctrl = new LeagueController();
    $league = $league_ctrl->get_league_by_id($league);

    if($league == null){          //there is no league with that id
        header("Location: ../../../views/admin/user/add.php?error=invalid_value");
        return;
    }
}

if($team !== 'null'){
    $team_ctrl = new TeamController();
    $team = $team_ctrl->get_team_by_id($team);

    if($team == null || $team->get_league !== $league){          //there is no team with that id
        header("Location: ../../../views/admin/user/add.php?error=invalid_value");
        return;
    }
}

//var_dump([$username,$password,$role,$team,$league]);

$user_ctrl = new UserController();
$user = new User();
// var_dump($user);
$user->setValues($username,$password,$role,$team,$league);
var_dump($user);

$check = $user_ctrl->add_new_user($user);
if(!$check){
    header("Location: ../../../views/admin/user/add.php?error=username-taken");
    return;
}
else {
    header("Location: ../../../views/admin/user/add.php?status=ok");
    return;
}


?>
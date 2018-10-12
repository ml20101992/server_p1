<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$own_role = $_SESSION['session_data']['user_role'];
$own_team = $_SESSION['session_data']['user_team'];

$old_username   = Sanitizer::sanitize($_POST['old_username'],'username');
$username       = Sanitizer::sanitize($_POST['username'],'username');
$password       = Sanitizer::sanitize($_POST['password'],'password');
$role           = Sanitizer::sanitize($_POST['role'],'select_int');
$team           = Sanitizer::sanitize($_POST['team'],'select_int');
$league         = Sanitizer::sanitize($_POST['league'],'select_int');

$user_ctrl = new UserController();
$old_user = $user_ctrl->get_user_by_username($old_username);

if($own_role > 1){
    //check if the user is changing own data
    if(!($_SESSION['session_data']['username'] === $old_username)){
        die('Insufficient permissions');
    }

    //check by role
    //check for league admin
    if($old_user->get_role() !==3 || $old_user->get_role() !==4) die("Insufficient permissions");
    
    //check for team admins/coach
    if(!($old_user->get_role() <=3 && $old_user->get_team() === $own_team )) die("Insufficient permissions");

    //drop parent if it attemted to change anything not its own
    if($old_role === 5 && $old_username !== $_SESSION['session_data']['username']) die("Insufficient permissions");
}

//check if the selected team/league combo exists
if($league != 'null'){
    $league_ctrl = new LeagueController();
    $league = $league_ctrl->get_league_by_id($league);

    if($league == null){          //there is no league with that id
        header("Location: ../../../views/admin/user/modify.php?error=invalid_value");
        return;
    }
}

if($team !== 'null'){
    $team_ctrl = new TeamController();
    $team = $team_ctrl->get_team_by_id($team);

    if($team == null || $team->get_league !== $league){          //there is no team with that id
        header("Location: ../../../views/admin/user/modify.php?error=invalid_value");
        return;
    }
}

if($password === "") $password = $old_user->get_pw_hash();
$new_user = new User();
$new_user->setValues($username,$password,$role,$team,$league);
$new_user->set_hash($password);                                     //since setValues automatically hashes the password, this will just replace the new hash with old hash if
                                                                    //the field is left blank
$check = $user_ctrl->modify_user($new_user,$old_username);
if($check) header("Location: ../../../views/admin/user/modify.php?status=ok");
else header("Location: ../../../views/admin/user/modify.php?error=404");
?>
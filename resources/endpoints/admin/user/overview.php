<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];
if($role === 5){
    die("Insufficient Permissions");
}

$users = null;


$page = 0;
if(isset($_GET['page'])){
    $page = Sanitizer::sanitize($_GET['page'],'int');
    if($page === false) $page = 0;
}


$user_ctrl = new UserController();

switch($role){
    case 1: $users = $user_ctrl->get_all_users();
        break;
    case 2: {           //league manager
        $selector = 'role IN (?,?)';
        $values = [3,4];

        $users = $user_ctrl->get_users_by_selector_query($selector,$values);
    }break;

    default:{           //coach/team manager
        $selector = 'role < ? AND team = ?';

        $values = ['2',$_SESSION['session_data']['user_team']];
        $users = $user_ctrl->get_users_by_selector_query($selector,$values);
    }break;
}

$users = array_slice($users,$page*10,10);
$count = sizeof($users);

$final_data = array();

foreach($users as $user){
    $data = array();
    $data['username'] = $user->get_username();

    $role_ctrl = new RoleController();
    $role = $role_ctrl->get_role_name($user->get_role());
    $data['role'] = $role->get_role_name();

    
    $team_ctrl = new TeamController();
    $team = $team_ctrl->get_team_by_id($user->get_team());

    if($team !== null){
        $data['team'] = $team->get_name();
    }
    else{
        $data['team'] = 'None Set';
    }

    $league_ctrl = new LeagueController();
    $league = $league_ctrl->get_league_by_id($user->get_league());

    if($league !== null){
        $data['league'] = $league->get_name();
    }else{
        $data['league'] = 'None Set'; 
    }

    array_push($final_data,$data);
}

echo json_encode(['count'=>$count, 'data'=> $final_data]);
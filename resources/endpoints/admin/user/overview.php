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

$sanitized_array = array();

foreach($users as $user){
    $data = $user->db_config();

    $saved = array();
    
    for($i = 0; $i < sizeof($data['keys']); $i++){
        $saved[$data['keys'][$i]] = $data['values'][$i];
    }
    unset($saved['password']);

    array_push($sanitized_array,$saved);
}

echo json_encode(['count'=>$count, 'data'=> $sanitized_array]);
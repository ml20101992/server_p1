<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}
$own_role = $_SESSION['session_data']['user_role'];

$username = Sanitizer::sanitize($_GET["username"], 'username');
$user_controller = new UserController();
$old_user = $user_controller->get_user_by_username($username);

if($own_role > 1){
    //check by role
    //check for league admin
    if($own_role === 2){
        if($old_user->get_role() !==3 || $old_user->get_role() !==4) die("Insufficient permissions");
    }

    //check for team admins/coach
    if($own_role === 3 || $own_role === 4){
        if(!($old_user->get_role() <=3 && $old_user->get_team() === $own_team )) die("Insufficient permissions");
    }

    //drop parent
    if($role === 5) die("Insufficient permissions");
}


$user_id = $old_user->get_username();

$check = $user_controller->delete_user($user_id);

if(!$check){
    header("Location: ../../../views/admin/user/overview.php?error=deletion_failed");
    return;
}
else {
    header("Location: ../../../views/admin/user/overview.php?status=ok");
    return;
}

?>
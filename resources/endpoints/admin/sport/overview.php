<?php
require_once('../../../autoload.php');

$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];
if($role !== 1){
    die("Insufficient Permissions");
}


$page = 0;
if(isset($_GET['page'])){
    $page = Sanitizer::sanitize($_GET['page'],'int');
    if($page === false) $page = 0;
}

$sport_ctrl = new SportController();
$sports = $sport_ctrl->get_all_sports();

$users = array_slice($sports,$page*10,10);

$totals = array();
foreach($sports as $sport){
    $data = array();
    $data['id'] = $sport->get_id();
    $data['name'] = $sport->get_name();

    array_push($totals,$data);
}

echo json_encode(['count' => sizeof($totals), 'data' => $totals]);






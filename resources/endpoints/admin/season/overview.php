<?php
require_once('../../../autoload.php');

$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];
if($role > 2){
    die("Insufficient Permissions");
}


$page = 0;
if(isset($_GET['page'])){
    $page = Sanitizer::sanitize($_GET['page'],'int');
    if($page === false) $page = 0;
}

$season_ctrl = new SeasonController();
$seasons = $season_ctrl->get_all_seasons();

$seasons = array_slice($seasons,$page*10,10);

$totals = array();

foreach($seasons as $season){
    $data = array();
    $data['id'] = $season->get_id();
    $data['year'] = $season->get_year();
    $data['description'] = $season->get_description();

    array_push($totals,$data);
}

echo json_encode(['count' => sizeof($totals), 'data' => $totals]);






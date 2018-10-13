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

$sls_col = (new SLSController())->get_all_sls();

$sls_col = array_slice($sls_col,$page*10,10);

$totals = array();

foreach($sls_col as $sls){
    $data = array();

    $sport['id'] = $sls->get_sport();
    $sport['name'] = ((new SportController())->get_sport_by_id($sls->get_sport()))->get_name();
    
    $league['id'] = $sls->get_league();
    $league['name'] = ((new LeagueController())->get_league_by_id($sls->get_league()))->get_name();
    
    $season['id'] = $sls->get_season();
    $season['name'] = ((new SeasonController())->get_season_by_id($sls->get_season()))->get_description();

    $data['sport'] = $sport;
    $data['league'] = $league;
    $data['season'] = $season;

    array_push($totals,$data);
}

echo json_encode(['count' => sizeof($totals), 'data' => $totals]);






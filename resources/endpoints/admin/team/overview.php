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

$teams = (new TeamController())->get_all_teams();

//admin can see all, lm can see only his own league
if($role === 2){
    $new_arr = array();
    $league = $_SESSION['session_data']['user_league'];
    foreach($teams as $team){
        if($team->get_league() === $league)
        array_push($new_arr,$team);
    }
    $teams = $new_arr;
}


$count = sizeof($teams);
$teams = array_slice($teams,$page*10,10);

$totals = array();

foreach($teams as $team){
    $data = array();

    $data['id'] = $team->get_id();

    $data['name']       = $team->get_name();
    $data['mascot']     = $team->get_mascot();
    $sport = $team->get_sport();
    $league = $team->get_league();
    $season = $team->get_season();

    $data['sls'] = ((new SportController())->get_sport_by_id($sport))->get_name()."/".
                   ((new LeagueController())->get_league_by_id($league))->get_name()."/".
                   ((new SeasonController())->get_season_by_id($season))->get_description();
    
    $data['picture'] = $team->get_picture();
    $data['homecolor'] = $team->get_homecolor();
    $data['awaycolor'] = $team->get_awaycolor();
    $data['maxplayers'] = $team->get_maxplayers();

    array_push($totals,$data);
}

echo json_encode(['count' => $count, 'data' => $totals]);






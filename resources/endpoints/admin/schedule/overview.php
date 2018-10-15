<?php
require_once('../../../autoload.php');
$session = new Session();
$check = $session->check_if_valid();

if(!$check){
    die('Unauthorized');
}

$role = $_SESSION['session_data']['user_role'];

$page = 0;
if(isset($_GET['page'])){
    $page = Sanitizer::sanitize($_GET['page'],'int');
    if($page === false) $page = 0;
}

$schedules = null;
if($role == 1) $schedules = (new ScheduleController())->get_all_schedules();
else{
    $league = $_SESSION['session_data']['user_league'];
    $schedules = (new ScheduleController())->get_schedules_by_league($league);
}

$count = sizeof($schedules);

$seasons = array_slice($schedules,$page*10,10);

$final_data = array();
foreach($schedules as $schedule){
    $data = array();

    $sport['id'] = $schedule->get_sport();
    $sport['name'] = ((new SportController())->get_sport_by_id($schedule->get_sport()))->get_name();
    
    $league['id'] = $schedule->get_league();
    $league['name'] = ((new LeagueController())->get_league_by_id($schedule->get_league()))->get_name();
    
    $season['id'] = $schedule->get_season();
    $season['name'] = ((new SeasonController())->get_season_by_id($schedule->get_season()))->get_description();

    $hometeam['id'] = $schedule->get_hometeam();
    $hometeam['name'] = ((new TeamController())->get_team_by_id($schedule->get_hometeam()))->get_name();

    $awayteam['id'] = $schedule->get_awayteam();
    $awayteam['name'] = ((new TeamController())->get_team_by_id($schedule->get_awayteam()))->get_name();

    $homescore = $schedule->get_homescore();
    $awayscore = $schedule->get_awayscore();
    $scheduled = $schedule->get_scheduled();
    $completed = $schedule->get_completed();

    $data['sport'] = $sport;
    $data['league'] = $league;
    $data['season'] = $season;
    $data['hometeam'] = $hometeam;
    $data['awayteam'] = $awayteam;
    $data['homescore'] = $homescore;
    $data['awayscore'] = $awayscore;
    $data['scheduled'] = $scheduled;
    $data['completed'] = $completed;

    array_push($final_data,$data);

}

echo json_encode(['count'=>$count,'data'=>$final_data]);
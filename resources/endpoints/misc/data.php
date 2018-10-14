<?php
require_once('../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$c_role = $_SESSION['session_data']['user_role'];

if(isset($_GET['data_target'])){
    $target = Sanitizer::sanitize($_GET['data_target'],"text");

    switch($target){
        case "req_team":{
            if(isset($_GET['sls'])){
                $sls = Sanitizer::sanitize($_GET['sls'],'composite_key');
                $sls = explode("-",$sls);
                $sls_obj = new SLS();
                $sls_obj->setValue($sls[0],$sls[1],$sls[2]);
                $teams = (new TeamController())->get_all_teams();
                
                $final_teams = array();
                foreach($teams as $key=>$team){

                    if((($team->get_sport()) == ($sls_obj->get_sport())) && (($team->get_league()) == ($sls_obj->get_league())) && (($team->get_season()) == ($sls_obj->get_season()))){

                        $data['team_id'] = $team->get_id();
                        $data['team_name'] = $team->get_name();
                        array_push($final_teams,$data); 
                    }
                }

                echo json_encode(['code'=>200, 'data'=>$final_teams]);
                return;
            }else{
                echo json_encode(["code"=>'400', 'details'=>"Invalid Request"]);
            }            
        }break;
    }

}else echo json_encode(["code"=>'400', 'details'=>"Invalid Request"]);
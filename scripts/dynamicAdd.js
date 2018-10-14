parseLocation();

function parseLocation(){
    let location = window.location.href;
    let selector = location.split('/');
    selector = selector[9];

    switch(selector){
        case "user":{
            
        }break;

        case "schedule":{
            initScheduleConfig();
        }break;
    }

}

function initScheduleConfig(){
    let first_select = document.getElementById('schedule_first');
    console.log(first_select);
    first_select.onclick = function(){
        showScheduleTeams(first_select.value);
    }
}

function showScheduleTeams(value){
    $url = "../../../endpoints/misc/data.php?data_target=req_team&sls="+value;
    ajaxGetRequest($url,createMatchup,function(){console.log("Failed")});
}

function createMatchup(data){
    data = JSON.parse(data);
    let teams_panel = document.getElementById('teams');
    teams_panel.innerHTML = "";
    teams_panel.appendChild(createTeamFieldSet(data.data,true));             //creating home team
    teams_panel.appendChild(createTeamFieldSet(data.data,false));

    document.getElementById('schedule_remainder').classList.remove('collapsed');
}

function createTeamFieldSet(teams, home){
    let fieldset = document.createElement('fieldset')
    fieldset.id = (home === true)?'f_home':'f_away';

    let legend = document.createElement('legend');
        legend.appendChild(document.createTextNode((home === true)?"Home Team":"Away Team"));
    
    fieldset.appendChild(legend);

    let select = document.createElement('select');
    select.name = (home === true)?'hometeam':'awayteam';

    for(let team of teams){
        let option = document.createElement('option');
        option.value = team.team_id;
        option.appendChild(document.createTextNode(team.team_name));
        select.appendChild(option);
    }

    fieldset.appendChild(select);

    return fieldset;
}




function ajaxGetRequest(resource_url,success_function,fail_function){
    $.ajax({
        url             :resource_url,
        contentType     :'json',
        success         :function(result){
            success_function(result);
        },
        error           :function(){
            fail_function();
        }
    }
    );
}
var endpoint = "";
var success_function = null;
var current_page = 0;

parseLocation();
ajaxGetRequest(endpoint + current_page,success_function,fail);



function parseLocation(){
    let location = window.location.href;
    let selector = location.split('/');
    selector = selector[selector.length - 2];
    //console.log(selector);


    switch(selector){
        case "user":{
            endpoint = "http://localhost/faks/server/p1/resources/endpoints/admin/user/overview.php?page="
            success_function = createUserOverview;
        }break;

        case "sport":{
            endpoint = "http://localhost/faks/server/p1/resources/endpoints/admin/sport/overview.php?page="
            success_function = createSportOverview;
        }break;

        case "season":{
            endpoint = "http://localhost/faks/server/p1/resources/endpoints/admin/season/overview.php?page="
            success_function = createSeasonOverview;
        }break;

        case "sls":{
            endpoint = "http://localhost/faks/server/p1/resources/endpoints/admin/sls/overview.php?page="
            success_function = createSLSOverview;
        }break;

        case "team":{
            endpoint = "http://localhost/faks/server/p1/resources/endpoints/admin/team/overview.php?page="
            success_function = createTeamOverview;
        }break;

        case "schedule":{
            endpoint = "http://localhost/faks/server/p1/resources/endpoints/admin/schedule/overview.php?page="
            success_function = createScheduleOverview;
        }break;
    }
}

function createUserOverview(data){
    data = JSON.parse(data);
    let table = document.createElement('table');
    table.border = 1;

    let header = document.createElement('tr');
    header.innerHTML = "<th>USERNAME</th><th>ROLE</th><th>TEAM</th><th>LEAGUE</th><th></th><th></th>";

    table.appendChild(header);
    
    let users = data.data;
    
    for(var user in users){
        let row = fillUserRow(users[user]);
        table.appendChild(row);
    }

    document.getElementById("main-content").appendChild(table); 
}

function fillUserRow(user){
    let row = document.createElement('tr');
        for(var u in user){
            let cell = document.createElement('td');
            cell.appendChild(document.createTextNode(user[u]));
            row.appendChild(cell);
        }
    let modify = document.createElement('a');
        modify.appendChild(document.createTextNode("Modify"));
        modify.href = "modify.php?ref=overview&username="+user.username;
        modify.classList.add('button');

    let delete_btn = document.createElement('a');
        delete_btn.appendChild(document.createTextNode("Delete"));
        delete_btn.href = "../../../endpoints/admin/user/delete.php?username="+user.username;
        delete_btn.classList.add('button');
    
    let cell = document.createElement('td');
    row.appendChild(cell.appendChild(modify));
    cell = document.createElement('td');
    row.appendChild(cell.appendChild(delete_btn));
    return row;
}


//SPORTS
function createSportOverview(data){
    data = JSON.parse(data);

    let table = document.createElement('table');
    table.border = 1;

    let header = document.createElement('tr');
    header.innerHTML = "<th>SPORT NAME</th><th></th><th></th>";

    table.appendChild(header);
    
    for(let sport of data.data){
        let row = createSportRow(sport);
        table.appendChild(row);
    }

    document.getElementById("main-content").appendChild(table); 
}

function createSportRow(sport){
    let row = document.createElement('tr');
    let name = document.createElement('td');
        name.appendChild(document.createTextNode(sport.name));
    
    let modify = document.createElement('a');
        modify.appendChild(document.createTextNode("Modify"));
        modify.href = "modify.php?ref=overview&id="+sport.id;
        modify.classList.add('button');

    let delete_btn = document.createElement('a');
        delete_btn.appendChild(document.createTextNode("Delete"));
        delete_btn.href = "../../../endpoints/admin/sport/delete.php?id="+sport.id;
        delete_btn.classList.add('button');
    
    let cell = document.createElement('td');
    row.appendChild(cell.appendChild(name));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(modify));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(delete_btn));
    return row;
}

//END SPORTS

//SEASON
function createSeasonOverview(data){
    data = JSON.parse(data);
    
    let table = document.createElement('table');
    table.border = 1;

    let header = document.createElement('tr');
    header.innerHTML = "<th>DESCRIPTION</th><th>YEAR</th><th></th><th></th>";

    table.appendChild(header);
    
    for(let sport of data.data){
        let row = createSeasonRow(sport);
        table.appendChild(row);
    }

    document.getElementById("main-content").appendChild(table); 
}

function createSeasonRow(season){
    let row = document.createElement('tr');
    let name = document.createElement('td');
        name.appendChild(document.createTextNode(season.description));

    let year = document.createElement('td');
        year.appendChild(document.createTextNode(season.year));
    
    let modify = document.createElement('a');
        modify.appendChild(document.createTextNode("Modify"));
        modify.href = "modify.php?ref=overview&id="+season.id;
        modify.classList.add('button');

    let delete_btn = document.createElement('a');
        delete_btn.appendChild(document.createTextNode("Delete"));
        delete_btn.href = "../../../endpoints/admin/season/delete.php?id="+season.id;
        delete_btn.classList.add('button');
    
    let cell = document.createElement('td');
    row.appendChild(cell.appendChild(name));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(year));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(modify));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(delete_btn));
    return row;

}


//END SEASON

//SLS
function createSLSOverview(data){
    data = JSON.parse(data);

    let table = document.createElement('table');
    table.border = 1;

    let header = document.createElement('tr');
    header.innerHTML = "<th>SPORT</th><th>LEAGUE</th><th>SEASON</th><th></th>";

    table.appendChild(header);
    
    for(let sls of data.data){
        let row = createSLSRow(sls);
        table.appendChild(row);
    }

    document.getElementById("main-content").appendChild(table); 
}

function createSLSRow(data){
    let row = document.createElement('tr');
    let sport = document.createElement('td');
        sport.appendChild(document.createTextNode(data.sport.name));

    let league = document.createElement('td');
        league.appendChild(document.createTextNode(data.league.name));

    let season = document.createElement('td');
        season.appendChild(document.createTextNode(data.season.name));
    
    let modify = document.createElement('a');
        modify.appendChild(document.createTextNode("Modify"));
        modify.href = "modify.php?ref=overview&sport="+data.sport.id+"&league="+data.league.id+"&season="+data.season.id;
        modify.classList.add('button');

    let delete_btn = document.createElement('a');
        delete_btn.appendChild(document.createTextNode("Delete"));
        delete_btn.href = "../../../endpoints/admin/sls/delete.php?sport="+data.sport.id+"&league="+data.league.id+"&season="+data.season.id;
        delete_btn.classList.add('button');
    
    let cell = document.createElement('td');
    row.appendChild(cell.appendChild(sport));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(league));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(season));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(modify));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(delete_btn));
    return row;
}


//end sls

//TEAM
function createTeamOverview(data){
    data = JSON.parse(data);

    let table = document.createElement('table');
    table.border = 1;

    let header = document.createElement('tr');
    header.innerHTML = "<th>NAME</th><th>MASCOT</th><th>SPORT/LEAGUE/SEASON</th><th>PICTURE</th><th>HOME COLOR</th><th>AWAY COLOR</th><th>MAX PLAYERS</th><th></th>";

    table.appendChild(header);
    
    for(let sls of data.data){
        let row = createTeamRow(sls);
        table.appendChild(row);
    }

    document.getElementById("main-content").appendChild(table); 
}

function createTeamRow(data){
    let row = document.createElement('tr');

    let name = document.createElement('td');
        name.appendChild(document.createTextNode(data.name));

    let mascot = document.createElement('td');
        mascot.appendChild(document.createTextNode(data.mascot));

    let sls = document.createElement('td');
        sls.appendChild(document.createTextNode(data.sls));

    let picture = document.createElement('td');
        picture.appendChild(document.createTextNode(data.picture));

    let homecolor = document.createElement('td');
        homecolor.appendChild(document.createTextNode(data.homecolor));
     
    let awaycolor = document.createElement('td');
        awaycolor.appendChild(document.createTextNode(data.awaycolor));
    
    let maxplayers = document.createElement('td');
        maxplayers.appendChild(document.createTextNode(data.maxplayers));

    let modify = document.createElement('a');
        modify.appendChild(document.createTextNode("Modify"));
        modify.href = "modify.php?ref=overview&id="+data.id;
        modify.classList.add('button');

    let delete_btn = document.createElement('a');
        delete_btn.appendChild(document.createTextNode("Delete"));
        delete_btn.href = "../../../endpoints/admin/team/delete.php?id="+data.id;
        delete_btn.classList.add('button');
    
    let cell = document.createElement('td');
    row.appendChild(cell.appendChild(name));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(mascot));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(sls));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(picture));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(homecolor));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(awaycolor));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(maxplayers));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(modify));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(delete_btn));
    return row;
}


//END TEAM

//SCHEDULE
function createScheduleOverview(data){
    data = JSON.parse(data);
    
    let table = document.createElement('table');
    table.border = 1;

    let header = document.createElement('tr');
    header.innerHTML = "<th>SPORT</th><th>LEAGUE</th><th>SEASON</th><th>HOME TEAM</th><th>AWAY TEAM</th><th>HOME SCORE</th><th>AWAY SCORE</th><th>SCHEDULED</th><th>COMPLETED</th><th></th>";

    table.appendChild(header);
    
    for(let schedule of data.data){
        let row = createScheduleRow(schedule);
        table.appendChild(row);
    }

    document.getElementById("main-content").appendChild(table); 
}

function createScheduleRow(data){
    let row = document.createElement('tr');

    let sport = document.createElement('td');
        sport.appendChild(document.createTextNode(data.sport.name));

    let league = document.createElement('td');
        league.appendChild(document.createTextNode(data.league.name));

    let season = document.createElement('td');
        season.appendChild(document.createTextNode(data.season.name));

    let hometeam = document.createElement('td');
        hometeam.appendChild(document.createTextNode(data.hometeam.name));

    let awayteam = document.createElement('td');
        awayteam.appendChild(document.createTextNode(data.awayteam.name));
     
    let homescore = document.createElement('td');
        homescore.appendChild(document.createTextNode(data.homescore));
    
    let awayscore = document.createElement('td');
        awayscore.appendChild(document.createTextNode(data.awayscore));

    let scheduled = document.createElement('td');
        scheduled.appendChild(document.createTextNode(data.scheduled));

    let completed = document.createElement('td');
        completed.appendChild(document.createTextNode((data.completed == 0)?"No":"Yes"));

    let modify = document.createElement('a');
        modify.appendChild(document.createTextNode("Modify"));
        modify.href = "modify.php?ref=overview&sport="+data.sport.id+"&league="+data.league.id+"&season="+
                        data.season.id+"&hometeam="+data.hometeam.id+"&awayteam="+data.awayteam.id+"&homescore="+data.homescore+
                        "&awayscore="+data.awayscore+"&scheduled="+encodeURIComponent(data.scheduled)+"&completed="+data.completed;
        modify.classList.add('button');

    let delete_btn = document.createElement('a');
        delete_btn.appendChild(document.createTextNode("Delete"));
        delete_btn.href = "../../../endpoints/admin/schedule/delete.php?ref=overview&sport="+data.sport.id+"&league="+data.league.id+"&season="+
                            data.season.id+"&hometeam="+data.hometeam.id+"&awayteam="+data.awayteam.id+"&homescore="+data.homescore+
                            "&awayscore="+data.awayscore+"&scheduled="+encodeURIComponent(data.scheduled)+"&completed="+data.completed;
        delete_btn.classList.add('button');
    
    let cell = document.createElement('td');
    row.appendChild(cell.appendChild(sport));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(league));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(season));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(hometeam));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(awayteam));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(homescore));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(awayscore));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(scheduled));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(completed));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(modify));

    cell = document.createElement('td');
    row.appendChild(cell.appendChild(delete_btn));
    return row;
}


//END SCHEDULE

//MISC

function fail(){
    console.log("Ajax Error");
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
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
        }
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
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
        delete_btn.classList.add('button');

    row.appendChild(modify);
    row.appendChild(delete_btn);
    return row;
}

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
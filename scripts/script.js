var sidenav_togglers = document.getElementsByClassName('sidebar-element-toggle');
var iframe_sources = {
    'user_add'      : '../resources/views/admin/user/add.php',
    'user_modify'   : '../resources/views/admin/user/modify.php',
    'user_overview' : '../resources/views/admin/user/overview.php'
}

if(sidenav_togglers.length > 0){
    for(let toggle of sidenav_togglers){
        toggle.addEventListener('click',function(e){
            let source = e.target;
            let parent = source.parentElement;

            let holder = parent.getElementsByClassName('holder')[0];
            expand(holder);
        });
    }
}


function expand(element){
    if(element.classList.contains('collapsed')) element.classList.remove('collapsed');
    else (element.classList.add('collapsed'));
}

function iframeChangeSource(source){
    let target = iframe_sources[source];
    document.getElementById('content_iframe').src = target;    
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

function success(result){
    console.log(result);
}

function fail(){
    console.log("Request failed");
}
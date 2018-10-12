var sidenav_togglers = document.getElementsByClassName('sidebar-element-toggle');
var iframe_sources = {
    'user_add'          : '../resources/views/admin/user/add.php',
    'user_modify'       : '../resources/views/admin/user/modify.php',
    'user_overview'     : '../resources/views/admin/user/overview.php',
    'sport_add'         : '../resources/views/admin/sport/add.php',
    'sport_overview'    : '../resources/views/admin/sport/overview.php',
    'season_add'        : '../resources/views/admin/season/add.php',
    'season_overview'   : '../resources/views/admin/season/overview.php'
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


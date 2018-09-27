var sidenav_togglers = document.getElementsByClassName('sidebar-element-toggle');
var iframe_sources = {
    'user_add':'../resources/views/admin/user/add.php'
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
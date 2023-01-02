function showNotif() {
    let out = document.getElementById('notifs');
    if(out.classList.contains('escondido')) {
        out.classList.remove('escondido');
        out.classList.remove('fadeOut')
        out.classList.add('fadeIn')

    }
    else {

        out.classList.remove('fadeIn')
        out.classList.add('fadeOut')

        setTimeout(function() {
            out.classList.add('escondido');
        }
        , 400);

    }
}



function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

function readNotification() {
    let btns = document.getElementsByClassName("rNotif");
    for(let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            let id = btns[i].parentElement.getAttribute('notif-id');
            sendAjaxRequest('post','/readnotification?id=' + id,{idbtn: id},notifHandler(id));
        })
    }
}

function notifHandler(id) {
    let count = document.querySelector("body > main > div.cont > header > div.auth.d-flex > div > button > span");
    let notif = document.querySelector('li[notif-id="' + id + '"]');
    let icon = notif.lastElementChild.firstElementChild;
    
    icon.classList.remove("fa-xmark");
    icon.classList.add("fa-check");
    if(count.textContent > 0) {
        count.textContent = count.textContent - 1;
    }
}
readNotification()


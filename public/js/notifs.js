function showNotif() {
    let out = document.getElementById('notifs');
    if(out.classList.contains('escondido')) {
        out.classList.remove('escondido');
    }
    else {
        out.classList.add('escondido');
    }
}

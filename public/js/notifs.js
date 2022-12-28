function showNotif() {
    let out = document.getElementById('notifs');
    if(out.classList.contains('escondido')) {
        out.classList.remove('escondido');
        out.classList.remove('fadeOut')
        out.classList.add('fadeIn')

    }
    else {
        out.classList.add('escondido');
        out.classList.remove('fadeIn')
        out.classList.add('fadeOut')

    }
}

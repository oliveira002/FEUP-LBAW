var flag = 1;
function counter() {
    var deadline = document.getElementById("datat").innerHTML;
    deadline = new Date(deadline).getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var t = deadline - now;
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        document.getElementById("day").innerHTML =days ;
        document.getElementById("hour").innerHTML =hours;
        document.getElementById("minute").innerHTML = minutes;
        document.getElementById("second").innerHTML =seconds;
        if (t < 0) {
            /*const boxes = document.querySelectorAll('.dia');
            for (const box of boxes) {
                box.classList.add('nt');
            }
            document.getElementById("expired").innerHTML = 'ENDED';*/
            clearInterval(x);
            document.getElementById("day").innerHTML ='';
            document.getElementById("hour").innerHTML ='';
            document.getElementById("minute").innerHTML ='' ;
            document.getElementById("second").innerHTML = ''; 
            if(flag == 1) {
                location.reload();
                flag++;
            }
        }
    }, 1000);

}counter();




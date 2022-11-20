function valid(){
    var a = document.getElementsByClassName("bidstatus")
    for (var i = 0; i < a.length; i++) {
        if (a[i].innerHTML.trim() === "Valid") {
            a[i].style.color = "green";

        } else {
            a[i].style.color = "red";
        }
        console.log(a[i].innerHTML);
    }

}
valid();




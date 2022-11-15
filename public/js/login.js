function hideDiv() {
    var x = document.getElementById("loginpage");
    var d = document.getElementById("registerpage");
    if (x.style.display === "none") {
        x.style.display = "block";
        d.style.display = "none";
    }   else {
        x.style.display = "none";
        d.style.display = "block";
    }
}

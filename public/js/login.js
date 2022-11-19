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

function alo() {
    var about = document.querySelector("#content > div > div > div.outside > div > div:nth-child(2) > div:nth-child(2) > div:nth-child(1)")
    var auct = document.querySelector("#content > div > div > div.outside > div > div:nth-child(2) > div:nth-child(2) > div:nth-child(2)")
    var x = document.querySelector("#content > div > div > div.outside > div > div:nth-child(2) > div.about")
    var d = document.querySelector("#content > div > div > div.outside > div > div:nth-child(2) > div.auctions")
    if (x.style.display === "none") {
        about.classList.add("high")
        auct.classList.remove("high2")
        x.style.display = "block";
        d.style.display = "none";
    }   else {
        about.classList.remove("high")
        auct.classList.add("high2")
        x.style.display = "none";
        d.style.display = "block";
    }
}

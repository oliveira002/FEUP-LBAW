function updateRating() {
    let star = document.querySelectorAll('input');
    let showValue = document.querySelector('#rating-value');

    for (let i = 0; i < star.length; i++) {
        star[i].addEventListener('click', function () {
            i = this.value;
            if(i === "1") {
                showValue.innerHTML = "Awful Experience 🤬";
            }
            else if(i === "2") {
                showValue.innerHTML = "Bad Experience 😡";
            }
            else if(i === "3") {
                showValue.innerHTML = "Average Experience 😑";
            }
            else if(i === "4") {
                showValue.innerHTML = "Good Experience 👍";
            }
            else if(i === "5") {
                showValue.innerHTML = "Wonderful Experience 🔥" ;
            }
        });
    }
}
updateRating();

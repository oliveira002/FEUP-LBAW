const buttons = document.querySelectorAll("[data-slideshow-button]");


buttons.forEach((button) => {

    //After 5 seconds, the slideshow will automatically change to the next slide
    setInterval(() => {
        if(button.dataset.slideshowButton.trim() === "next")
        button.click();
    }, 5000);

    button.addEventListener("click", () => {
        const offset = button.dataset.slideshowButton.trim() === "next" ? 1 : -1;
        const slides = button.closest("[data-slideshow]").querySelector("[data-slides]");
        if(slides.children.length > 1) {


        const active = slides.querySelector("[data-active]");
        let newIdx = [...slides.children].indexOf(active) + offset;
        if (newIdx < 0) {
            newIdx = slides.children.length - 1;
        }
        if (newIdx >= slides.children.length) {
            newIdx = 0;
        }
        console.log(newIdx);
        slides.children[newIdx].dataset.active = "";
        active.removeAttribute("data-active");
        slides.children[newIdx].hidden = false;
        active.hidden = true;


        }

    });
});



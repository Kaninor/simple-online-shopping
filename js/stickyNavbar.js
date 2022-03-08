const navbar = document.getElementById("navbar");
let sticky = navbar.offsetTop;

window.onscroll = () => {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
};
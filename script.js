let nav = document.querySelector("#nav");
let section1 = document.querySelector("#section1");
let section1left = document.querySelector("#section1-left");
let section2 = document.querySelector("#section2");
let body = document.querySelector("body");
let close = document.querySelector("#close");
let menu = document.querySelector("#menu");
let getStartedButton = document.querySelectorAll(".get-started");

window.addEventListener('resize', setSize);
window.addEventListener('load', setSize);

function setSize() {
    let newHeight = window.innerHeight - nav.offsetHeight - 45;
    // section1.style.height = `${newHeight}px`;
    nav.style.width = `${body.offsetWidth}px`;
    // console.log('test')
}


menu.addEventListener('click', () => {
    nav.classList.toggle("toggle");
})

close.addEventListener('click', () => {
    nav.classList.toggle("toggle");
})

getStartedButton.forEach(button => {
    button.addEventListener('click', () => {
        window.location.href = "signup.php";
    })
})
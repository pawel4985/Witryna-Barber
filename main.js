//hamburger menu animacja po kliknięciu
document.querySelector("header .hamburger").addEventListener("click",()=>{
    for(i=0;i<3;i++){
        document.getElementsByClassName('ham')[i].classList.toggle("active")
    }
})
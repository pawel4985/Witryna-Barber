//hamburger menu animacja po kliknięciu
document.querySelector("header .hamburger").addEventListener("click",()=>{
    for(i=0;i<3;i++){
        document.getElementsByClassName('ham')[i].classList.toggle("active")
    }
})
//wysunięcie logowania
document.querySelector("header .login .log_item").addEventListener("click",()=>{
    document.querySelector("header .login form.logowanie").classList.toggle("show")
    document.querySelector("header .login .log_item").classList.toggle("show")
})
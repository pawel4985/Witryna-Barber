//hamburger menu animacja po kliknięciu
document.querySelector("header .hamburger").addEventListener("click", () => {
    for (i = 0; i < 3; i++) {
        document.getElementsByClassName('ham')[i].classList.toggle("active")
    }
})
//wysunięcie logowania
if (document.querySelector("header .login .log_item")) {
    document.querySelector("header .login .log_item").addEventListener("click", () => {
        document.querySelector("header .login form.logowanie").classList.toggle("show")
        document.querySelector("header .login .log_item").classList.toggle("show")
    })
}
//newsletter
if (document.getElementById('newsletter')) {
    document.getElementById('newsletter').addEventListener("click", () => {
        document.querySelector("header .login form.logowanie label:nth-of-type(4)").classList.toggle("show");
    })
}
//kalendarz
date = new Date();
actual = new Date();
calendar()

function calendar() {
    date.setDate(1);
    sundays=0;
    miesiace = [
        "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesień",
        "Październik", "Listopad", "Grudzień"
    ]
    days = ""
    dni = ["Niedz", "Pon", "Wt", "Śr", "Czw", "Pt", "Sob", "Niedz"]
    document.querySelector("main .appointment .content .apoint .left .calendar .mounth").innerHTML = miesiace[date.getMonth()];
    document.querySelector("main .appointment .content .apoint .left .calendar .date").innerHTML = dni[actual.getDay()] + " " + date.getDate() +
        " " + miesiace[date.getMonth()] + " " + date.getFullYear();
    tabela = document.querySelector(".calendar .days");
    const lastDay = new Date(
        date.getFullYear(),
        date.getMonth() + 1,
        0
    ).getDate();
    const prevLastDay = new Date(
        date.getFullYear(),
        date.getMonth(),
        0
    ).getDate();
    function firstDayIndex() {
        if (date.getDay() == 0) {
            return 6
        } else {
            return date.getDay() - 1
        }
    }
    const lastDayIndex = new Date(
        date.getFullYear(),
        date.getMonth() + 1,
        0
    ).getDay();
    const nextDays = 7 - lastDayIndex - 1;
    for (let x = firstDayIndex(); x > 0; x--) {
        sundays++;
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }

    for (let i = 1; i <= lastDay; i++) {
        sundays++;
        if (
            i === new Date().getDate() &&
            date.getMonth() === new Date().getMonth()
        ) {
            if(sundays==7){
                days += `<div class="today">${i}</div>`;
                sundays=0;
            }else{
                days += `<div class="today" onclick="select(this)">${i}</div>`;
            }
            
        } else {
            if(sundays==7){
                days += `<div style="cursor: default;">${i}</div>`;
                sundays=0;
            }else{
                days += `<div onclick="select(this)">${i}</div>`;
            }
            
        }
    }

    for (let j = 1; j <= nextDays + 1; j++) {
        days += `<div class="next-date"">${j}</div>`;
        tabela.innerHTML = days;
    }
}

function nextLastDay(i) {
    const nextLastDay = new Date(
        date.getFullYear(),
        date.getMonth() + i + 1,
        0
    ).getDate();
    return nextLastDay
}
let count = 1;
let count_days = 0;
document.querySelector(".control img:first-of-type").addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
    calendar()
})
document.querySelector(".control img:last-of-type").addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    calendar()
})

let last_div

function select(div) {
    if (last_div) {
        last_div.classList.remove("select");
    }
    div.classList.add("select");
    last_div = div;
    appoint()
}

function appoint() {
    if (document.querySelector(".select")) {
        dzien = document.querySelector(".select").textContent
        miesiac = date.getMonth() + 1
        if (dzien < 10) {
            dzien = "0" + dzien;
        }
        if (miesiac < 10) {
            miesiac = "0" + miesiac;
        }
        data = date.getFullYear() + "-" + miesiac + "-" + dzien
        document.getElementById("date").value = data;
    }
}
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
miesiace = [
    "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesień",
    "Październik", "Listopad", "Grudzień"
]
days = ""
dni = ["Niedz", "Pon", "Wt", "Śr", "Czw", "Pt", "Sob", "Niedz"]
document.querySelector("main .appointment .content .apoint .left .calendar .mounth").innerHTML = miesiace[date.getMonth()];
document.querySelector("main .appointment .content .apoint .left .calendar .date").innerHTML = dni[date.getDay()] + " " + date.getDate() +
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
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
}

for (let i = 1; i <= lastDay; i++) {
    if (
        i === new Date().getDate() &&
        date.getMonth() === new Date().getMonth()
    ) {
        days += `<div class="today">${i}</div>`;
    } else {
        days += `<div>${i}</div>`;
    }
}

for (let j = 1; j <= nextDays + 1; j++) {
    days += `<div class="next-date">${j}</div>`;
    tabela.innerHTML = days;
}
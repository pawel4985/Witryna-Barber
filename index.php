<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="main.js" defer></script>
    <title>Barbercentral</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <img src="img/scissors.png" alt="logo-nożyczki" class="logo">
            <div class="hamburger">
                <span class="ham"></span>
                <span class="ham"></span>
                <span class="ham"></span>
            </div>
            <div class="login">
                <div class="log_item"><img src="img/user.png"></div>
                <form class="logowanie" action="" method="post">
                    <?php
                    if ($_POST) {
                        $log = $_POST['log'];
                        $pass =  $_POST["pass"];
                        @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                        $check = mysqli_query($db, "SELECT * FROM accounts WHERE nazwa='$log';");
                        if (!empty($log)) {
                            if (mysqli_num_rows($check) > 0) {
                                if (!empty($pass)) {
                                    if (password_verify($pass, mysqli_fetch_assoc($check)['haslo'])) {
                                        echo ("<script>document.querySelector('header .login form.logowanie').classList.add('show')
                                    document.querySelector('header .login .log_item').classList.add('show')</script>");
                                        echo ("<p class='positive'>Zalogowano!</p>");
                                        echo ("<script>setTimeout(()=>{
                                        document.querySelector('header .login form.logowanie').classList.remove('show')
                                        document.querySelector('header .login .log_item').classList.remove('show')
                                    },1500)</script>");
                                        $_SESSION["log"] = true;
                                        if (mysqli_fetch_assoc($check)['typ'] = "pracownik") {
                                            $_SESSION["admin"] = true;
                                        }
                                    } else {
                                        echo ("<script>document.querySelector('header .login form.logowanie').classList.add('show')
                                    document.querySelector('header .login .log_item').classList.add('show')</script>");
                                        echo ("<p class='wrong'>Złe hasło!</p>");
                                    }
                                } else {
                                    echo ("<script>document.querySelector('header .login form.logowanie').classList.add('show')
                                    document.querySelector('header .login .log_item').classList.add('show')</script>");
                                    echo ("<p class='wrong'>Podaj hasło!</p>");
                                }
                            } else {
                                echo ("<script>document.querySelector('header .login form.logowanie').classList.add('show')
                                    document.querySelector('header .login .log_item').classList.add('show')</script>");
                                echo ("<p class='wrong'>Nie istnieje konto o podanej nazwie!</p>");
                            }
                        } else {
                            echo ("<script>document.querySelector('header .login form.logowanie').classList.add('show')
                                    document.querySelector('header .login .log_item').classList.add('show')</script>");
                            echo ("<p class='wrong'>Podaj login!</p>");
                        }
                    }
                    ?>
                    <label><img src="img/user_log.png"><input type="text" name="log" placeholder="Login"></label>
                    <label><img src="img/key_log.png"><input type="password" name="pass" placeholder="Hasło"></label>
                    <input type="submit" value="ZALOGUJ">
                    <a href="register.php">REJESTRACJA</a>
                </form>
            </div>
            <div class="content">
                <h1>BarberCentral</h1>
                <p>Zadbamy<span class="yellow"> kompleksowo </span>o twój<br> wizerunek, włosy i zarost</p>
                <img src="img/beard.png" alt="broda ikonka" class="header_logo">
            </div>
            <a href="" class="visit">Umów się na wizytę</a>
        </header>
        <main>
            <div class="services">
                <h2>Nasze usługi</h2>
                <div class="service">
                    <div>
                        <div>
                            <img src="img/beard.png" alt="broda">
                        </div>
                        <p class="yellow">Strzyżenie brody/trymowanie</p>
                        <p>(grooming brody / pielęgnacja)</p>
                    </div>
                    <div>
                        <div>
                            <img src="img/hair.png" alt="włosy">
                        </div>
                        <p class="yellow">Strzyżenie włosów</p>
                        <p>(strzyżenie / pielęgnacja / modelowanie)</p>
                    </div>
                    <div>
                        <div>
                            <img src="img/bald.png" alt="włosy">
                        </div>
                        <p class="yellow">Strzyżenie na łyso + shaver</p>
                        <p>(strzyżenie / shaver / pielęgnacja)</p>
                    </div>
                </div>
            </div>
            <div class="team">
                <h2>Nasz zespół</h2>
                <p>Nasi barberzy są <span class="yellow">zawodowcami</span> z wysokim<br> doświadczeniem, oferują usługi na najwyższym poziomie.</p>
                <div class="teammates">
                    <div>
                        <img src="img/team1.jpg" alt="Jack Tosan">
                        <p class="title">Jack Tosan</p>
                        <p>Specjalista od włosów</p>
                    </div>
                    <div>
                        <img src="img/team2.jpg" alt="Jhonatan Smith">
                        <p class="title">Jonatan Smith</p>
                        <p>Stylista od włosów</p>
                    </div>
                    <div>
                        <img src="img/team3.jpg" alt="Michael Brown">
                        <p class="title">Michael Brown</p>
                        <p>Specjalista od trymowania</p>
                    </div>
                </div>
            </div>
            <div class="appointment">
                <div class="content">
                    <h2>Umów się na wizytę</h2>
                    <form class="apoint" action="" method="POST">
                        <div class="left">
                            <input type="text" name="dane">
                            <div class="calendar"></div>
                        </div>
                        <div class="services">
                            <label>Strzyżenie brody<input type="radio"></label>
                            <label>Strzyżenie włosów<input type="radio"></label>
                            <label>Strzyżenie na łyso + shaver<input type="radio"></label>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <h3>KONTAKT</h3>
            <div class="contact">
                <div>
                    <p>Zadzwoń lub napisz</p>
                    <p>+48 568 542 231</p>
                    <p>barbercentral@gmail.com</p>
                </div>
                <div>
                    <p>Nasz adres</p>
                    <p>ul. Polna 4, 03-287</p>
                    <p>Warszawa</p>
                </div>
                <div>
                    <p>Godziny pracy</p>
                    <p>pon-pt: 8:00-18:00</p>
                    <p>sob: 8:00-15:00</p>
                    <p>niedz: nieczynne</p>
                </div>
            </div>
            <p class="copy">&copy; 2022 BarberCentral</p>
        </footer>
    </div>
</body>

</html>
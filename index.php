<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Barbercentral">
    <meta name="description" content="Barbercentral - Zadbamy kompleksowo o twój wizerunek, włosy i zarost">
    <meta name="keywords" content="włosy, broda, zarost, barber, fryzjer">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Paweł Kowalski">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img//favicon.ico">
    <link rel="stylesheet" href="styles/style.css">
    <script src="main.js" defer></script>
    <title>Barbercentral</title>
</head>

<body>
    <div class="wrapper">
        <div class="control admin"></div>
        <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            echo ("<script>document.querySelector('.control').innerHTML='<a href=admin.php>ZARZĄDZAJ</a>';</script>");
        }
        ?>
        <nav>
            <ul>
                <li><a onclick="scroll_apoint('main div.day_offer')">Oferta dnia</a></li>
                <li><a onclick="scroll_apoint('main div.services')">Nasze usługi</a></li>
                <li><a onclick="scroll_apoint('main div.team')">Nasz zespół</a></li>
                <li><a onclick="scroll_apoint('main div.opinions')">Opinie</a></li>
            </ul>
        </nav>
        <header>
            <a href="index.php"><img src="img/scissors.png" alt="logo-nożyczki" class="logo"></a>
            <div class="hamburger">
                <span class="ham"></span>
                <span class="ham"></span>
                <span class="ham"></span>
            </div>
            <div class="login">
                <div class="log_item"><img src="img/user.png"></div>
                <form class="logowanie" action="" method="post">
                    <p class="first_login"></p>
                    <?php
                    if (isset($_POST['login'])) {
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
                                        $_SESSION["name"] = $log;
                                        $check = mysqli_query($db, "SELECT * FROM accounts WHERE nazwa='$log';");
                                        $_SESSION["user_id"] = mysqli_fetch_assoc($check)['id'];
                                        $check = mysqli_query($db, "SELECT * FROM accounts WHERE nazwa='$log';");
                                        if (mysqli_fetch_assoc($check)['typ'] == "pracownik") {
                                            $_SESSION['admin'] = true;
                                            echo ("<script>document.querySelector('.control').innerHTML='<a href=admin.php>ZARZĄDZAJ</a>';</script>");
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
                        mysqli_close($db);
                    }
                    ?>
                    <label><img src="img/user_log.png"><input type="text" name="log" placeholder="Login"></label>
                    <label><img src="img/key_log.png"><input type="password" name="pass" placeholder="Hasło"></label>
                    <input type="submit" name="login" value="ZALOGUJ">
                    <a href="register.php">REJESTRACJA</a>
                </form>
            </div>
            <?php
            if (isset($_SESSION['log'])) {
                echo ("<script>
                document.querySelector('header .login').innerHTML += '<img class=logout onclick=logout() src=img/logout.png>';
            </script>");
            }
            ?>
            <div class="content">
                <h1>BarberCentral</h1>
                <p>Zadbamy<span class="yellow"> kompleksowo </span>o twój<br> wizerunek, włosy i zarost</p>
                <img src="img/beard.png" alt="broda ikonka" class="header_logo">
            </div>
            <a onclick="scroll_apoint(' #apoint_form')" class="visit">Umów się na wizytę</a>
        </header>
        <main>
            <?php
            @$db3 = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
            $day_of = mysqli_query($db3, "SELECT nazwa_uslugi,rabat FROM day_offer;");
            echo ("<div class='day_offer'>
            <h2>Oferta dnia</h2>
            <div class='content'>
                <div class='left'><img src='img/calendar.png' alt='kalendarz'></div>
                <div class='right'>");
            while ($row = mysqli_fetch_assoc($day_of)) {
                echo ("<p>Tylko dziś $row[nazwa_uslugi]<span> -$row[rabat]%</span></p>");
            }
            echo ("<a onclick='scroll_apoint(`#apoint_form`)' class='visit'>Umów się na wizytę</a>
                </div>
            </div>
        </div>");

            ?>
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
            <?php
            echo '<div class="opinions">';
            echo '<h2>Opinie</h2>';
            @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
            if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM opinions;")) > 0) {
                echo '<p class="title">Opinie naszych klientów</p>';
                echo ' <div class="opinion">';
                echo ' <img src="img/circle_arrow_left.png">';
                echo ' <div class="inside">';
                $pyt1 = mysqli_query($db, "SELECT opinia,accounts.nazwa AS username FROM opinions JOIN accounts ON opinions.user=accounts.id;");
                while ($row = mysqli_fetch_assoc($pyt1)) {
                    echo ("<div>
                            <p class='nickname'>$row[username]</p>
                            <p class='contents'>$row[opinia]</p>
                            </div>");
                }

                echo ' </div>';
                echo ' <img src="img/circle_arrow_right.png">';
                echo '</div>';
            } else {
                echo '<div></div>';
            }

            if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                if (!isset($_SESSION["admin"])) {
                    echo ("<a href='add_opinion.php' class='visit'>Napisz opinię</a>");
                }
            } else {
                echo ("<a onclick='scroll_apoint(`header`)' class='visit'>Napisz opinię</a>");
            }
            echo '</div>';
            ?>
            <div class="appointment">
                <div class="content" id="apoint_form">
                    <h2>Umów się na wizytę</h2>
                    <div class="apoint">
                        <p class="wrong"></p>
                        <p class="positive"></p>
                        <form action="" id="apoi" method="post">
                            <div class="left">
                                <input type="text" id="dane" placeholder="Imię i nazwisko" name="dane">
                                <div class="calendar" id="cal">
                                    <div class="control">
                                        <img src="img/arrow-left.png">
                                        <img src="img/arrow-right.png">
                                    </div>
                                    <p class="mounth"></p>
                                    <p class="date"></p>
                                    <div class="days_name">
                                        <div>Pon</div>
                                        <div>Wt</div>
                                        <div>Śr</div>
                                        <div>Czw</div>
                                        <div>Pt</div>
                                        <div>Sob</div>
                                        <div>Niedz</div>
                                    </div>
                                    <div class="days">
                                    </div>
                                </div>
                                <label>Godzina: <select name="hour" id="hour">
                                        <option value="">-----</option>
                                        <option value="8:00">8:00</option>
                                        <option value="8:30">8:30</option>
                                        <option value="9:00">9:00</option>
                                        <option value="9:30">9:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                    </select>
                                </label>
                            </div>
                            <div class="right">
                                <div class="services">
                                    <?php
                                    @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych;");
                                    $pyt1 = mysqli_query($db, "SELECT * FROM services;");
                                    while ($row = mysqli_fetch_assoc($pyt1)) {
                                        echo ("<div><label>$row[nazwa_uslugi]</label><input name='serv' value='$row[id]' type='radio'></div>");
                                    }
                                    mysqli_close($db)
                                    ?>
                                </div>
                                <input type="hidden" name="data" id="date">
                                <input type="submit" name="apoint" value="UMÓW" onclick="appoint()">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['apoint'])) {
                $dane = $_POST['dane'];
                $godzina = $_POST['hour'];
                if (isset($_POST['serv'])) {
                    $usluga = $_POST['serv'];
                }
                $data = $_POST['data'];
                if (!empty($dane)) {
                    if (!empty($godzina) || $godzina = '') {
                        if (!empty($data)) {
                            if (!empty($usluga)) {
                                @$db1 = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych;");
                                mysqli_query($db1, "INSERT INTO appoints(dane,godzina,data,usluga) VALUES('$dane','$godzina','$data',$usluga);");
                                echo ("<script>document.querySelector('.apoint p.positive').innerHTML = 'Zostałeś umówiony!';document.querySelector('#apoint_form').scrollIntoView({
                                    behavior: 'auto'
                                });</script>");
                            } else {
                                echo ("<script>document.querySelector('.apoint p.wrong').innerHTML = 'Wybierz usługę!';document.querySelector('#apoint_form').scrollIntoView({
        behavior: 'auto'
    });</script>");
                            }
                        } else {
                            echo ("<script>document.querySelector('.apoint p.wrong').innerHTML = 'Wybierz datę!';document.querySelector('#apoint_form').scrollIntoView({
        behavior: 'auto'
    });</script>");
                        }
                    } else {
                        echo ("<script>document.querySelector('.apoint p.wrong').innerHTML = 'Wybierz godzinę!';document.querySelector('#apoint_form').scrollIntoView({
        behavior: 'auto'
    });</script>");
                    }
                } else {
                    echo ("<script>document.querySelector('.apoint p.wrong').innerHTML = 'Podaj imię i nazwisko!';document.querySelector('#apoint_form').scrollIntoView({
        behavior: 'auto'
    });</script>");
                }
            }
            ?>
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
                    <p>pon-sob: 8:00-15:30</p>
                    <p>niedz: nieczynne</p>
                </div>
            </div>
            <p class="copy">&copy; 2022 BarberCentral</p>
        </footer>
    </div>
</body>

</html>
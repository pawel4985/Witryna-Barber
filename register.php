<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img//favicon.ico">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/overwrite.css">
    <title>BarberCentral - rejestracja</title>
</head>

<body>
    <header>
        <a href="index.php"><img src="img/scissors.png" alt="logo-nożyczki" class="logo"></a>
        <div class="login">
            <form class="logowanie" action="" method="post">
                <?php
                if ($_POST) {
                    $log = $_POST['log'];
                    $pass =  $_POST["pass"];
                    $r_pass = $_POST['r_pass'];
                    $email = $_POST["email"];
                    @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                    $check = mysqli_query($db, "SELECT * FROM accounts WHERE nazwa='$log';");
                    if (!empty($log)) {
                        if (mysqli_num_rows($check) == 0) {
                            if (!empty($pass)) {
                                if (!empty($r_pass)) {
                                    if ($pass == $r_pass) {
                                        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                                        if (!empty($email)) {
                                            mysqli_query($db, "INSERT INTO accounts(nazwa,haslo,typ,email) VALUES('$log','$pass','klient','$email');");
                                            echo ("<p class='positive'>Utworzono konto!</p>");
                                        } else {
                                            mysqli_query($db, "INSERT INTO accounts(nazwa,haslo,typ) VALUES('$log','$pass','klient');");
                                            echo ("<p class='positive'>Utworzono konto!</p>");
                                        }
                                    } else {
                                        echo ("<p class='wrong'>Hasła nie są identyczne!</p>");
                                    }
                                } else {
                                    echo ("<p class='wrong'>Powtórz hasło!</p>");
                                }
                            } else {
                                echo ("<p class='wrong'>Podaj hasło!</p>");
                            }
                        } else {
                            echo ("<p class='wrong'>Istnieje już konto o podanej nazwie!</p>");
                        }
                    } else {
                        echo ("<p class='wrong'>Podaj login!</p>");
                    }
                }
                ?>
                <label><img src="img/user_log.png"><input type="text" name="log" placeholder="Login"></label>
                <label><img src="img/key_log.png"><input type="password" name="pass" placeholder="Hasło"></label>
                <label><img src="img/key_log.png"><input type="password" name="r_pass" placeholder="Powtórz hasło"></label>
                <label id="email"><img src="img/email_log.png"><input type="email" name="email" placeholder="Email"></label>
                <label><input type="checkbox" name="newsletter" id="newsletter">Chce otrzymywać newsletter</label>
                <input type="submit" value="ZAREJESTRUJ">
            </form>
        </div>
    </header>
    <script src="main.js"></script>
</body>

</html>
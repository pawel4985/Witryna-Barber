<?php
session_start();
if (!isset($_SESSION["admin"]) && $_SESSION["admin"] != true) {
    header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/overwrite.css">
    <title>BarberCentral - dodaj ofertę dnia</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <ul>
                    <li><a href="../admin.php">Najbliższe wizyty</a></li>
                    <li><a href="">Dodaj oferte dnia</a></li>
                    <li><a href="add_services.php">Dodaj usługę</a></li>
                </ul>
            </nav>
            <a href="../index.php"><img src="../img/scissors.png" alt="logo-nożyczki" class="logo"></a>
            <div class="login">
                <form class="logowanie" action="" method="post">
                    <?php
                    if ($_POST) {
                        $service = strtolower($_POST['service']);
                        $rabat = $_POST['rabat'];
                        @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                        if (!empty($service)) {
                            if (!empty($rabat)) {
                                mysqli_query($db, "DELETE FROM day_offer WHERE id=1;");
                                mysqli_query($db, "INSERT INTO day_offer(id,nazwa_uslugi,rabat) VALUES(1,'$service',$rabat);");
                                echo ("<p class='positive'>Dodano ofertę dnia!</p>");
                            } else {
                                echo ("<p class='wrong'>Ustal wysokość rabatu!</p>");
                            }
                        } else {
                            echo ("<p class='wrong'>Wpisz nazwę usługi!</p>");
                        }
                    }
                    ?>
                    <label style="border-bottom: 1.4px solid #444;"><img src="../img/service.png"><input type="text" name="service" placeholder="Nazwa usługi"></label>
                    <label style="border-bottom: 1.4px solid #444;"><img src="../img/percent.png"><input type="number" name="rabat" min=1 placeholder="Wysokość rabatu"></label>
                    <input type="submit" value="Dodaj ofertę dnia">
                </form>
            </div>
        </header>
    </div>
</body>

</html>
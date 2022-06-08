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
    <link rel="icon" type="image/x-icon" href="../img//favicon.ico">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/overwrite.css">
    <title>BarberCentral - dodaj usługę</title>
</head>

<body>
    <div class="wrapper">
        <header class="serv">
            <nav>
                <ul>
                    <li><a href="../admin.php">Najbliższe wizyty</a></li>
                    <li><a href="add_day_offer.php">Dodaj oferte dnia</a></li>
                    <li><a href="add_services.php">Dodaj usługę</a></li>
                </ul>
            </nav>
            <a href="../index.php"><img src="../img/scissors.png" alt="logo-nożyczki" class="logo"></a>
            <div class="login">
                <div class="appoints">
                    <form class="logowanie usluga" action="" method="post">
                        <?php
                        if (isset($_POST['add'])) {
                            $service = $_POST['service'];
                            @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                            if (!empty($service)) {
                                mysqli_query($db, "INSERT INTO services(nazwa_uslugi) VALUES('$service');");
                                echo ("<p class='positive'>Dodano usługę!</p>");
                            } else {
                                echo ("<p class='wrong'>Uzupełnij pole!</p>");
                            }
                        }
                        if (isset($_POST['delete'])) {
                            if (isset($_POST['id'])) {
                                @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                                $pyt1 = mysqli_query($db, "DELETE FROM services WHERE id=$_POST[id]");
                            }
                        }
                        ?>
                        <label style="border-bottom: 1.4px solid #444;"><img src="../img/service.png"><input type="text" name="service" placeholder="Nazwa usługi"></label>
                        <input type="submit" name='add' value="Dodaj usługę">
                    </form>
                    <div class="table">
                        <table CELLSPACING=0 style="width: 100%">
                            <tr>
                                <th colspan="2">Nazwa uslugi</th>
                            </tr>
                            <?php
                            @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                            $pyt1 = mysqli_query($db, "SELECT id,nazwa_uslugi FROM services;");
                            while ($row = mysqli_fetch_assoc($pyt1)) {
                                echo ("<form action='' method='post'><tr><td>$row[nazwa_uslugi]</td><td><input type='submit' name='delete' value='USUŃ'><input type='hidden' name='id' value=$row[id]></td></tr></form>");
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

        </header>
    </div>
</body>

</html>
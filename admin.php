<?php
session_start();
if (!isset($_SESSION["admin"]) && $_SESSION["admin"] != true) {
    header("Location:index.php");
}
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
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/overwrite.css">
    <script src="main.js" defer></script>
    <title>Barbercentral - zarządzanie</title>
</head>

<body>
    <div class="wrapper">
        <nav>
            <ul>
                <li><a href="admin.php">Najbliższe wizyty</a></li>
                <li><a>Oferta dnia</a></li>
                <li><a href="">Dodaj oferte dnia</a></li>
                <li><a href="">Dodaj usługę</a></li>
            </ul>
        </nav>
        <header>
            <a href="index.php"><img src="img/scissors.png" alt="logo-nożyczki" class="logo"></a>
            <div class="appoints">
                <table>
                    <tr>
                        <th>Klient</th>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Usługa</th>
                    </tr>
                    <?php
                    @$db = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                    $pyt1 = mysqli_query($db, "SELECT * FROM appoints;");
                    while ($row = mysqli_fetch_assoc($pyt1)) {
                        echo ("<tr><td>$row[dane]</td><td>$row[data]</td><td>$row[godzina]</td><td>$row[usluga]</td></tr>");
                    }
                    ?>
                </table>
            </div>
        </header>
    </div>
</body>

</html>
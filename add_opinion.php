<?php
session_start();
if (!isset($_SESSION["log"]) || !isset($_SESSION["name"]) || !isset($_SESSION["user_id"])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img//favicon.ico">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/overwrite.css">
    <title>BarberCentral - dodaj usługę</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <a href="index.php"><img src="img/scissors.png" alt="logo-nożyczki" class="logo"></a>
            <div class="login">
                <div class="appoints">
                    <form class="logowanie" action="" method="post">
                        <?php
                        $user_id = $_SESSION['user_id'];
                        if (isset($_POST['add_opinion'])) {
                            @$db1 = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                            $check = mysqli_query($db1, "SELECT * FROM opinions WHERE user=$user_id;");
                            $opinion_P = $_POST['opinion'];
                            if (!empty($opinion_P)) {
                                if (mysqli_num_rows($check) > 0) {
                                } else {
                                    mysqli_query($db1, "INSERT INTO opinions(opinia,user) VALUES ('$opinion_P',$user_id);");
                                    echo ("<p class='positive'>Dodano opinię!</p>");
                                }
                            } else {
                                echo ("<p class='wrong'>Wypełnij pole!</p>");
                            }
                            mysqli_close($db1);
                        }
                        if (isset($_POST['edit_opinion'])) {
                            @$db3 = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                            $check = mysqli_query($db3, "SELECT * FROM opinions WHERE user=$user_id;");
                            $opinion_P = $_POST['opinion'];
                            if (!empty($opinion_P)) {
                                if (mysqli_num_rows($check) > 0) {
                                    mysqli_query($db3, "UPDATE opinions SET opinia='$opinion_P' WHERE user=$user_id;");
                                    echo ("<p class='positive'>Edytowano opinię!</p>");
                                }
                            } else {
                                echo ("<p class='wrong'>Wypełnij pole!</p>");
                            }
                            mysqli_close($db3);
                        }
                        if (isset($_POST['delete_opinion'])) {
                            @$db4 = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                            mysqli_query($db4, "DELETE FROM opinions WHERE user=$user_id;");
                            mysqli_close($db4);
                        }
                        @$db2 = mysqli_connect("localhost", "root", "", "barber") or die("Błąd połączenia z bazą danych!");
                        $check = mysqli_query($db2, "SELECT * FROM opinions WHERE user=$user_id;");
                        if (mysqli_num_rows($check) > 0) {
                            $opinion = mysqli_fetch_assoc(mysqli_query($db2, "SELECT * FROM opinions WHERE user=$user_id;"))['opinia'];
                            echo ("<label style='border-bottom: 1.4px solid #444;'><img src='img/opinion.png'><textarea type='text' name='opinion'>$opinion</textarea></label>");
                            echo ("<div style='display:flex;'><input type='submit' name='edit_opinion' value='Edytuj opinię' style='margin-right:20px;'>");
                            echo ("<input type='submit' name='delete_opinion' value='Usuń opinię'></div>");
                        } else {
                            echo ("<label style='border-bottom: 1.4px solid #444;'><img src='img/opinion.png'><textarea type='text' name='opinion' placeholder='Opinia'></textarea></label>");
                            echo ("<input type='submit' name='add_opinion' value='Dodaj opinię'>");
                        }
                        mysqli_close($db2)
                        ?>
                    </form>
                </div>
            </div>

        </header>
    </div>
</body>

</html>


<?php

?>
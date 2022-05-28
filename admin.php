<?php
session_start();
if (!$_SESSION["admin"]) {
    header("Location:index.php");
} else {
    echo ("witaj adminie");
}
?>
<h1></h1>
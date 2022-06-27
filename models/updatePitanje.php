<?php
session_start();
include "../konekcija/konekcija.php";
include "functions.php";
if ($_SESSION['korisnik']) {
    $idPitanja = $_POST["idPitanja"];
    izmenaStausaPoruke($idPitanja);
    header('Refresh:0, Location: ../index.php?page=admin-poruke');
}

<?php
session_start();
include "../konekcija/konekcija.php";
include "functions.php";
if ($_SESSION['korisnik']) {
    global $konekcija;
    $korisnik = $_SESSION['korisnik'];
    $upit = "UPDATE korisnici SET statusAktivnosti = 0 WHERE id_korisnik = :id_korisnik";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":id_korisnik", $korisnik->id_korisnik);
    $unesi->execute();
    unset($_SESSION['korisnik']);
    header('Location: ../index.php?page=login');
}

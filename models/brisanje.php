<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {
        $kId = $_POST['idK'];
        $brisanjeKorisnika = brisanjeKorisnika($kId);
        if ($brisanjeKorisnika) {
            $odgovor = ["poruka" => "Uspešno ste obrisali korisnika"];
            echo json_encode($odgovor);
            http_response_code(201);
        }
    } catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode($exception);
    }
} else {
    http_response_code(404);
}

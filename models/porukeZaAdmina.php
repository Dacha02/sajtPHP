<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {
        $naslov = addslashes($_POST['naslov']);
        $textPoruke = addslashes($_POST['textPoruke']);
        $idKoriniska = $_SESSION['korisnik']->id_korisnik;
        $unosPoruke = unosPoruke($idKoriniska, $naslov, $textPoruke);
        if ($unosPoruke) {
            $odgovor = ["poruka" => "Uspešno poslali poruku!"];
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

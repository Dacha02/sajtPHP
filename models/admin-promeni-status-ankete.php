<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {
        $idAnkete = $_POST['id'];
        $statuAnkete = $_POST['st'];

        $promena = promeniStatusAnkete($idAnkete, $statuAnkete);
        if ($promena) {
            $odgovor = ["poruka" => "Uspešno ste izmeni status ankete"];
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

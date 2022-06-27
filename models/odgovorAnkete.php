<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {

        $id = $_POST['id'];
        $idAnketa = $_POST['idAnketa'];
        $odgovor = $_POST['odgovor'];

        $nizGresaka = [];

        /* if (!preg_match($uzorak, $naslovAnkete)) {
            array_push($nizGresaka, "Nije unet ispravan naslov ankete");
        } */

        if (!$nizGresaka) {
            global $konekcija;
            $odgovorAnkete = odgovorAnketa($id, $idAnketa, $odgovor);

            if ($odgovorAnkete) {
                $odgovor = ["poruka" => "Uspesno ste odgovorili na anketu"];
                echo json_encode($odgovor);
                http_response_code(201);
            }
        } else {
            print_r($nizGresaka);
            $odgovor = ["poruka" => $nizGresaka];
            echo json_encode($odgovor);
            http_response_code(500);
        }
    } catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode($exception);
    }
} else {
    http_response_code(404);
}

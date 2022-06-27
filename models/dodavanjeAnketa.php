<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {

        $naslovAnkete = $_POST['naslov'];
        $pitanje = $_POST['pitanje'];
        $prviOdgovor = $_POST['prviOdgovor'];
        $drugiOdgovor = $_POST['drugiOdgovor'];
        $treciOdgovor = $_POST['treciOdgovor'];
        $idAdmina = $_SESSION['korisnik']->id_korisnik;

        $nizGresaka = [];
        $uzorak = "/^[A-ZČĆŠĐŽ][a-zčćšđž\-\?]+(\s[A-ZČĆŠĐŽa-zčćšđž0-9\-\?]+)*$/";

        if (!preg_match($uzorak, $naslovAnkete)) {
            array_push($nizGresaka, "Nije unet ispravan naslov ankete");
        } else if (!preg_match($uzorak, $pitanje)) {
            array_push($nizGresaka, "Nije unet ispravan format pitanja");
        } else if (!preg_match($uzorak, $prviOdgovor)) {
            array_push($nizGresaka, "Nije unet ispravan format prvog odgovora");
        } else if (!preg_match($uzorak, $drugiOdgovor)) {
            array_push($nizGresaka, "Nije unet ispravan format drug odgovora");
        } else if (!preg_match($uzorak, $treciOdgovor)) {
            array_push($nizGresaka, "Nije unet ispravan format treci odgovora");
        }

        if (!$nizGresaka) {
            global $konekcija;
            $unosProizvoda = unesiAnketu($naslovAnkete, $pitanje, $prviOdgovor, $drugiOdgovor, $treciOdgovor, $idAdmina);

            if ($unosProizvoda) {
                $odgovor = ["poruka" => "Uspesno ste uneli anketu"];
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

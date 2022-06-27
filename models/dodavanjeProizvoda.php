<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {

        $naslovProizvoda = $_POST['naslovProizvoda'];
        $id_kategorija = $_POST['id_kategorija'];
        $id_boja = $_POST['id_boja'];
        $id_velicina = $_POST['id_velicina'];
        $tezina = $_POST['tezina'];
        $cena = $_POST['cena'];
        $stanje = $_POST['stanje'];
        $kraciOpis = $_POST['kraciOpis'];
        $duziOpis = $_POST['duziOpis'];


        $upitZaProveruNaslova = "SELECT naslov FROM proizvodi";
        $uzpn = izvrsiUpit($upitZaProveruNaslova);
        $proveraNaslova = 0;
        foreach ($uzpn as $u) {
            if ($u->naslov == $naslovProizvoda) $proveraNaslova = 1;
        }

        $nizGresaka = [];
        $uzorakNaslov = "/^[A-ZČĆŠĐŽa-zčćšđž]{1,15}(\s[A-ZČĆŠĐŽa-zčćšđž0-9]{1,15})+$/";
        $uzorakKOpis = "/^.{1,999}$/";
        $uzorakDOpis = "/^.{1,9999}$/";

        if (!preg_match($uzorakNaslov, $naslovProizvoda)) {
            array_push($nizGresaka, "Nije unet ispravan naslov proizvoda");
        } else
        if (!preg_match($uzorakKOpis, $kraciOpis)) {
            array_push($nizGresaka, "Nije unet ispravan kratak opis proizvoda");
        } else if (!preg_match($uzorakDOpis, $duziOpis)) {
            array_push($nizGresaka, "Nije unet ispravan duzi opis proizvoda");
        }

        if (!$nizGresaka && $proveraNaslova == 0) {
            global $konekcija;
            $unosProizvoda = unesiProizvod($naslovProizvoda, $id_kategorija, $id_boja, $id_velicina, $tezina, $stanje, $kraciOpis, $duziOpis);
            $poslednjiId = $konekcija->lastInsertId();
            $_SESSION['id_proizvod'] = $poslednjiId;
            $unosCene = unesiCenu($poslednjiId, $cena);
            if ($unosProizvoda && $unosCene) {
                $odgovor = ["poruka" => "Uspesno ste uneli proizvod"];
                echo json_encode($odgovor);
                http_response_code(201);
            }
        } else if ($proveraNaslova == 1) {
            $odgovor = ["poruka" => "Postoji proizvod sa tim naslovom"];
            echo json_encode($odgovor);
            http_response_code(409);
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

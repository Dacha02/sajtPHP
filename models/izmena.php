<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {

        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korisnickoIme = $_POST['korisnickoIme'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $uloga_id = $_POST['uloga_id'];
        $idK = $_POST['idK'];
        $upitZaProveruUnetogKorisnika = "SELECT korisnicko_ime, email FROM korisnici WHERE id_korisnik not like $idK";
        $uzpuk = izvrsiUpit($upitZaProveruUnetogKorisnika);
        $proveraKImena = 0;
        $proveraEmail = 0;
        foreach ($uzpuk as $u) {
            if ($u->korisnicko_ime == $korisnickoIme) $proveraKImena = 1;
            if ($u->email == $email) $proveraEmail = 1;
        }

        $uzorakIme = "/^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}$/";
        $uzorakKIme = "/^[A-ZČĆŠĐŽa-zčćšđž0-9_-]{1,20}$/";
        $uzorakEmail = "/^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15})?$/";
        $nizGresaka = [];
        if (!preg_match($uzorakIme, $ime)) {
            array_push($nizGresaka, "Nije uneto ispravno ime");
        } else if (!preg_match($uzorakIme, $prezime)) {
            array_push($nizGresaka, "Nije uneto ispravno prezime");
        } else if (!preg_match($uzorakKIme, $korisnickoIme)) {
            array_push($nizGresaka, "Nije uneto ispravno korisnicko ime");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($nizGresaka, "Nije unet ispravan email");
        }
        if (!$nizGresaka && $proveraEmail == 0 && $proveraKImena == 0) {
            $izmenaKorisnika = izmenaKorisnika($ime, $prezime, $korisnickoIme, $email, $status, $uloga_id, $idK);
            if ($izmenaKorisnika) {
                $odgovor = ["poruka" => "Uspešno ste izmeni korisnika"];
                echo json_encode($odgovor);
                http_response_code(201);
            }
        } else if ($proveraEmail == 1) {
            $odgovor = ["poruka" => "Korisnik sa tom e-mail adresom vec postoji"];
            echo json_encode($odgovor);
            http_response_code(409);
        } else if ($proveraKImena == 1) {
            $odgovor = ["poruka" => "Korisnik sa tim korisnickim imenom vec postoji"];
            echo json_encode($odgovor);
            http_response_code(408);
        } else {
            print_r($nizGresaka);
            $odgovor = ["poruka" => "Nista uspeli da se registrujete"];
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
?>
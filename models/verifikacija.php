<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";

    try {
        $kod = $_POST['kod'];
        $regKod = "/^[1-9][0-9]{5}$/";
        $greske = [];
        if (!preg_match($regKod, $kod)) {
            array_push($greske, "Pogresan kod!");
        }

        $emailKorisnika = $_SESSION['verifikacija']['email'];
        $kodKorisnika = $_SESSION['verifikacija']['kod'];
        global $konekcija;
        $upitDohvatiKod = $konekcija->prepare("SELECT verifikacioniKod FROM korisnici WHERE email = :email");
        $upitDohvatiKod->bindParam(":email", $emailKorisnika);
        $upitDohvatiKod->execute();
        $korisnik = $upitDohvatiKod->fetch();

        if ($korisnik && !$greske) {
            if ($korisnik->verifikacioniKod == $kod) {
                $upitVerifikuj = $konekcija->prepare("UPDATE korisnici SET verifikacija = 1 WHERE email = :email");
                //$upitVerifikuj->bindParam(":kod", $kodKorisnika);
                $upitVerifikuj->bindParam(":email", $emailKorisnika);
                $upitVerifikuj->execute();
                $odgovor = ["poruka" => "Uspesno ste verifikovali nalog!"];
                echo json_encode($odgovor);
                http_response_code(204);
                unset($_SESSION['verifikacija']);
            } else {
                $odgovor = ["poruka" => "Niste uneli ispravan verifikacioni kod!"];
                echo json_encode($odgovor);
                http_response_code(409);
            }
        } else {
            $odgovor = ["poruka" => "Morate prvo proci proces registracije!"];
            echo json_encode($odgovor);
            http_response_code(401);
        }
    } catch (PDOException $exception) {
        $odgovor = ["poruka" => "Greska na serveru molimo pokusajte kasnije!"];
        echo json_encode($exception);
        http_response_code(500);
    }
}

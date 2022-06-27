<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";

    try {
        $korisnik_id = $_SESSION['korisnik']->id_korisnik;
        $adresa = $_POST['adresa'];
        $proizvodi = $_POST['proizvodi'];
        $postanski_broj = $_POST['zip'];
        $grad = $_POST['grad'];
        $kolicine = $_POST['kolicine'];

        $nizCena = [];

        $ukupnaSuma = 0;
        for ($i = 0; $i < count($proizvodi); $i++) {
            $upit = $konekcija->prepare("SELECT (c.cena * :kolicina) as cena
                FROM cena AS c JOIN proizvodi AS p ON c.id_proizvod = p.id_proizvod 
                WHERE p.id_proizvod  = :id_proizvod ");
            $upit->bindParam(":kolicina", $kolicine[$i]);
            $upit->bindParam(":id_proizvod", $proizvodi[$i]);
            $upit->execute();
            $pom = $upit->fetch();
            array_push($nizCena, $pom->cena);
            $ukupnaSuma += $pom->cena;
        }
        $upitInsertRacun = $konekcija->prepare("INSERT INTO racun (id_korisnik, suma, adresa, pBroj, grad) VALUES (:id_korisnik, :suma, :adresa, :pBroj, :grad)");
        $upitInsertRacun->bindParam(":id_korisnik", $korisnik_id);
        $upitInsertRacun->bindParam(":suma", $ukupnaSuma);
        $upitInsertRacun->bindParam(":adresa", $adresa);
        $upitInsertRacun->bindParam(":pBroj", $postanski_broj);
        $upitInsertRacun->bindParam(":grad", $grad);
        $upitInsertRacun->execute();

        if ($upitInsertRacun) {
            $racun_id = $konekcija->lastInsertId();
            for ($i = 0; $i < count($proizvodi); $i++) {
                $upitStavka = $konekcija->prepare("INSERT INTO stavke_racuna (id_proizvod, id_racun, cena_stavke, kolicina) VALUES (:id_proizvod, :id_racun, :cena_stavke, :kolicina)");
                $upitStavka->bindParam(":id_proizvod", $proizvodi[$i]);
                $upitStavka->bindParam(":id_racun", $racun_id);
                $upitStavka->bindParam(":cena_stavke", $nizCena[$i]);
                $upitStavka->bindParam(":kolicina", $kolicine[$i]);
                $upitStavka->execute();

                if ($upitStavka) {
                    $odgovor = ["poruka" => "Uspesno ste porucili"];
                    echo json_encode($odgovor);
                    http_response_code(201);
                } else {
                    $odgovor = ["poruka" => "Greska pri unosu stavki"];
                    echo json_encode($odgovor);
                    http_response_code(408);
                }
            }
        } else {
            $odgovor = ["poruka" => "Greska kod unosra racuna"];
            echo json_encode($odgovor);
            http_response_code(409);
        }
    } catch (PDOException $e) {
        $odgovor = "Greska na serveru!";
        echo $e;
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

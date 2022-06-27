<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {
        $kImeIliMail = addslashes($_POST['kImeIliMail']);
        $sifra = addslashes($_POST['sifra']);
        $uzorakImeIliMail = '/^([\w\-.]+@([\w\-]+.)+[\w\-]{2,4})|([A-ZČĆŠĐŽa-zčćšđž0-9_\-\S]{1,20})$/';
        $uzorakPass = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
        $nizGresaka = [];
        if (!preg_match($uzorakImeIliMail, $kImeIliMail)) {
            array_push($nizGresaka, "E-mail ili korisnicko ime nije ispravno");
        } else if (!preg_match($uzorakPass, $sifra)) {
            array_push($nizGresaka, "Lozinka nije ispravna");
        }
        $sifrovanaLozinka = md5($sifra);
        if (!$nizGresaka) {
            $proveraLogovanja = proveraLogovanja($kImeIliMail, $sifrovanaLozinka);
            if ($proveraLogovanja == "Greska") {
                $odgovor = ["obj" => "Greska"];
                echo json_encode($odgovor);
                http_response_code(400);
                //var_dump($proveraLogovanja);
            } else {
                if ($proveraLogovanja->verifikacija == 1) {
                    global $konekcija;
                    $_SESSION['korisnik'] = $proveraLogovanja;
                    $kId = $proveraLogovanja->id_korisnik;
                    $upit = "UPDATE korisnici SET statusAktivnosti = 1 WHERE id_korisnik = :id_korisnik";
                    $unesi = $konekcija->prepare($upit);
                    $unesi->bindParam(":id_korisnik", $proveraLogovanja->id_korisnik);
                    $unesi->execute();
                    $odgovor = ["obj" => $_SESSION['korisnik']];
                    echo json_encode($odgovor);
                    http_response_code(200);
                } else {
                    $odgovor = ["obj" => "Nalog nije verifikovan"];
                    echo json_encode($odgovor);
                    http_response_code(409);
                }
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

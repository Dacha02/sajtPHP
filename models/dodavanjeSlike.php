<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";

    try {
        $slika = $_FILES['slike'];
        $brojSlika = count($_FILES['slike']['name']);
        $greske = [];
        $dozvoljeniTipoviSlika = ["image/jpg", "image/jpeg", "image/png"];
        for ($i = 0; $i < $brojSlika; $i++) {
            $slikaIme[$i] = $slika['name'][$i];
            $slikaTmpFajla[$i] = $slika['tmp_name'][$i];
            $slikaVelicina[$i] = $slika['size'][$i];
            if ($slikaVelicina[$i] > 200000)
                array_push($greske, "Greska velicina fajla");
            $slikaTipFajla[$i] = $slika['type'][$i];
            if (!in_array($slikaTipFajla[$i], $dozvoljeniTipoviSlika))
                array_push($greske, "Greska tip fajla");
            $slikaGreskaFajla[$i] = $slika['error'][$i];
            echo $slikaIme[$i];
            echo "<br>";
            echo $slikaTmpFajla[$i];
            echo "<br>";
            echo $slikaVelicina[$i];
            echo "<br>";
            echo $slikaTipFajla[$i];
            echo "<br>";
            echo $slikaGreskaFajla[$i];
            echo "<br>";
            echo "<br>";
        }
        $proizvod_id = $_SESSION['id_proizvod'];
        if (count($greske) == 0) {
            $greskaInsert = [];
            for ($i = 0; $i < $brojSlika; $i++) {
                $novoImeSlike = time() . "_" . $slikaIme[$i];
                $putanja = "../img/skladistenjeSlika/" . $novoImeSlike;
                if (move_uploaded_file($slikaTmpFajla[$i], $putanja)) {
                    $upitInsertSlike = $konekcija->prepare("INSERT INTO slike (src, alt, id_proizvod) VALUES (:src, :alt, :proizvod_id)");
                    $upitInsertSlike->bindParam(":proizvod_id", $proizvod_id);
                    $upitInsertSlike->bindParam(":src", $novoImeSlike);
                    $upitInsertSlike->bindParam(":alt", $slikaIme[$i]);
                    $upitInsertSlike->execute();

                    if (!$upitInsertSlike) {
                        array_push($greskaInsert, "Greska prilikom inserta");
                    }
                }
            }
            if (count($greskaInsert) == 0) {
                $odgovor = ["odgovor" => "Uneli ste slike"];
                echo json_encode($odgovor);
                http_response_code(201);
            } else {
                $odgovor = ["odgovor" => "Nisu se unele slike"];
                echo json_encode($odgovor);
                http_response_code(408);
            }
        } else {
            $odgovor = ["odgovor" => "Greska, tip fajla ili velicina fajla nisu odgovoarajuci."];
            echo json_encode($odgovor);
            http_response_code(409);
        }
    } catch (PDOException $e) {
        $odgovor = ["odgovor" => $e];
        echo json_encode($odgovor);
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

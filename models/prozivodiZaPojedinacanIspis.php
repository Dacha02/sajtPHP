<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {
        $id = $_POST['id'];
        global $konekcija;
        $upit = "SELECT p.id_proizvod AS 'id',p.kratak_opis AS 'shortDescription',p.tezina, p.stanje, p.duzi_opis AS 'longDescription', p.id_kategorija AS 'categoryId',p.id_boja AS 'colorId',p.id_velicina AS 'sizeId', p.naslov AS 'title',c.cena AS 'price' FROM proizvodi AS p INNER JOIN cena AS c ON p.id_proizvod=c.id_proizvod WHERE p.id_proizvod = $id";
        //$upit = "SELECT  * FROM proizvodi AS p INNER JOIN slike AS s ON p.id_proizvod=s.id_proizvod WHERE p.id_proizvod = $id";
        $rezultat1 = izvrsiUpit($upit);

        $upit2 = "SELECT s.src FROM slike AS s INNER JOIN proizvodi AS p ON p.id_proizvod = s.id_proizvod WHERE s.id_proizvod = $id";
        $rezultat2 = izvrsiUpit($upit2);

        /* $rez = $konekcija->prepare($upit);
        $rez->bindParam(":id", $id);
        $rez->execute();
        $rezultat = $rez->fetchAll(); */
        if ($rezultat1 && $rezultat2) {
            $niz = [];
            array_push($niz, $rezultat1, $rezultat2);

            echo json_encode($niz);
            http_response_code(201);
        } else {
            http_response_code(500);
            echo json_encode($exception);
        }
    } catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode($exception);
    }
} else {
    http_response_code(404);
}

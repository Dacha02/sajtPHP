<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {
        if (isset($_POST['kolicina']) && !isset($_POST['min'])) {
            $kolicina = $_POST['kolicina'];
            $upit = "SELECT p.id_proizvod AS 'id',p.id_kategorija AS 'categoryId',p.id_boja AS 'colorId',p.id_velicina AS 'sizeId', p.naslov AS 'title',s.src AS 'img',c.cena AS 'price' FROM proizvodi AS p INNER JOIN cena AS c ON p.id_proizvod=c.id_proizvod INNER JOIN slike AS s ON p.id_proizvod=s.id_proizvod GROUP BY p.id_proizvod
            LIMIT 0,$kolicina ";
            $rezultat = izvrsiUpit($upit);
            if ($rezultat) {
                echo json_encode($rezultat);
                http_response_code(201);
            }
        } else if (isset($_POST['min']) && isset($_POST['max'])) {
            $min = $_POST['min'];
            $max = $_POST['max'];
            $kolicina = $_POST['kolicina'];
            $upit = "SELECT p.id_proizvod AS 'id',p.id_kategorija AS 'categoryId',p.id_boja AS 'colorId',p.id_velicina AS 'sizeId', p.naslov AS 'title',s.src AS 'img',c.cena AS 'price' FROM proizvodi AS p INNER JOIN cena AS c ON p.id_proizvod=c.id_proizvod INNER JOIN slike AS s ON p.id_proizvod=s.id_proizvod GROUP BY p.id_proizvod
            LIMIT $min,$max ";
            $rezultat = izvrsiUpit($upit);
            if ($rezultat) {
                echo json_encode($rezultat);
                http_response_code(201);
            }
        } else if (!isset($_POST['kolicina']) && !isset($_POST['min'])) {
            $upit = "SELECT p.id_proizvod AS 'id',p.id_kategorija AS 'categoryId',p.id_boja AS 'colorId',p.id_velicina AS 'sizeId', p.naslov AS 'title',s.src AS 'img',c.cena AS 'price' FROM proizvodi AS p INNER JOIN cena AS c ON p.id_proizvod=c.id_proizvod INNER JOIN slike AS s ON p.id_proizvod=s.id_proizvod GROUP BY p.id_proizvod";
            $rezultat = izvrsiUpit($upit);
            if ($rezultat) {
                echo json_encode($rezultat);
                http_response_code(201);
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode($exception);
    }
} else {
    http_response_code(404);
}

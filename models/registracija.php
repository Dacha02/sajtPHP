<?php
session_start();
header("Content-type: application/json");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
/*use PHPMailer\PHPMailer\Exception; */

//Load Composer's autoloader
require '../phpmailer/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../konekcija/konekcija.php";
    include "functions.php";
    try {

        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korisnickoIme = $_POST['korisnickoIme'];
        $email = $_POST['email'];
        $sifra = $_POST['sifra'];
        $upitZaProveruUnetogKorisnika = "SELECT korisnicko_ime, email FROM korisnici";
        $uzpuk = izvrsiUpit($upitZaProveruUnetogKorisnika);
        $proveraKImena = 0;
        $proveraEmail = 0;
        foreach ($uzpuk as $u) {
            if ($u->korisnicko_ime == $korisnickoIme) $proveraKImena = 1;
            if ($u->email == $email) $proveraEmail = 1;
        }

        $uzorakIme = "/^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}$/";
        $uzorakKIme = "/^[A-ZČĆŠĐŽa-zčćšđž0-9_-]{1,20}$/";
        $uzorakPass = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
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
        } else if (!preg_match($uzorakPass, $sifra)) {
            array_push($nizGresaka, "Nije uneta ispravna sifra");
        }
        $sifrovanaLozinka = md5($sifra);
        $verifikacioniKod = random_int(100000, 999999);
        if (!$nizGresaka && $proveraEmail == 0 && $proveraKImena == 0) {
            $unosKorisnika = unosKorisnika($ime, $prezime, $korisnickoIme, $email, $sifrovanaLozinka, $verifikacioniKod);
            if ($unosKorisnika) {
                $_SESSION["verifikacija"] = ['email' => $email, 'kod' => $verifikacioniKod];
                $odgovor = ["poruka" => "Uspešno ste se registrovali"];
                echo json_encode($odgovor);
                http_response_code(201);

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'testniemailzaphp@gmail.com';                     //SMTP username
                $mail->Password   = 'testniemail123';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('testniemailzaphp@gmail.com', 'Ogani prodavnica');
                $mail->addAddress("$email");


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Verifikacioni kod';
                $mail->Body    = "<h1><b>$verifikacioniKod</b></h1>";
                $mail->AltBody = "$verifikacioniKod";

                $mail->send();
                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
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
    }
} else {
    http_response_code(404);
}

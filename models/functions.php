<?php
//Funkcija za SELECT upit
function izvrsiUpit($upit)
{
    global $konekcija;
    $rezultat = $konekcija->query($upit)->fetchAll();

    return $rezultat;
}

//Meni
function obicanMeni()
{
    $upit = "SELECT * FROM meni";
    $rezultat = izvrsiUpit($upit);
    $m = "";
    foreach ($rezultat as $r) {
        $src = $r->src;
        $m .= "<li><a href='$src'>$r->naziv</a></li>";
    }
    return $m;
}

//Admin meni
function adminMeni()
{
    $upit = "SELECT * FROM admin_meni";
    $rezultat = izvrsiUpit($upit);
    $m = "";
    foreach ($rezultat as $r) {
        $src = $r->src;
        $m .= "<li><a href='$src'>$r->naziv</a></li>";
    }
    return $m;
}

//Slider kategorije
function sliderKategorije()
{
    $upit = "SELECT * FROM kategorija";
    $rez = izvrsiUpit($upit);
    $text = "";
    foreach ($rez as $r) {
        $text .= "<div class='col-lg-3'>
            <div class='categories__item set-bg' data-setbg='$r->src_slike'>
            <h5><a href='index.php?page=shop&catId=$r->id_kategorija'>$r->naslov</a></h5></div>
            </div>";
    }
    return $text;
}

//Padajuca lista kategorija
function padajucaListaKategorija()
{
    $upit = "SELECT * FROM kategorija";
    $rez = izvrsiUpit($upit);
    $text = "";
    foreach ($rez as $r) {
        $text .= "<li><a href='index.php?page=shop&catId=$r->id_kategorija' alt='$r->alt_slike'>$r->naslov</a></li>";
    }
    return $text;
}

//Istaknuti proizvodi
function istaknutiProizvodiIndex($lg, $md, $sm, $br)
{
    $upit = "SELECT p.id_proizvod, p.naslov,p.id_kategorija, c.cena,s.src FROM proizvodi AS p INNER JOIN cena AS c ON p.id_proizvod=c.id_proizvod INNER JOIN slike as s ON p.id_proizvod = s.id_proizvod
        group by p.id_proizvod
        ORDER BY s.id_slika ASC";
    $rez = izvrsiUpit($upit);
    $text = "";
    if ($br == 0) {
        $br = count($rez);
        //echo($br);
    }
    for ($i = 0; $i < $br; $i++) {
        $id = $rez[$i]->id_proizvod;
        $idCat = $rez[$i]->id_kategorija;
        $naslov = $rez[$i]->naslov;
        $src = $rez[$i]->src;
        $cena = $rez[$i]->cena;
        $text .= "<div class='col-lg-$lg col-md-$md col-sm-$sm proba' id='$id'>
            <div class='featured__item'>
              <div class='featured__item__pic set-bg bg-size-contain' data-setbg='img/skladistenjeSlika/$src'>
                <ul class='featured__item__pic__hover'>
                <!--
                  <li><a href='javascript:void(0);'><i class='fa fa-heart'></i></a></li>
                  <li><a href='javascript:void(0);'><i class='fa fa-retweet'></i></a></li>-->
                  <li><a href='javascript:void(0);' onclick='dodajProizvodKorpa($id); ukupnaCenaProizvoda(); modal(`Proizvod je dodat u korpu`,`Proverite proizvode u korpi klikom na ikonicu korpa`);'><i class='fa fa-shopping-cart'></i></a></li>
                </ul>
              </div>
              <a href='index.php?page=shop-details&id=$id&categoryId=$idCat'>
                <div class='featured__item__text'>
                  <h6>$naslov</h6>
                  <h5>$cena RSD</h5> 
                </div>
              </a>
            </div>
          </div>";
    }

    return $text;
}

//Registracija
function unosKorisnika($ime, $prezime, $korisnickoIme, $email, $sifrovanaLozinka, $verifikacioniKod)
{
    global $konekcija;
    $upit = "INSERT INTO korisnici (id_uloga,ime,prezime,korisnicko_ime,email,lozinka,verifikacioniKod) VALUES (2, :ime, :prezime, :korisnicko_ime, :email, :lozinka, :verifikacioniKod)";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":ime", $ime);
    $unesi->bindParam(":prezime", $prezime);
    $unesi->bindParam(":korisnicko_ime", $korisnickoIme);
    $unesi->bindParam(":email", $email);
    $unesi->bindParam(":lozinka", $sifrovanaLozinka);
    $unesi->bindParam(":verifikacioniKod", $verifikacioniKod);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Logovanje
function proveraLogovanja($kImeIliMail, $sifra)
{
    global $konekcija;
    $upit = "SELECT * FROM korisnici AS k INNER JOIN uloga AS u ON k.id_uloga=u.id_uloga WHERE (k.email = :kImeIliMail OR k.korisnicko_ime = :kImeIliMail) AND k.lozinka = :sifra";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":kImeIliMail", $kImeIliMail);
    $rez->bindParam(":sifra", $sifra);
    $rez->execute();
    $rezultat = $rez->fetch();
    if ($rez->rowCount() == 1) {
        return $rezultat;
    } else {
        return "Greska";
    }
}

//Provera postojanja korisnika u bazi
function proveraPostojanja($kId)
{
    global $konekcija;
    $upit = "SELECT * FROM korisnici WHERE id_korisnik = :kId";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":kId", $kId);
    $rez->execute();
    $rezultat = $rez->fetch();
    if ($rez->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}

//Izmena korisnika
function izmenaKorisnika($ime, $prezime, $korisnickoIme, $email, $status, $uloga_id, $idK)
{
    global $konekcija;
    $upit = "UPDATE korisnici SET ime =:ime, prezime =:prezime, korisnicko_ime = :kIme, email=:email, id_uloga=:idUloga, statusAktivnosti = :statusAktivnosti WHERE id_korisnik=:idK";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":ime", $ime);
    $unesi->bindParam(":prezime", $prezime);
    $unesi->bindParam(":kIme", $korisnickoIme);
    $unesi->bindParam(":email", $email);
    $unesi->bindParam(":idUloga", $uloga_id);
    $unesi->bindParam(":statusAktivnosti", $status);
    $unesi->bindParam(":idK", $idK);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Brisanje korisnika
function brisanjeKorisnika($kId)
{
    global $konekcija;
    $upit = "DELETE FROM korisnici WHERE id_korisnik = :kId";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":kId", $kId);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Brisanje proizvoda
function brisanjeProizvoda($id)
{
    global $konekcija;
    $upit = "DELETE FROM proizvodi WHERE id_proizvod = :id";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":id", $id);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Checkboxovi sidebar kategorija ispis
function chkKategorije()
{
    $upit = "SELECT * FROM kategorija";
    $rezultat = izvrsiUpit($upit);
    $text = "<ul>";
    foreach ($rezultat as $r) {
        $text .= "<li>
                <input
                    class='mr-2 mb-2 kategorije'
                    type='checkbox'
                    name='$r->id_kategorija'
                    value='$r->id_kategorija'
                    
                />$r->naslov
            </li>";
    }
    $text .= "</ul>";
    return $text;
}

//Radiobuttons sidebar boja ispis
function rbBoja()
{
    $upit = "SELECT * FROM boja";
    $rezultat = izvrsiUpit($upit);
    $text = "<ul>";
    foreach ($rezultat as $r) {
        $text .= "<div class='sidebar__item__color sidebar__item__color--$r->kod_boje'>
                <label for='color$r->id_boja'>
                $r->naslov
                <input type='radio' class='radioBoja' id='color$r->id_boja' value='$r->id_boja' name='color' />
                </label>
              </div>";
    }
    $text .= "</ul>";
    return $text;
}

//Radiobuttons sidebar velicina ispis
function rbVelicina()
{
    $upit = "SELECT * FROM velicina";
    $rezultat = izvrsiUpit($upit);
    $text = "<ul>";
    foreach ($rezultat as $r) {
        $text .= "<div class='sidebar__item__size'>
                  <label for='size$r->id_velicina'>
                  $r->naslov
                  <input type='radio' class='radioVelicina' id='size$r->id_velicina' value='$r->id_velicina' name='size' />
                  </label>
              </div>";
    }
    $text .= "</ul>";
    return $text;
}

//Slider na shop-grid strani
function sgSlider()
{
    $upit = "SELECT p.id_proizvod,p.naslov,k.naslov AS knaslov,k.id_kategorija AS kid, s.src,c.cena FROM proizvodi AS p INNER JOIN kategorija AS k ON p.id_kategorija = k.id_kategorija INNER JOIN slike AS s ON p.id_proizvod = s.id_proizvod INNER JOIN cena AS c ON p.id_proizvod = c.id_proizvod GROUP BY p.id_proizvod";
    $rez = izvrsiUpit($upit);
    $text = "";
    foreach ($rez as $r) {
        $text .= "<div class='col-lg-4'>
                <div class='product__discount__item'>
                  <div
                    class='product__discount__item__pic set-bg bg-size-contain'
                    data-setbg='img/skladistenjeSlika/$r->src'
                  >
                    <ul class='product__item__pic__hover'>
                      <li>
                        <a href='javascript:void(0);' onclick='dodajProizvodKorpa(
                          $r->id_proizvod
                        ); ukupnaCenaProizvoda();  modal(`Proizvod je dodat u korpu`,`Proverite proizvode u korpi klikom na ikonicu korpa`);'><i class='fa fa-shopping-cart'></i></a>
                      </li>
                    </ul>
                  </div>
                  <div class='product__discount__item__text'>
                    <span>$r->naslov</span>
                    <h5><a href='index.php?page=shop-details&id=$r->id_proizvod&categoryId=$r->kid'>$r->naslov</a></h5>
                                  <div class='product__item__price'>
                                    $r->cena 
                    </div>
                  </div>
                </div>
          </div>";
    }
    return $text;
}

//Slider za nasjvezije proizvode
function najsvezijeSlider()
{
    $upit = "SELECT p.id_proizvod,p.naslov,k.id_kategorija, s.src, c.cena, p.datum FROM proizvodi AS p INNER JOIN kategorija AS k ON p.id_kategorija = k.id_kategorija INNER JOIN slike AS s ON p.id_proizvod = s.id_proizvod INNER JOIN cena AS c ON p.id_proizvod = c.id_proizvod GROUP BY p.id_proizvod ORDER BY p.datum DESC";
    $rez = izvrsiUpit($upit);
    $text = "<div class='latest-prdouct__slider__item'>";
    for ($i = 0; $i < 3; $i++) {
        $id = $rez[$i]->id_proizvod;
        $idCat = $rez[$i]->id_kategorija;
        $naslov = $rez[$i]->naslov;
        $src = $rez[$i]->src;
        $cena = $rez[$i]->cena;
        $text .= "<a href='index.php?page=shop-details&id=$id&categoryId=$idCat' class='latest-product__item'>
                <div class='latest-product__item__pic'>
                  <img src='img/skladistenjeSlika/$src' alt='' />
                </div>
                <div class='latest-product__item__text'>
                  <h6>$naslov</h6>
                  <span>$cena</span>
                </div>
              </a>";
    }
    $text .= '</div>';
    $text .= "<div class='latest-prdouct__slider__item'>";
    for ($i = 3; $i < 6; $i++) {
        $id = $rez[$i]->id_proizvod;
        $idCat = $rez[$i]->id_kategorija;
        $naslov = $rez[$i]->naslov;
        $src = $rez[$i]->src;
        $cena = $rez[$i]->cena;
        $text .= "<a href='index.php?page=shop-details&id=$id&categoryId=$idCat' class='latest-product__item'>
                <div class='latest-product__item__pic'>
                  <img src='img/skladistenjeSlika/$src' alt='' />
                </div>
                <div class='latest-product__item__text'>
                  <h6>$naslov</h6>
                  <span>$cena</span>
                </div>
              </a>";
    }
    $text .= '</div>';
    return $text;
}

//Probrojavanje korisnika
function prebrojKorisnke($k)
{
    global $konekcija;
    $upit = "SELECT COUNT(*) as 'total' FROM korisnici WHERE id_uloga = :k";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":k", $k);
    $rez->execute();
    $rezultat = $rez->fetchAll();

    return $rezultat[0]->total;
}

//Probrojavanje anketa
function prebrojAnkete()
{
    global $konekcija;
    $upit = "SELECT COUNT(*) as 'total' FROM anketa";
    $rez = $konekcija->prepare($upit);
    $rez->execute();
    $rezultat = $rez->fetchAll();

    return $rezultat[0]->total;
}

//Funkcija za prikaz anketa i onoga ko je napravio anketu
function anketeMakeri()
{
    $upit = "SELECT CONCAT( k.ime, ' ' ,k.prezime) AS 'ImePrezime', a.naslov,a.id_anketa, a.statusAnkete FROM anketa AS a JOIN korisnici AS k ON a.id_admin=k.id_korisnik";
    $rez = izvrsiUpit($upit);

    return $rez;
}

//Funkcija za ispis podatak o korisnicima na admin panelu
function ispisKorisnikaAP()
{
    global $konekcija;
    $upit = "SELECT * FROM korisnici k INNER JOIN uloga u ON k.id_uloga = u.id_uloga";
    $rez = $konekcija->prepare($upit);
    $rez = izvrsiUpit($upit);

    return $rez;
}

//Funkcija za ispis podatak o korisnicima na admin modifikovanje
function ispisKorisnikaAM($kId)
{
    global $konekcija;
    $upit = "SELECT * FROM korisnici k INNER JOIN uloga u ON k.id_uloga = u.id_uloga WHERE k.id_korisnik = :kId";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":kId", $kId);
    $rez->execute();
    $rezultat = $rez->fetch();

    return $rezultat;
}

//Funkcija za ispis poruke
function ispisPoruka()
{
    $upit = "SELECT CONCAT( k.ime, ' ' ,k.prezime) AS 'ImePrezime',p.id_pitanje, p.naslov,p.tekst, p.statusProcitanosti, DATE_FORMAT(p.datum_pitanja, '%d %M %Y %T') AS 'datum_pitanja' FROM pitanja_korisnika p INNER JOIN korisnici k ON p.id_korisnik=k.id_korisnik ORDER BY p.datum_pitanja DESC";
    $rezultat = izvrsiUpit($upit);

    return $rezultat;
}
//Izmena statusa poruke
function izmenaStausaPoruke($idP)
{
    global $konekcija;
    $upit = "UPDATE pitanja_korisnika SET statusProcitanosti=0  WHERE id_pitanje= :idP";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":idP", $idP);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Funkcija za ispis proizvoda
function ispisProizvoda()
{
    $upit = "SELECT p.id_proizvod, p.naslov,p.tezina, c.cena,k.naslov AS 'naslovKategorije',b.naslov AS 'naslovBoje',v.naslov  AS 'naslovVelicine',s.src FROM proizvodi p INNER JOIN cena c ON p.id_proizvod=c.id_proizvod INNER JOIN kategorija k ON p.id_kategorija=k.id_kategorija INNER JOIN boja b ON p.id_boja=b.id_boja INNER JOIN velicina v ON p.id_velicina=v.id_velicina INNER JOIN slike s ON p.id_proizvod=s.id_proizvod GROUP BY p.id_proizvod";
    $rez = izvrsiUpit($upit);

    return $rez;
}

//Funkcija za ispis ddl kategorija
function ispisKategorija()
{
    $upit = "SELECT * FROM kategorija";
    $rez = izvrsiUpit($upit);

    return $rez;
}

//Funkcija za ispis ddl boja
function ispisBoja()
{
    $upit = "SELECT * FROM boja";
    $rez = izvrsiUpit($upit);

    return $rez;
}

//Funkcija za ispis ddl velicina
function ispisVelicina()
{
    $upit = "SELECT * FROM velicina";
    $rez = izvrsiUpit($upit);

    return $rez;
}

//Funkcija za unos proizvoda
function unesiProizvod($naslovProizvoda, $id_kategorija, $id_boja, $id_velicina, $tezina, $stanje, $kraciOpis, $duziOpis)
{
    global $konekcija;
    $upitZaUnosProizvoda = "INSERT INTO proizvodi (naslov,id_kategorija,id_boja,id_velicina,kratak_opis,duzi_opis,stanje,tezina) VALUES (:naslovProizvoda, :id_kategorija, :id_boja, :id_velicina, :kraciOpis, :duziOpis, :stanje, :tezina)";
    $rez = $konekcija->prepare($upitZaUnosProizvoda);
    $rez->bindParam(":naslovProizvoda", $naslovProizvoda);
    $rez->bindParam(":id_kategorija", $id_kategorija);
    $rez->bindParam(":id_boja", $id_boja);
    $rez->bindParam(":id_velicina", $id_velicina);
    $rez->bindParam(":kraciOpis", $kraciOpis);
    $rez->bindParam(":duziOpis", $duziOpis);
    $rez->bindParam(":stanje", $stanje);
    $rez->bindParam(":tezina", $tezina);

    $rezultat =  $rez->execute();
    return $rezultat;
}

//Funkcija za unos cene poslednjeg dodatog proizvoda
function unesiCenu($id, $cena)
{
    global $konekcija;
    $upit = ("INSERT INTO cena (id_proizvod, cena) VALUES (:id, :cena)");
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":id", $id);
    $rez->bindParam(":cena", $cena);

    return $rez->execute();
}

//Funkcija za unos proizvoda
function unesiAnketu($naslovAnkete, $pitanje, $prviOdgovor, $drugiOdgovor, $treciOdgovor, $idAdmina)
{
    global $konekcija;
    $upitZaUnosProizvoda = "INSERT INTO anketa (naslov,pitanje,odgovor_prvi,odgovor_drugi,odgovor_treci,id_admin) VALUES (:naslov, :pitanje, :prviOdgovor, :drugiOdgovor, :treciOdgovor, :idAdmina)";
    $rez = $konekcija->prepare($upitZaUnosProizvoda);
    $rez->bindParam(":naslov", $naslovAnkete);
    $rez->bindParam(":pitanje", $pitanje);
    $rez->bindParam(":prviOdgovor", $prviOdgovor);
    $rez->bindParam(":drugiOdgovor", $drugiOdgovor);
    $rez->bindParam(":treciOdgovor", $treciOdgovor);
    $rez->bindParam(":idAdmina", $idAdmina);


    $rezultat =  $rez->execute();
    return $rezultat;
}

//Poruke
function unosPoruke($idKorisnika, $naslov, $text)
{
    global $konekcija;
    $upit = "INSERT INTO pitanja_korisnika (id_korisnik, naslov, tekst) VALUES (:idK, :naslov, :textPoruke)";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":idK", $idKorisnika);
    $unesi->bindParam(":naslov", $naslov);
    $unesi->bindParam(":textPoruke", $text);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Funkcija za prikaz ankete na koje korisnik nije odgovorio
function anketeKorisnika($id)
{
    global $konekcija;
    $upit = "SELECT * FROM anketa WHERE id_anketa NOT IN (SELECT id_anketa FROM odgovori_anketa WHERE id_korisnik = :idKorsnika) AND statusAnkete = 1";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":idKorsnika", $id);
    $rez->execute();
    $rezultat = $rez->fetchAll();

    return $rezultat;
}

//Odgovor korisnika na anketu
function odgovorAnketa($id, $idAnketa, $odgovor)
{
    global $konekcija;
    $upit = "INSERT INTO odgovori_anketa (id_korisnik, id_anketa, odgovor_korisnika) VALUES (:idK, :idA, :odg)";
    $unesi = $konekcija->prepare($upit);
    $unesi->bindParam(":idK", $id);
    $unesi->bindParam(":idA", $idAnketa);
    $unesi->bindParam(":odg", $odgovor);
    $rezultat = $unesi->execute();
    return $rezultat;
}

//Funkcija za dohvatanje ankete
function dohvatiAnketu($id)
{
    global $konekcija;
    $upit = "SELECT * FROM anketa WHERE id_anketa = :id";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":id", $id);
    $rez->execute();
    $rezultat = $rez->fetch();

    return $rezultat;
}

//Provera postojanja korisnika u bazi
function proveraPostojanjaAnkete($aId)
{
    global $konekcija;
    $upit = "SELECT * FROM anketa WHERE id_anketa = :aId";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":aId", $aId);
    $rez->execute();
    $rezultat = $rez->fetch();
    if ($rez->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}

//Funkcija za prebrojavanje korisnika
function prebrojAnketeNaKojeJeOdgovoreno($id)
{
    global $konekcija;
    $upit = "SELECT COUNT(*) as 'total' FROM odgovori_anketa WHERE id_anketa = :id";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":id", $id);
    $rez->execute();
    $rezultat = $rez->fetch();
    return $rezultat;
}

//Funkcija za prebrojavanje odgvoroga
function prebrojOdgovore($id, $odg)
{
    global $konekcija;
    $upit = "SELECT COUNT(*) as 'total' FROM odgovori_anketa WHERE id_anketa = :id AND odgovor_korisnika = :odg";
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":id", $id);
    $rez->bindParam(":odg", $odg);
    $rez->execute();
    $rezultat = $rez->fetch();
    return $rezultat;
}

//Funkcija za menjanje statusa ankete
function promeniStatusAnkete($id, $st)
{
    global $konekcija;
    if ($st == 0) {
        $upit = "UPDATE anketa SET statusAnkete = 1 WHERE id_anketa = :id";
    } else {
        $upit = "UPDATE anketa SET statusAnkete = 0 WHERE id_anketa = :id";
    }
    $rez = $konekcija->prepare($upit);
    $rez->bindParam(":id", $id);
    $rez->execute();
    return $rez->execute();
}

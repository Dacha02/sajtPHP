-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 09:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ogani`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_meni`
--

CREATE TABLE `admin_meni` (
  `id_meni_admin` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_meni`
--

INSERT INTO `admin_meni` (`id_meni_admin`, `naziv`, `src`) VALUES
(1, 'Admin korisnici', 'index.php?page=admin-panel'),
(2, 'Admin proizvodi', 'index.php?page=admin-proizvodi'),
(3, 'Admin dodaj proizvod', 'index.php?page=admin-dodaj-proizvod'),
(4, 'Poruke korisnika', 'index.php?page=admin-poruke'),
(5, 'Admin ankete', 'index.php?page=admin-ankete');

-- --------------------------------------------------------

--
-- Table structure for table `adresa_korisnika`
--

CREATE TABLE `adresa_korisnika` (
  `id_adresa` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL,
  `grad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ulica` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `broj` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adresa_korisnika`
--

INSERT INTO `adresa_korisnika` (`id_adresa`, `id_korisnik`, `grad`, `ulica`, `broj`) VALUES
(1, 1, 'Beograd', 'Neznanog Junaka', 23);

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id_anketa` int(11) NOT NULL,
  `naslov` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pitanje` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odgovor_prvi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odgovor_drugi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odgovor_treci` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `statusAnkete` tinyint(4) NOT NULL DEFAULT 1,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id_anketa`, `naslov`, `pitanje`, `odgovor_prvi`, `odgovor_drugi`, `odgovor_treci`, `statusAnkete`, `id_admin`) VALUES
(2, 'Prva anketa', 'Da li volite voce?', 'Da, volim', 'Ne, nevolim', 'Ne zelim da odgovorim', 1, 1),
(3, 'Druga anketa', 'Kako vam se cini sajt', 'Dobar je', 'Nije los', 'Sranje', 1, 1),
(4, 'Treca anketa', 'Kako ste mi danas?', 'Evo nije lose', 'Do jaja', 'Nikako', 1, 11),
(5, 'Anketa za meso', 'Kakvo meso volite?', 'Belo', 'Crveno', 'Ne volim meso', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `boja`
--

CREATE TABLE `boja` (
  `id_boja` int(11) NOT NULL,
  `naslov` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `kod_boje` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boja`
--

INSERT INTO `boja` (`id_boja`, `naslov`, `kod_boje`) VALUES
(1, 'Žuta', 'yellow'),
(2, 'Zelena', 'green'),
(3, 'Braon', 'brown'),
(4, 'Bela', 'white'),
(5, 'Crvena', 'red'),
(6, 'Plava', 'blue');

-- --------------------------------------------------------

--
-- Table structure for table `cena`
--

CREATE TABLE `cena` (
  `id_cena` int(11) NOT NULL,
  `id_proizvod` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `datum_cene` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cena`
--

INSERT INTO `cena` (`id_cena`, `id_proizvod`, `cena`, `datum_cene`) VALUES
(1, 1, '470.99', '2022-04-11 17:41:43'),
(5, 2, '600.99', '2022-04-11 17:42:18'),
(30, 46, '590.99', '2022-05-04 17:49:15'),
(31, 47, '790.99', '2022-05-04 17:56:53'),
(32, 48, '2370.99', '2022-05-04 18:48:33'),
(33, 49, '450.99', '2022-05-04 18:52:46'),
(34, 50, '600.89', '2022-05-04 18:54:26'),
(35, 51, '590.99', '2022-05-04 18:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id_kategorija` int(11) NOT NULL,
  `naslov` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `src_slike` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_slike` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorija`, `naslov`, `src_slike`, `alt_slike`) VALUES
(1, 'Sveže meso', 'img/veceSlike/pile1.jpg', 'slikaKategorije1'),
(2, 'Voće', 'img/veceSlike/breskva1.jpg', 'slikaKategorije2'),
(3, 'Povrće', 'img/veceSlike/brokoliNaslovna.jpg', 'slikaKategorije3'),
(4, 'Sušeno voće, povrće...', 'img/veceSlike/suvaKajsija3.jpg', 'slikaKategorije4'),
(5, 'Jaja i mlečni proizvodi', 'img/veceSlike/jajeNaslovna.jpg', 'slikaKategorije5');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnik` int(11) NOT NULL,
  `id_uloga` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `korisnicko_ime` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `verifikacioniKod` int(11) NOT NULL,
  `verifikacija` tinyint(4) NOT NULL DEFAULT 0,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `statusAktivnosti` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `id_uloga`, `ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka`, `verifikacioniKod`, `verifikacija`, `datum`, `statusAktivnosti`) VALUES
(1, 1, 'David', 'Stević', 'dacha02', 'dacha.stevic@gmail.com', '38ad33e2fc083c2843f12f8c6bb6b092', 123456, 1, '2022-03-06 16:31:25', 1),
(11, 2, 'Milos', 'Resanovic', 'mikicaresanovic', 'resa@gmail.com', '38ad33e2fc083c2843f12f8c6bb6b092', 0, 0, '2022-04-14 11:41:00', 0),
(35, 2, 'Vukadin', 'Lazarevic', 'lazarevicc', 'vukica@gmail.com', '2bae11490d7f8d3ec94b25ecf03e49d7', 413302, 1, '2022-04-21 21:29:11', 0),
(37, 2, 'Nenad', 'Jevtic', 'shone', 'shone@gmail.com', '21dc32e3b74a37275b6edc2ff4aa2f5a', 907652, 1, '2022-04-21 22:48:39', 0),
(38, 2, 'Jovan', 'Vasic', 'jocava', 'jovan.vasic00@gmail.com', '059ba7cfae3c5e5caadeb469608378b8', 847303, 1, '2022-04-27 08:02:40', 0),
(39, 2, 'Filip', 'Pajic', 'fpajic', 'fpajic@gmail.com', '03247e64745eef2327713e1da3242629', 570365, 1, '2022-05-03 22:56:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id_meni`, `naziv`, `src`) VALUES
(1, 'Početna', 'index.php?page=pocetna'),
(2, 'Shop', 'index.php?page=shop'),
(3, 'Ankete', 'index.php?page=ankete'),
(4, 'Kontakt', 'index.php?page=kontakt'),
(5, 'Poruke', 'index.php?page=poruke');

-- --------------------------------------------------------

--
-- Table structure for table `odgovori_anketa`
--

CREATE TABLE `odgovori_anketa` (
  `id_korisnik` int(11) NOT NULL,
  `id_anketa` int(11) NOT NULL,
  `odgovor_korisnika` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovori_anketa`
--

INSERT INTO `odgovori_anketa` (`id_korisnik`, `id_anketa`, `odgovor_korisnika`) VALUES
(1, 2, 1),
(1, 3, 1),
(1, 4, 2),
(35, 2, 1),
(35, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pitanja_korisnika`
--

CREATE TABLE `pitanja_korisnika` (
  `id_pitanje` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL,
  `naslov` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statusProcitanosti` tinyint(4) NOT NULL DEFAULT 1,
  `datum_pitanja` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pitanja_korisnika`
--

INSERT INTO `pitanja_korisnika` (`id_pitanje`, `id_korisnik`, `naslov`, `tekst`, `statusProcitanosti`, `datum_pitanja`) VALUES
(1, 1, 'Pitanje za bananu', 'Kako je ova banana tako ukusna?', 0, '2022-04-22 22:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id_proizvod` int(11) NOT NULL,
  `naslov` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_kategorija` int(11) NOT NULL,
  `id_boja` int(11) DEFAULT NULL,
  `id_velicina` int(11) NOT NULL,
  `kratak_opis` varchar(999) COLLATE utf8_unicode_ci NOT NULL,
  `duzi_opis` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `stanje` tinyint(4) NOT NULL DEFAULT 1,
  `tezina` decimal(10,2) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id_proizvod`, `naslov`, `id_kategorija`, `id_boja`, `id_velicina`, `kratak_opis`, `duzi_opis`, `stanje`, `tezina`, `datum`) VALUES
(1, 'Organska banana', 2, 1, 2, 'Banana sadrži tri vrste šećera: fruktozu, saharozu i glukozu ali i vlakna. Sadrži brojne vitamine i minerale, fosfor, mangan, magnezijum, kalijum, nikl..Posebno je bogata vitaminom B6. Preporučuje se za decu od početka uvođenja čvrste ishrane.', 'Banana je ime roda zeljastih biljaka i ekonomski važne vrste (Musa sapientium) iz familije Musaceae, kao i ime za plod ovih biljaka koji ljude koriste u ishrani kao voće. Banana je jestivo voće, koje je sa botaničkog gledišta bobica. Ona je plod nekoliko velikih zeljastih skrivenosjemenica iz roda Musa. (U nekim zemljama, banane koje se koriste za kuvanje se nazivaju plantanima.) Ovo voće varira u pogledu veličine, boje i čvrstoće, mada je obično izduženo i povijeno, sa mekanim plodom bogatim skrobom, pokrivenim korom koja može da bude zelena, žuta, crven, purpurna, ili smeđa kod sazrelog voća. Plodovi rastu u grupama koje vise sa vrha biljke. Skoro sve moderne jestive partenokarpne (besemene) banane potiču iz dve divlje vrste – Musa acuminata i Musa balbisiana. Naučna imena najviše uzgajanih vrsta banana su Musa acuminata, Musa balbisiana, i Musa × paradisiaca za hibrid Musa acuminata × M. balbisiana, u zavisnosti od njihove genomske konstitucije. Starije naučno ime Musa sapientum se više ne koristi. Prirodno stanište vrsta Musa su tropski predeli Indomalezije i Australije, i pretpostavlja se da je do domestikacije prvobitno došlo u Papua Novoj Gvineji. Banane se uzgajaju u bar 107 zemalja, prvenstveno radi ploda, i u manjoj meri radi pravljenja vlakana, vina od banana i piva od banana, ili kao ornamentalne biljke.', 1, '1.00', '2022-03-06 16:26:05'),
(2, 'Organska trešnja', 2, 5, 3, 'Najbolje iz Srbije. Proizvod malih poljoprivrednih gazdinstva. Fairtrade proizvod. Sertifikovan organski proizvod.', 'Plod trešnje za komercijalne svrhe se obično dobija od ograničenog broja vrsta, kao što je kultivarska slatka trešanja, Prunus avium. Naziv \'trešnja\' se takođe odnosi na drvo trešnje, i ponekad se primenjuje i na bademe i vizualno slične svetajuće biljke roda Prunus, kao što su „ornamentalna trešnja“, „Trešnjin cvet“, etc. Divlja trešnja se može odnositi na bilo koju vrstu trešnje koja nije kultivirana, mada se Prunus avium često specifično naziva tim imenom u Britaniji.', 1, '1.00', '2022-04-11 17:40:27'),
(46, 'Organska breskva', 2, 3, 2, 'Breskva', 'Breskva', 1, '1.00', '2022-05-04 17:49:15'),
(47, 'Organski brokoli', 3, 2, 3, 'Brokoli', 'Brokule (lat. Brassica oleracea var. silvestris) su naziv za nekoliko kultivara divljeg kupusa (Brassicas). Ime potiče od ital. broccoli — granati kupus.Brokule su klasifikovane u kultivarsku grupu Italica vrste Brassica oleracea. Brokule imaju velike cvetne glave, obično tamnozelene boje, uređene u strukturu nalik na krošnju koja se izgranava iz debelog, jestivog stabla koje je obično svetlo zeleno. Masa cvetne glave je okružena listovima. Brokule podsećaju na karfiol, koji je različita kultivarska grupa iste Brassica vrste. Zajedno su 2016, Kina i Indija proizvele 73% svetske produkcije useva brokula i karfiloa.', 1, '1.00', '2022-05-04 17:56:53'),
(48, 'Organska piletina', 1, 4, 1, 'Organska piletina se gaji na farmi u  ', 'Kokoška, kokoš ili domaća kokoš (lat. Gallus gallus domesticus) je podvrsta ptice koja se često gaji kao živina. Smatra se da je poreklom iz jugoistočne Azije, i da je evoluirala od divljih podvrsta vrste Gallus gallus. Ova ptica je najrasprostranjenija na zemlji,sa totalnom populacijom od preko 19 milijardi po proceni iz 2011. godine.Ljudi uzgajaju kokoške prvenstveno kao izvor hrane, konzumirajući njihovo meso i jaja. Genetske studije ukazuju na višestruko materinsko poreklo u jugoistočnoj Aziji, istočnoj Aziji, i južnoj Aziji, dok klada prisutna u Amerikama, Evropi, Bliskom Istoku i Africi vodi poreklo sa Indijskog potkontinenta. Iz Indije, domestikovane kokoške su uvezene u Lidiju u zapadnoj Maloj Aziji, i u Grčku do petog veka p. n. e. Kokoške su bile poznate u Egiptu od sredine 15. veka p. n. e, pri čemu je „ptica koja daje život svakog dana“ preneta u Egipat iz oblasti između Sirije i Senara, Vavilonija, sudeći po analima Tutmesa III', 1, '3.00', '2022-05-04 18:48:33'),
(49, 'Organska jaja 10 komada', 5, 4, 3, 'Organska jaja ne sadrže pesticide, hormone i teške metale. Proizvode se u skladu sa prirodom u slobodnom uzgoju. Organska jaja su bogata vitaminima B grupe, kao i vitaminima A,D,E i K,kao i luteinom koji ima zaštitno delovanje na bolesti očiju. Organska jaja su pravi izbor za decu i odrasle.', 'Jaja imaju široku primenu u kulinarstvu, zbog svoje velike hranljive vrednosti kao i zbog velikog broj raznovrsnih jela koja se mogu pripemiti od njih. Veliki sadržaja proteina i holina jaja svrstava u istu kategoriju kao i meso unutar piramide ishrane. Masovna proizvodnja kokošijih jaja je globalna industrija. U 2009. godini u svetu je proizvedeno oko 62,1 miliona metričkih tona jaja, koja je snelo stado od oko 6,4 milijardi kokošaka. Pored kokošjih jaja za ishanu se korite jaja gusaka, pataka, ćuraka i prepelica, ali u mnogo manjoj meri.', 0, '0.10', '2022-05-04 18:52:46'),
(50, 'Organska sušena brusnica', 4, 5, 3, 'Organska sušena brusnica', 'Sušene brusnice mogu biti veoma zdrave namirnice, a mogu biti i štetne u zavisnosti koliko ima dodatog šećera i u kojoj količini se konzumiraju. Međutim, iako je njihova konzumacija kotraverzna, njihova popularnost sve više raste u kozmetičkoj industriji. Evo cele istine koliko su sušene brusnice zdrave, kako je najbolje da ih jedete i zašto su sve popularnije u kozmetičkoj industriji.', 1, '0.15', '2022-05-04 18:54:26'),
(51, 'Organska suva kajsija', 4, 1, 3, 'Suva kajsija sadrži veliki procenat vlakana, vitamina, belančevina, minerala i prirodnih šećera. Obiluje magnezijumom i vitaminom B. Sušene su na prirodan način, bez upotrebe oksid sumpora. Organski proizvod', 'I sveže i suve, kajsije su super voće sa brojnim blagotvornim svojstvima za ljudsku ishranu. Za lekovita svojstva i pozitivan učinak kajsija na ceo organizam odavno su znali dugovečni stanovnici pakistanske doline Hunza. Njihova vitalnost i duboka starost povezuju se upravo sa čudesnom Prunius armeneiaca, koju na razne načine koriste u svojoj ishrani. Ulje od koštica i suve kajsije su, uz čisti planinski vazduh, zaslužni za njihovo dugo zdravlje. Sušene kajsije, zapravo, imaju mnogo više prednosti od svežih plodova, iako nema sumnje da ova ukusna narandžasta voćka u svakom obliku ima nebrojene koristi za naš organizam. Stvar je u tome da, tokom procesa sušenja, voće gubi vodu, a pritom se ne oštećuje i ne menja njegova nutritivna vrednost. Sušenjem se hranljiva vrednost kajsije pojačava, jer svi njeni dobri sastojci bivaju koncentrisani i destilovani u snažniji oblik.', 1, '0.25', '2022-05-04 18:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `id_racun` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `suma` double NOT NULL,
  `adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pBroj` int(11) NOT NULL,
  `grad` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`id_racun`, `id_korisnik`, `datum`, `suma`, `adresa`, `pBroj`, `grad`) VALUES
(1, 1, '2022-03-06 16:35:16', 470.99, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `id_slika` int(11) NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_proizvod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`id_slika`, `src`, `alt`, `id_proizvod`) VALUES
(1, 'bananaNaslovna.png', 'banana1', 1),
(2, 'banana1.jpg', 'banana2', 1),
(3, 'banana2.jpg', 'banana3', 1),
(4, 'banana3.jpg', 'banana4', 1),
(5, 'tresnjaNaslovna.jpg', 'tresnja1', 2),
(16, 'tresnja1.jpg', 'tresnja1', 2),
(17, 'tresnja2.jpg', 'tresnja2', 2),
(18, 'tresnja3.jpg', 'tresnja3', 2),
(22, '1651686555_breskva1.jpg', 'breskva1.jpg', 46),
(23, '1651686555_breskva2.jpg', 'breskva2.jpg', 46),
(24, '1651686555_breskva3.jpg', 'breskva3.jpg', 46),
(25, '1651686555_breskvaNaslovna.jpg', 'breskvaNaslovna.jpg', 46),
(26, '1651687013_brokoli1.jpg', 'brokoli1.jpg', 47),
(27, '1651687013_brokoli2.jpg', 'brokoli2.jpg', 47),
(28, '1651687013_brokoli3.jpg', 'brokoli3.jpg', 47),
(29, '1651687013_brokoliNaslovna.jpg', 'brokoliNaslovna.jpg', 47),
(30, '1651690113_pile1.jpg', 'pile1.jpg', 48),
(31, '1651690114_pile2.jpg', 'pile2.jpg', 48),
(32, '1651690114_pile3.jpg', 'pile3.jpg', 48),
(33, '1651690114_pileNaslovna.jpg', 'pileNaslovna.jpg', 48),
(34, '1651690366_jaje2.jpg', 'jaje2.jpg', 49),
(35, '1651690366_jaje3 - Copy.jpg', 'jaje3 - Copy.jpg', 49),
(36, '1651690366_jaje3.jpg', 'jaje3.jpg', 49),
(37, '1651690366_jajeNaslovna.jpg', 'jajeNaslovna.jpg', 49),
(38, '1651690466_susenaBrusnica1.jpg', 'susenaBrusnica1.jpg', 50),
(39, '1651690466_susenaBrusnica2.jpg', 'susenaBrusnica2.jpg', 50),
(40, '1651690466_susenaBrusnica3.jpg', 'susenaBrusnica3.jpg', 50),
(41, '1651690466_susenaBrusnicaNaslovna.jpg', 'susenaBrusnicaNaslovna.jpg', 50),
(42, '1651690564_suvaKajsija.jpg', 'suvaKajsija.jpg', 51),
(43, '1651690564_suvaKajsija2.jpg', 'suvaKajsija2.jpg', 51),
(44, '1651690564_suvaKajsija3.jpg', 'suvaKajsija3.jpg', 51),
(45, '1651690564_suvaKajsijaNaslovna.jpg', 'suvaKajsijaNaslovna.jpg', 51);

-- --------------------------------------------------------

--
-- Table structure for table `stavke_racuna`
--

CREATE TABLE `stavke_racuna` (
  `stavka_racuna_id` int(11) NOT NULL,
  `id_proizvod` int(11) NOT NULL,
  `id_racun` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cena_stavke` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stavke_racuna`
--

INSERT INTO `stavke_racuna` (`stavka_racuna_id`, `id_proizvod`, `id_racun`, `kolicina`, `cena_stavke`) VALUES
(1, 1, 1, 1, '470.99');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `velicina`
--

CREATE TABLE `velicina` (
  `id_velicina` int(11) NOT NULL,
  `naslov` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velicina`
--

INSERT INTO `velicina` (`id_velicina`, `naslov`) VALUES
(1, 'Veliko'),
(2, 'Srednje'),
(3, 'Malo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_meni`
--
ALTER TABLE `admin_meni`
  ADD PRIMARY KEY (`id_meni_admin`);

--
-- Indexes for table `adresa_korisnika`
--
ALTER TABLE `adresa_korisnika`
  ADD PRIMARY KEY (`id_adresa`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id_anketa`);

--
-- Indexes for table `boja`
--
ALTER TABLE `boja`
  ADD PRIMARY KEY (`id_boja`);

--
-- Indexes for table `cena`
--
ALTER TABLE `cena`
  ADD PRIMARY KEY (`id_cena`),
  ADD KEY `id_proizvod` (`id_proizvod`) USING BTREE;

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id_kategorija`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id_meni`);

--
-- Indexes for table `odgovori_anketa`
--
ALTER TABLE `odgovori_anketa`
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_anketa` (`id_anketa`);

--
-- Indexes for table `pitanja_korisnika`
--
ALTER TABLE `pitanja_korisnika`
  ADD PRIMARY KEY (`id_pitanje`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id_proizvod`),
  ADD KEY `id_kategorija` (`id_kategorija`),
  ADD KEY `id_velicina` (`id_velicina`),
  ADD KEY `id_boja` (`id_boja`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`id_racun`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`id_slika`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `stavke_racuna`
--
ALTER TABLE `stavke_racuna`
  ADD PRIMARY KEY (`stavka_racuna_id`),
  ADD KEY `id_proizvod` (`id_proizvod`),
  ADD KEY `id_racun` (`id_racun`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `velicina`
--
ALTER TABLE `velicina`
  ADD PRIMARY KEY (`id_velicina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_meni`
--
ALTER TABLE `admin_meni`
  MODIFY `id_meni_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adresa_korisnika`
--
ALTER TABLE `adresa_korisnika`
  MODIFY `id_adresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id_anketa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `boja`
--
ALTER TABLE `boja`
  MODIFY `id_boja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cena`
--
ALTER TABLE `cena`
  MODIFY `id_cena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id_kategorija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pitanja_korisnika`
--
ALTER TABLE `pitanja_korisnika`
  MODIFY `id_pitanje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id_proizvod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `id_racun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `id_slika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `stavke_racuna`
--
ALTER TABLE `stavke_racuna`
  MODIFY `stavka_racuna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `velicina`
--
ALTER TABLE `velicina`
  MODIFY `id_velicina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresa_korisnika`
--
ALTER TABLE `adresa_korisnika`
  ADD CONSTRAINT `adresa_korisnika_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`);

--
-- Constraints for table `cena`
--
ALTER TABLE `cena`
  ADD CONSTRAINT `cena_ibfk_1` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvodi` (`id_proizvod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`);

--
-- Constraints for table `odgovori_anketa`
--
ALTER TABLE `odgovori_anketa`
  ADD CONSTRAINT `odgovori_anketa_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `odgovori_anketa_ibfk_2` FOREIGN KEY (`id_anketa`) REFERENCES `anketa` (`id_anketa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pitanja_korisnika`
--
ALTER TABLE `pitanja_korisnika`
  ADD CONSTRAINT `pitanja_korisnika_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_4` FOREIGN KEY (`id_boja`) REFERENCES `boja` (`id_boja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proizvodi_ibfk_5` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proizvodi_ibfk_6` FOREIGN KEY (`id_velicina`) REFERENCES `velicina` (`id_velicina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `slike_ibfk_1` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvodi` (`id_proizvod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stavke_racuna`
--
ALTER TABLE `stavke_racuna`
  ADD CONSTRAINT `stavke_racuna_ibfk_1` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvodi` (`id_proizvod`),
  ADD CONSTRAINT `stavke_racuna_ibfk_2` FOREIGN KEY (`id_racun`) REFERENCES `racun` (`id_racun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

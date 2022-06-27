<?php
session_start();

include "konekcija/konekcija.php";
include "models/functions.php";
$page = "";
if (isset($_GET['page'])) {
    $page = ($_GET['page']);
}
if ($page == "login") {
    if (isset($_SESSION['korisnik'])) {
        $korisnik = $_SESSION['korisnik'];
        if ($korisnik->naziv != "admin") {
            header("Location: index.php?page=pocetna");
            exit;
        } else {
            echo ("Gde si bre admine");
        }
    }
} else if ($page == "admin-panel" || $page == "admin-proizvodi" || $page == "admin-dodaj-proizvod" || $page == "admin-poruke" || $page == "admin-ankete" || $page == "admin-dodaj-anketu") {
    if (isset($_SESSION['korisnik'])) {
        $korisnik = $_SESSION['korisnik'];
        if ($korisnik->naziv != "admin") {
            header("Location: index.php?page=pocetna");
            exit;
        }
    } else {
        header("Location: index.php?page=pocetna");
        exit;
    }
} else if ($page == "admin-modifikovanje") {
    if (isset($_SESSION['korisnik'])) {
        $korisnik = $_SESSION['korisnik'];
        if ($korisnik->naziv != "admin") {
            header("Location: index.php?page=pocetna");
            exit;
        }
        if (isset($_GET['kId'])) {
            if (!proveraPostojanja($_GET['kId'])) {
                header("Location: index.php?page=admin-panel");
                exit;
            } else {
                $korisnik = ispisKorisnikaAM($_GET['kId']);
            }
        } else {
            header("Location: index.php?page=admin-panel");
            exit;
        }
    } else {
        header("Location: index.php?page=pocetna");
        exit;
    }
} else if ($page == "admin-pregled-ankete") {
    if (isset($_SESSION['korisnik'])) {
        $korisnik = $_SESSION['korisnik'];
        if ($korisnik->naziv != "admin") {
            header("Location: index.php?page=pocetna");
            exit;
        }
        if (isset($_GET['aId'])) {
            if (!proveraPostojanjaAnkete($_GET['aId'])) {
                header("Location: index.php?page=admin-panel");
                exit;
            } else {
                $anketa = dohvatiAnketu($_GET['aId']);
            }
        } else {
            header("Location: index.php?page=admin-panel");
            exit;
        }
    } else {
        header("Location: index.php?page=pocetna");
        exit;
    }
} else if ($page == "verifikacija") {
    if (!isset($_SESSION['verifikacija'])) {
        header("Location: index.php?page=pocetna");
        exit;
    }
} else if ($page == "poruke") {
    if (!isset($_SESSION['korisnik'])) {
        header("Location: index.php?page=login");
        exit;
    }
} else if ($page == "checkout") {
    if (!isset($_SESSION['korisnik'])) {
        header("Location: index.php?page=login");
        exit;
    }
} else if ($page == "ankete") {
    if (!isset($_SESSION['korisnik'])) {
        header("Location: index.php?page=login");
        exit;
    }
} else if ($page == "shop-details") {
    if (!isset($_GET['id']) || !isset($_GET['categoryId'])) {
        header("Location: index.php?page=pocetna");
        exit;
    } else {
        if ($_GET['id'] == null || ($_GET['categoryId'] == null)) {
            header("Location: index.php?page=pocetna");
            exit;
        }
    }
}



include "pages/head.php";
include "pages/header.php";

switch ($page) {
    case "pocetna":
        include "pagesForView/pocetna.php";
        include "pages/banner.php";
        break;
    case "shop":
        include "pagesForView/shop-grid.php";
        break;
    case "shoping-cart":
        include "pagesForView/shoping-cart.php";
        break;
    case "kontakt":
        include "pagesForView/contact.php";
        break;
    case "login":
        include "pagesForView/login.php";
        break;
    case "register":
        include "pagesForView/register.php";
        break;
    case "admin-panel":
        include "pagesForView/admin-panel.php";
        break;
    case "admin-modifikovanje":
        include "pagesForView/admin-modifikovanje.php";
        break;
    case "admin-proizvodi":
        include "pagesForView/admin-proizvodi.php";
        break;
    case "admin-dodaj-proizvod":
        include "pagesForView/admin-dodaj-proizvod.php";
        break;
    case "verifikacija":
        include "pagesForView/verifikacija.php";
        break;
    case "poruke":
        include "pagesForView/poruke.php";
        break;
    case "admin-poruke":
        include "pagesForView/admin-poruke.php";
        break;
    case "admin-ankete":
        include "pagesForView/admin-ankete.php";
        break;
    case "admin-dodaj-anketu":
        include "pagesForView/admin-dodaj-anketu.php";
        break;
    case "ankete":
        include "pagesForView/ankete.php";
        break;
    case "admin-pregled-ankete":
        include "pagesForView/admin-pregled-ankete.php";
        break;
    case "shop-details":
        include "pagesForView/shop-details.php";
        break;
    case "checkout":
        include "pagesForView/checkout.php";
        break;
    default:
        include "pagesForView/pocetna.php";
        include "pages/banner.php";
        break;
}

include "pages/footer.php";

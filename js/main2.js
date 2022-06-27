var nizProizvodi = [];
function ajaxZaSlanje(url, method, data, result, greska) {
  $.ajax({
    url: url,
    method: method,
    dataType: "JSON",
    data: data,
    success: result,
    error: greska,
  });
}
let bazdniProizvodi = [];

function dohvatiSveIzBaze(funkcija, kolicina, min, max) {
  if (!kolicina && !min) {
    $.ajax({
      url: "models/prozivodiZaKorpu.php",
      method: "POST",
      datatype: "JSON",
      success: function (data) {
        //console.log(data);
        proizvodiBaza = data;
        funkcija(proizvodiBaza);
      },
      error: function (err) {
        //console.log(err);
      },
    });
  } else if (!min) {
    //console.log(kolicina);
    $.ajax({
      url: "models/prozivodiZaKorpu.php",
      method: "POST",
      datatype: "JSON",
      data: {
        kolicina: kolicina,
      },
      success: function (data) {
        //console.log(data);
        proizvodiBaza = data;
        funkcija(proizvodiBaza);
      },
      error: function (err) {
        //console.log(err);
      },
    });
  } else {
    $.ajax({
      url: "models/prozivodiZaKorpu.php",
      method: "POST",
      datatype: "JSON",
      data: {
        kolicina: kolicina,
        min: min,
        max: max,
      },
      success: function (data) {
        //console.log(data);
        proizvodiBaza = data;
        funkcija(proizvodiBaza);
      },
      error: function (err) {
        //console.log(err);
      },
    });
  }
}
dohvatiSveIzBaze(function (niz) {
  bazdniProizvodi = niz;
});

//Window on load
$(window).load(function () {
  function ajaxBekKol(nazivfajla, rezultat) {
    $.ajax({
      url: "./data/" + nazivfajla,
      method: "get",
      dataType: "json",
      success: function (data) {
        rezultat(data);
      },
      error: function (xhr, error, status) {
        //console.log(xhr);
        //console.log(error);
        //console.log(status);
      },
    });
  }
  //Uzimanje url adrese
  let url = $(location).attr("href");
  //console.log(url);
  url = url.substr(url.indexOf("?"), url.length);
  urlSaParametrom = url.substr(url.indexOf("?"), url.indexOf("&"));
  //console.log(urlSaParametrom);
  //console.log(url);

  //Funkcija za setovanje pozadinske slike
  function setujPozadinu() {
    $(".set-bg").each(function () {
      var bg = $(this).data("setbg");
      $(this).css("background-image", "url(" + bg + ")");

      $(this).css("background-position", "center");
    });
  }

  //Funkcija za slider carousel
  function initializeCarousel() {
    $(".categories__slider").trigger("destroy.owl.carousel"); //these 3 lines kill the owl, and returns the markup to the initial state
    $(".categories__slider").find(".owl-stage-outer").children().unwrap();
    $(".categories__slider").removeClass(
      "owl-center owl-loaded owl-text-select-on"
    );
    /*-----------------------
            Categories Slider
        ------------------------*/

    $(".categories__slider").owlCarousel({
      loop: true,
      margin: 0,
      items: 4,
      dots: false,
      nav: true,
      navText: [
        "<span class='fa fa-angle-left'><span/>",
        "<span class='fa fa-angle-right'><span/>",
      ],
      animateOut: "fadeOut",
      animateIn: "fadeIn",
      smartSpeed: 1200,
      autoHeight: false,
      autoplay: true,
      responsive: {
        0: {
          items: 1,
        },

        480: {
          items: 2,
        },

        768: {
          items: 3,
        },

        992: {
          items: 4,
        },
      },
    }); //re-initialise the owl
  }

  function initialzeProductDiscountSlider() {
    $(".product__discount__slider").trigger("destroy.owl.carousel"); //these 3 lines kill the owl, and returns the markup to the initial state
    $(".product__discount__slider")
      .find(".owl-stage-outer")
      .children()
      .unwrap();
    $(".product__discount__slider").removeClass(
      "owl-center owl-loaded owl-text-select-on"
    );
    /*-----------------------------
            Product Discount Slider
        -------------------------------*/

    $(".product__discount__slider").owlCarousel({
      loop: true,
      margin: 0,
      items: 3,
      dots: true,
      smartSpeed: 1200,
      autoHeight: false,
      autoplay: true,
      responsive: {
        320: {
          items: 1,
        },

        480: {
          items: 2,
        },

        768: {
          items: 2,
        },

        992: {
          items: 3,
        },
      },
    });
  }

  function initializeLatestProductSlider() {
    $(".latest-product__slider").trigger("destroy.owl.carousel"); //these 3 lines kill the owl, and returns the markup to the initial state
    $(".latest-product__slider").find(".owl-stage-outer").children().unwrap();
    $(".latest-product__slider").removeClass(
      "owl-center owl-loaded owl-text-select-on"
    );
    /*--------------------------
            Latest Product Slider
        ----------------------------*/
    $(".latest-product__slider").owlCarousel({
      loop: true,
      margin: 0,
      items: 1,
      dots: false,
      nav: true,
      navText: [
        "<span class='fa fa-angle-left'><span/>",
        "<span class='fa fa-angle-right'><span/>",
      ],
      smartSpeed: 1200,
      autoHeight: false,
      autoplay: true,
    });
  }

  function initializePriceSlider() {
    /*-----------------------
            Price Range Slider
        ------------------------ */
    var rangeSlider = $(".price-range"),
      minamount = $("#minamount"),
      maxamount = $("#maxamount"),
      minPrice = rangeSlider.data("min"),
      maxPrice = rangeSlider.data("max");
    rangeSlider.slider({
      range: true,
      min: minPrice,
      max: maxPrice,
      values: [minPrice, maxPrice],
      slide: function (event, ui) {
        minamount.val(ui.values[0] + " RSD");
        maxamount.val(ui.values[1] + " RSD");
        maxValue = ui.values[1];
      },
    });
    minamount.val(rangeSlider.slider("values", 0) + " RSD");
    maxamount.val(rangeSlider.slider("values", 1) + " RSD");
  }

  initializePriceSlider();

  /*--------------------------
          Select
      ----------------------------*/
  $("select").niceSelect();

  function intializeProductSlider() {
    $(".product__details__pic__slider").trigger("destroy.owl.carousel"); //these 3 lines kill the owl, and returns the markup to the initial state
    $(".product__details__pic__slider")
      .find(".owl-stage-outer")
      .children()
      .unwrap();
    $(".product__details__pic__slider").removeClass(
      "owl-center owl-loaded owl-text-select-on"
    );
    /*---------------------------------
            Product Details Pic Slider
        ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
      loop: true,
      margin: 20,
      items: 4,
      dots: true,
      smartSpeed: 1200,
      autoHeight: false,
      autoplay: true,
    });

    $(".product__details__pic__slider img").on("click", function () {
      var imgurl = $(this).data("imgbigurl");
      var bigImg = $(".product__details__pic__item--large").attr("src");
      if (imgurl != bigImg) {
        $(".product__details__pic__item--large").attr({
          src: imgurl,
        });
      }
    });
  }

  function counter() {
    /*-------------------
          Quantity change
        --------------------- */
    var proQty = $(".pro-qty");
    proQty.prepend('<span class="dec qtybtn plus">-</span>');
    proQty.append('<span class="inc qtybtn plus">+</span>');
    proQty.on("click", ".qtybtn", function () {
      var $button = $(this);
      var oldValue = $button.parent().find("input").val();
      if ($button.hasClass("inc")) {
        var newVal = parseFloat(oldValue) + 1;
      } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 0;
        }
      }
      $button.parent().find("input").val(newVal);
    });
  }

  function textZaProdukt(element, naziv, lg, md, sm) {
    return ` <div class="col-lg-${lg} col-md-${md} col-sm-${sm} proba" id="pr${element.id}">
              <div class="${naziv}__item">
                <div class="${naziv}__item__pic set-bg bg-size-contain" data-setbg="img/skladistenjeSlika/${element.img}">
                  <ul class="${naziv}__item__pic__hover">
                  <!--
                    <li><a href="javascript:void(0);"><i class="fa fa-heart"></i></a></li>
                    <li><a href="javascript:void(0);"><i class="fa fa-retweet"></i></a></li>-->
                    <li><a href="javascript:void(0);" onclick='dodajProizvodKorpa(${element.id}); ukupnaCenaProizvoda(); modal("Proizvod je dodat u korpu","Proverite proizvode u korpi klikom na ikonicu korpa");'><i class="fa fa-shopping-cart"></i></a></li>
                  </ul>
                </div>
                <a href="index.php?page=shop-details&id=${element.id}&categoryId=${element.categoryId}">
                  <div class="${naziv}__item__text">
                    <h6>${element.title}</h6>
                    <h5>${element.price} RSD</h5> 
                  </div>
                </a>
              </div>
            </div>`;
  }

  //Funkcija za ispis produkta
  function ispisProdukta(niz, naziv, lg, md, sm) {
    //console.table(niz);
    let text = "";
    if (url === "?page=shop") {
      niz = filtriranjeKategorija(niz);
      niz = sort(niz);
      niz = filtriranjePoCenovnomRangu(niz);
      niz = filtriranjeBoja(niz);
      niz = filtriranjeVelicina(niz);
      niz = pretraga(niz);
      //napraviDugmiceStranicenje(niz.length);
      $("#kolicinaProizvoda").html(niz.length);
      if (niz == "") {
        //console.log("alo");
        text = `<div class="nemogucFilter">
                    <h1>Nije moguće pronaći proizvode po zadatom kriterijumu.</h1>
                    <div id="ponistiFiltere" class="visible">
                    <label class="kursor" for="all">Poništi sve filtere</label>
                    </div>
                </div>`;
        $("#" + naziv + "Proizvodi").html(text);
      }
    }

    if (url === "?page=pocetna" || url === "p") {
      for (let i = 0; i < 8; i++) {
        text += textZaProdukt(niz[i], naziv, lg, md, sm);
      }
    } else {
      niz.forEach((element) => {
        text += textZaProdukt(element, naziv, lg, md, sm);
      });
    }

    $("#" + naziv + "Proizvodi").html(text);
    setujPozadinu();
  }

  function ispisKategorjaMeni(niz) {
    let html = "";
    niz.forEach((element) => {
      html += `<li><a href="shop-grid.php?catId=${element.id}">${element.title}</a></li>`;
    });

    $("#kategorijeMeni").html(html);
  }
  setujPozadinu();
  setTimeout(() => {
    ukupnaCenaProizvoda();
  }, 1);
  var pomId;

  //STRANICA INDEX---------------------------------------------------------------
  if (url === "?page=pocetna" || url === "p") {
    //Ispis produkta na index stranici
  } else if (url === "?page=shop") {
    //STRANICA SHOP-------------------------------------------------------------------------
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    let catId = url.substr(url.indexOf("&") + 7, url.length);

    let brPoStrani = $("#prikazPoStrani").val();
    setTimeout(() => {
      dohvatiSveIzBaze(function (niz) {
        bazdniProizvodi = niz;
      });
    }, 200);

    dohvatiSveIzBaze(function (niz) {
      ispisProdukta(niz, "product", 4, 6, 6);
    }, brPoStrani);

    setTimeout(() => {
      napraviDugmiceStranicenje(bazdniProizvodi.length);
    }, 250);

    //ispsSidebarKategorija();
    //Ispis katefgorija
    function ispsSidebarKategorija() {
      /* html = "<ul>";
      niz.forEach((el) => {
        if (el.id == params.catId) {
          html += `<li>
                    <input
                        class="mr-2 mb-2 kategorije"
                        type="checkbox"
                        checked
                        name="${el.id}"
                        value="${el.id}"
                    />${el.title}
                </li>`;
        } else {
          html += `<li>
                    <input
                        class="mr-2 mb-2 kategorije"
                        type="checkbox"
                        name="${el.id}"
                        value="${el.id}"
                    />${el.title}
                </li>`;
        }
      });
      html += "</ul>";

      $("#sidebarCategory").html(html); */
      /*  for (let i = 0; i < $(".kategorije").length; i++) {
        if ($(".kategorije")[i].value == params.catId) {
          ////console.log($(".kategorije")[i].value);
          $(".kategorije")[i].checked = true;
        }
      } */
      //$(".kategorije").on("change", pozivanjeAjaxaZaProdukte);
      //proveraCekiranih(".kategorije");
    }

    $(".kategorije").on("change", () => {
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      });
      //console.log(urlSaParametrom);
    });
    for (let i = 0; i < $(".kategorije").length; i++) {
      if ($(".kategorije")[i].value == catId) {
        ////console.log($(".kategorije")[i].value);
        $(".kategorije")[i].checked = true;
        proveraCekiranih(".kategorije");
      }
    }

    $("input[name='color']").on("change", () => {
      //console.log("boja");
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      });
    });

    $("input[name='size']").on("change", () => {
      //console.log("boja");
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      });
    });

    //Filtriranje po cenovnom rangu
    $("#linija").on("mousemove", () => {
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      });
    });

    $("#sort").on("change", () => {
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      });
    });

    $("#btnPretraga").on("click", (e) => {
      e.preventDefault();
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      });
    });
    proveraCekiranih(".kategorije");
    proveraCekiranih(".radioBoja");
    proveraCekiranih(".radioVelicina");

    $("#prikazPoStrani").on("change", () => {
      brPoStrani = $("#prikazPoStrani").val();
      //console.log(brPoStrani);
      napraviDugmiceStranicenje(bazdniProizvodi.length);
      dohvatiSveIzBaze(function (niz) {
        ispisProdukta(niz, "product", 4, 6, 6);
      }, brPoStrani);
    });

    function napraviDugmiceStranicenje(brojProizvoda) {
      /*  //console.log(brojProizvoda);
      //console.log($("#prikazPoStrani").val()); */
      let brojDugmica = Math.ceil(brojProizvoda / $("#prikazPoStrani").val());
      //console.log(brojDugmica);
      let html = ``;
      for (let i = 0; i < brojDugmica; i++) {
        html += `<a data-min="${$("#prikazPoStrani").val() * i}" data-max="${
          $("#prikazPoStrani").val() * (i + 1)
        }" class="dugmeStranica">${i + 1}</a>`;
      }
      $("#product__pagination").html(html);

      let dugmici = $(".dugmeStranica");
      for (let i = 0; i < dugmici.length; i++) {
        dugmici[i].addEventListener("click", () => {
          let min = dugmici[i].getAttribute("data-min");
          let max = dugmici[i].getAttribute("data-max");
          brPoStrani = $("#prikazPoStrani").val();
          dohvatiSveIzBaze(
            function (niz) {
              ispisProdukta(niz, "product", 4, 6, 6);
            },
            brPoStrani,
            min,
            max
          );
        });
      }
    }

    //Filtriraj po kategorijama
    function filtriranjeKategorija(niz) {
      let nizSelektovanih = [];
      for (let i = 0; i < $(".kategorije:checked").length; i++) {
        ////console.log($(".pisac:checked")[i].value);
        nizSelektovanih.push(parseInt($(".kategorije:checked")[i].value));
      }

      if (nizSelektovanih != 0) {
        return niz.filter((x) => nizSelektovanih.includes(x.categoryId));
      } else {
        return niz;
      }
    }

    //Ispis boja
    function ispisSidebarBoje(niz) {
      /* html = "";
      niz.forEach((el) => {
        html += `<div class="sidebar__item__color sidebar__item__color--${el.code}">
                        <label for="color${el.id}">
                        ${el.name}
                        <input type="radio" class="radioBoja" id="color${el.id}" value="${el.id}" name="color" />
                        </label>
                    </div>`;
      }); 

      $("#sidebarColor").html(html);*/

      //$(".radioBoja").change(pozivanjeAjaxaZaProdukte);

      proveraCekiranih(".radioBoja");
    }

    //Ispis velicina
    function ispisSidebarVelicina(niz) {
      /* html = "";
      niz.forEach((el) => {
        html += `<div class="sidebar__item__size">
                    <label for="size${el.id}">
                    ${el.title}
                    <input type="radio" class="radioVelicina" id="size${el.id}" value="${el.id}" name="size" />
                    </label>
                </div>`;
      });
      $("#sidebarSize").html(html); */

      //$(".radioVelicina").change(pozivanjeAjaxaZaProdukte);

      proveraCekiranih(".radioVelicina");
    }

    //Sortitanje
    //$("#sort").change(pozivanjeAjaxaZaProdukte);

    function sort(niz) {
      let tipSortiranja = document.getElementById("sort").value;
      if (tipSortiranja == "nazivRastuce") {
        return niz.sort((el1, el2) => {
          if (el1.title < el2.title) {
            return -1;
          }
          if (el1.title > el2.title) {
            return 1;
          }
          return 0;
        });
      } else if (tipSortiranja == "nazivOpadajuce") {
        return niz.sort((el1, el2) => {
          if (el1.title < el2.title) {
            return 1;
          }
          if (el1.title > el2.title) {
            return -1;
          }
          return 0;
        });
      } else if (tipSortiranja == "cenaRastuce") {
        return niz.sort((el1, el2) => {
          if (parseInt(el1.price) < parseInt(el2.price)) {
            return -1;
          }
          if (parseInt(el1.price) > parseInt(el2.price)) {
            return 1;
          }
          return 0;
        });
      } else if (tipSortiranja == "cenaOpadajuce") {
        return niz.sort((el1, el2) => {
          if (parseInt(el1.price) < parseInt(el2.price)) {
            return 1;
          }
          if (parseInt(el1.price) > parseInt(el2.price)) {
            return -1;
          }
          return 0;
        });
      } /* else if (tipSortiranja == "datumRastuce") {
        return niz.sort((el1, el2) => {
          let a = new Date(el1.dateTime);
          let b = new Date(el2.dateTime);
          if (a < b) {
            return -1;
          }
          if (a > b) {
            return 1;
          }
          return 0;
        });
      } else if (tipSortiranja == "datumOpadajuce") {
        return niz.sort((el1, el2) => {
          let a = new Date(el1.dateTime);
          let b = new Date(el2.dateTime);
          if (a < b) {
            return 1;
          }
          if (a > b) {
            return -1;
          }
          return 0;
        });
      } */ else {
        return niz;
      }
    }

    $("#linija").on("mousedown", () => {
      vidljivPonistiFiltere();
    });

    function filtriranjePoCenovnomRangu(niz) {
      let min = $("#minamount").val();
      min = min.substr(0, min.length - 3);
      let max = $("#maxamount").val();
      max = max.substr(0, max.length - 3);
      return niz.filter((el) => {
        if (
          parseInt(el.price) > parseInt(min) &&
          parseInt(el.price) < parseInt(max)
        ) {
          return el;
        }
      });
    }

    //Ispis najsvezijih proizvoda
    function ispisNajsvezijihProizvoda(niz) {
      niz.sort((el1, el2) => {
        let a = new Date(el1.dateTime);
        let b = new Date(el2.dateTime);
        if (a < b) {
          return 1;
        }
        if (a > b) {
          return -1;
        }
        return 0;
      });
      let html = `<div class="latest-prdouct__slider__item">`;
      for (let i = 0; i < 3; i++) {
        ////console.log(niz[i]);
        html += `<a href="shop-details.php?id=${niz[i].id}&categoryId=${niz[i].categoryId}" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="${niz[i].img[0].src}" alt="${niz[i].img[0].alt}" />
                  </div>
                  <div class="latest-product__item__text">
                    <h6>${niz[i].title}</h6>
                    <span>${niz[i].price.newPrice}</span>
                  </div>
                </a>`;
      }
      html += `</div>`;
      html += `<div class="latest-prdouct__slider__item">`;
      for (let i = 3; i < 6; i++) {
        ////console.log(niz[i]);
        html += `<a href="shop-details.php?id=${niz[i].id}&categoryId=${niz[i].categoryId}" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="${niz[i].img[0].src}" alt="${niz[i].img[0].alt}" />
                  </div>
                  <div class="latest-product__item__text">
                    <h6>${niz[i].title}</h6>
                    <span>${niz[i].price.newPrice}</span>
                  </div>
                </a>`;
      }
      html += `</div>`;

      $("#najsvezije1").html(html);

      //initializeLatestProductSlider();
    }

    //Filtriranje boja
    function filtriranjeBoja(niz) {
      const radioButtons = document.querySelectorAll('input[name="color"]');
      let selectedSize = [];
      for (const radioButton of radioButtons) {
        if (radioButton.checked) {
          selectedSize.push(radioButton.value);
        }
      }
      if (selectedSize != 0) {
        return niz.filter((x) => selectedSize == x.colorId);
      } else {
        return niz;
      }
    }

    //Filtriranje velicina
    function filtriranjeVelicina(niz) {
      const radioButtons = document.querySelectorAll('input[name="size"]');
      let selectedSize = [];
      for (const radioButton of radioButtons) {
        if (radioButton.checked) {
          selectedSize.push(radioButton.value);
        }
      }
      if (selectedSize != 0) {
        return niz.filter((x) => selectedSize == x.sizeId);
      } else {
        return niz;
      }
    }

    //Ispis sizenih proizvoda
    function ispisSnizenihProizvoda(niz) {
      html = "";
      for (let i = 0; i <= 3; i++) {
        html += `<div class="col-lg-4">
                  <div class="product__discount__item">
                    <div
                      class="product__discount__item__pic set-bg bg-size-contain"
                      data-setbg="${niz[i].img[0].src}"
                    >
                      <div class="product__discount__percent">-${racunanjeProcenta(
                        niz[i].price.oldPrice,
                        niz[i].price.newPrice
                      )}%</div>
                      <ul class="product__item__pic__hover">
                        <li>
                          <a href="javascript:void(0);" onclick="dodajProizvodKorpa(${
                            niz[i].id
                          }); ukupnaCenaProizvoda(); modal('Proizvod je dodat u korpu','Proverite proizvode u korpi klikom na ikonicu korpa');"><i class="fa fa-shopping-cart"></i></a>
                        </li>
                      </ul>
                    </div>
                    <div class="product__discount__item__text">
                      <span>${ispisKategorije(niz[i].categoryId)}</span>
                      <h5><a href="shop-details.php?id=${
                        niz[i].id
                      }&categoryId=${niz[i].categoryId}">${
          niz[i].title
        }</a></h5>
                      <div class="product__item__price">
                        ${niz[i].price.newPrice} <span>${
          niz[i].price.oldPrice
        }</span>
                      </div>
                    </div>
                  </div>
                </div>`;
      }

      $("#snizenoSlider").html(html);
      setujPozadinu();
      //initialzeProductDiscountSlider();
    }

    //Racunja procenta popusta
    function racunanjeProcenta(staraCena, novaCena) {
      let procenat;
      procenat = Math.ceil(((staraCena - novaCena) / staraCena) * 100);
      return procenat.toString();
    }

    //Ispis kategorija za funkciju ispis proizvoda
    function ispisKategorije(id) {
      let html = "";
      for (let i in kategorije) {
        if (kategorije[i].id == id) {
          html += kategorije[i].title;
        }
      }
      return html;
    }

    //$("#poljeZaPretragu").on("keyup", pozivanjeAjaxaZaProdukte);

    //Filtriranje po nazivu i po kategoriji proizvoda
    function pretraga(niz) {
      let uneseniText = $("#poljeZaPretragu").val();
      let pretragenNiz = niz.filter((x) => {
        if (
          x.title.toLowerCase().indexOf(uneseniText.trim().toLowerCase()) !=
            -1 ||
          ispisKategorije(x.categoryId)
            .toLowerCase()
            .indexOf(uneseniText.trim().toLowerCase()) != -1
        ) {
          return x;
        }
      });
      return pretragenNiz;
    }
  } else if (urlSaParametrom === "?page=shop-details") {
    //console.log(urlSaParametrom);
    const urlSearchParams = new URLSearchParams(window.location.search);
    let params = Object.fromEntries(urlSearchParams.entries());
    pomId = params.id;
    //console.log(params);
    if (Object.keys(params).length === 0) {
      params = {
        id: 1,
        categoryId: 2,
      };
    }

    let podatak = {
      id: params.id,
    };

    function pojedinacniProizvodi(funkcija) {
      $.ajax({
        url: "models/prozivodiZaPojedinacanIspis.php",
        method: "POST",
        datatype: "JSON",
        data: podatak,
        success: function (data) {
          //console.log(data);
          funkcija(data);
        },
        error: function (err) {
          //console.log(err);
        },
      });
    }

    pojedinacniProizvodi(function (niz) {
      prikaziProizvod(niz);
      prikazRijeltovanih(niz);
    });

    function prikaziProizvod(niz) {
      let html = "";
      let breadcrumb = "";

      let nizP = niz[0];
      var nizS = niz[1];

      for (let i = 0; i < nizP.length; i++) {
        ////console.log(nizP[0].id);
        if (nizP[i].id == params.id) {
          html += `<div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="product__details__pic">
                        <div class="product__details__pic__item">
                          <img
                            class="product__details__pic__item--large"
                            src="img/skladistenjeSlika/${nizS[0].src}"
                            alt="${nizS[0].alt}"
                          />
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                          <img
                            data-imgbigurl="img/skladistenjeSlika/${
                              nizS[1].src
                            }"
                            src="img/skladistenjeSlika/${nizS[1].src}"
                            alt="${nizS[1].alt}"
                          />
                          <img
                          data-imgbigurl="img/skladistenjeSlika/${nizS[2].src}"
                          src="img/skladistenjeSlika/${nizS[2].src}"
                          alt="${nizS[2].alt}"
                          />
                          <img
                          data-imgbigurl="img/skladistenjeSlika/${nizS[0].src}"
                          src="img/skladistenjeSlika/${nizS[0].src}"
                          alt="${nizS[0].alt}"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="product__details__text">
                        <h3>${nizP[i].title}</h3>
                        <div class="product__details__rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                          <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">${
                          nizP[i].price
                        }RSD</div>
                        <p>
                          ${nizP[i].shortDescription}
                        </p>
                        ${dodajUkorpuAkoJeNaStanju(nizP[i].stanje, nizP[i].id)}
                        <ul>
                          <li><b>Dostupnost</b> <span>${dostupnost(
                            nizP[i].stanje
                          )}</span></li>
                          <li>
                            <b>Dostava</b>
                            <span>Brza dostava<samp> Besplatno preuzimanje</samp></span>
                          </li>
                          <li><b>Težina</b> <span>${
                            nizP[i].tezina
                          }kg</span></li>
                          <li>
                            <b>Zapratite</b>
                            <div class="share">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                              <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                            <a
                              class="nav-link active"
                              data-toggle="tab"
                              href="#tabs-1"
                              role="tab"
                              aria-selected="true"
                              >Deskripcija</a
                            >
                          </li>
                          
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                              <h6>Informacije o proizvodu</h6>
                              <p>${nizP[i].longDescription}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>`;

          breadcrumb += `<h2>${nizP[i].title}</h2>
                          <div class="breadcrumb__option">
                                <a href="./index.php">Početna</a>
                                <a href="./shop-grid.php">Shop</a>
                                <span>Proizvod</span>
                              </div>`;
        }
      }
      $("#jedanProizvod").html(html);
      $(".breadcrumb__text").html(breadcrumb);
      intializeProductSlider();
      counter();
    }
    function dodajUkorpuAkoJeNaStanju(pom, id) {
      let html = "";
      if (pom == true) {
        return (html += `<div class="product__details__quantity">
        <div class="quantity">
          <div class="pro-qty">
            <input id="poljeZaKolicinu" type="text" value="1" />
          </div>
        </div>
      </div>
      <a href="#" class="primary-btn" onclick="dugmeDodajUKorpu(${id}); modal('Proizvod je dodat u korpu','Proverite proizvode u korpi klikom na ikonicu korpa');">DODAJ U KORPU</a>`);
      } else {
        return (html += "");
      }
    }

    function dostupnost(bool) {
      if (bool) {
        return "Na stanju";
      } else {
        return "Nije na stanju";
      }
    }
  } else if (url === "?page=shoping-cart") {
    $("#btnOsveziKorpu").click(() => {
      ispisKorpa();
      ukupnaCenaProizvoda();
    });
    $("#btnNastaviDalje").click(() => {
      ispisKorpa();
      ukupnaCenaProizvoda();
    });
    setTimeout(() => {
      ispisKorpa();
    }, 250);
    /* FUnkcija za dinamicko ispisivanje korpe */
    ispisKorpa();
    function ispisKorpa() {
      let text = ``;
      let subTotalText = ``;
      let subTotal = 0;
      let kolicinaSubtotal = 0;
      let proizvodiKorpa = uzmiItemIzLocalStorage("proizvodiKorpa");
      if (proizvodiKorpa == null || proizvodiKorpa.length == 0) {
        let html = `<div class="praznaKorpa">
                        <img  src="img/cart/slikaKorpe.png" alt="slikaKorpe" />
                        <h3 class="mb-5">Vaša korpa je prazna</h3>
                    </div>`;
        $("#sadrzajKorpe").html(html);
        $("#btnNastaviDalje").attr("href", "#");
      } else if (proizvodiKorpa != null) {
        for (pk of proizvodiKorpa) {
          ////console.log(proizvodiKorpa);
          for (p of bazdniProizvodi) {
            if (pk.id == p.id) {
              text += ispisiUnutarKorpe(p, pk.kolicina);
              subTotal += p.price * pk.kolicina;
              kolicinaSubtotal += pk.kolicina;
            }
          }
        }
        $("#sadrzajKorpe").html(text);
      }

      subTotalText += ispisSubTotalKorpe(subTotal, kolicinaSubtotal);

      $("#subTotalKorpa").html(subTotalText);

      function ispisiUnutarKorpe(obj, kolicina) {
        let html = ``;
        html += `
          <div id="divJedanRedKorpa${
            obj.id
          }" class="glavniDiv d-flex flex-column justify-content-between align-items-center flex-md-row">
                <div>
                  <img class="mb-2 malaSlika" src="img/skladistenjeSlika/${
                    obj.img
                  }" alt="${obj.img}" />
                </div>
                <div class="fix-duzina-naziv"><h5 class="mb-2">${
                  obj.title
                }</h5></div>
                <div id="cenaJednogKomada${obj.id}" class="shopingcartprice">${
          obj.price
        }</div>
                <div class="shopingcartquantity" class="mb-2">
                  <div class="counterDiv" class="mb-2">
                    <button onclick="smanji(${obj.id})" id="dugmeMinus${
          obj.id
        }" class="btnMinuIPlus">-</button>
                    <input
                      id="text${obj.id}"
                      class="counterInput"
                      type="text"
                      name=""
                      disabled
                      value="${kolicina}"
                    />
                    <button onclick="povecaj(${obj.id})" id="dugmePlus${
          obj.id
        }" class="btnMinuIPlus">+</button>
                  </div>
                </div>
                <div><p class="shopingcarttotal m-0 width-100"  id="ukupnaCena${
                  obj.id
                }">${izracunajCenu(obj.price, kolicina)}</p></div>
                <div class="shopingcartitem__close mb-2">
                  <span onclick="izbaciIzKorpe(${
                    obj.id
                  })" class="icon_close dugmeIzbrisi"></span>
                </div>
              </div>
          `;
        return html;
      }
    }
    function ispisSubTotalKorpe(cena, kolicina) {
      let html = "";
      html += `<li>Broj proizvoda <span>${kolicina}</span></li>
                 <li>Ukupno <span>${parseFloat(cena).toFixed(
                   2
                 )} RSD</span></li>`;
      return html;
    }
    function izracunajCenu(cena, kolicina) {
      let html = ``;
      return (html += parseFloat(cena * kolicina).toFixed(2));
    }
  } else if (url === "?page=checkout") {
    dohvatiSveIzBaze(function (niz) {
      ispisUnutarPlacanjeProizvode(niz);
      ukupnaCenaProizvoda();
      //ispisKategorjaMeni(niz);
    });

    /* Funkcija za slanje porudzbine */
    function posaljiPorudzbinu() {
      let adresa = $("#adresa").val();
      proveraAdrese(adresa)
        ? $("#greskaAdresa").hide()
        : ispisiGresku("adresa");

      let grad = $("#grad").val();
      proveraGrad(grad) ? $("#greskaGrad").hide() : ispisiGresku("grad");

      let pBroj = $("#postanskiBroj").val();
      proveraPostanskiBroj(pBroj)
        ? $("#greskaPostanskiBroj").hide()
        : ispisiGresku("postanskiBroj");

      if (
        proveraAdrese(adresa) &&
        proveraGrad(grad) &&
        proveraPostanskiBroj(pBroj)
      ) {
        let uKopri = uzmiItemIzLocalStorage("proizvodiKorpa");
        let proizvodi = [];
        let kolicine = [];
        for (let i = 0; i < uKopri.length; i++) {
          proizvodi.push(uKopri[i].id);
          kolicine.push(uKopri[i].kolicina);
        }
        //console.log(uKopri);
        //console.log(proizvodi);
        //console.log(kolicine);
        let adresa = $("#adresa").val();
        let zip = $("#postanskiBroj").val();
        let grad = $("#grad").val();
        let zaSlanje = {
          proizvodi: proizvodi,
          kolicine: kolicine,
          adresa: adresa,
          zip: zip,
          grad: grad,
        };
        ajaxZaSlanje(
          "models/dodavanjeRacuna.php",
          "POST",
          zaSlanje,
          function (data) {
            modal("Uspeno ste poručili!", "");
            setTimeout(() => {
              window.location.href = "index.php?page=pocetna";
              localStorage.removeItem("proizvodiKorpa");
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            //console.log(xhr);
            //console.log(xhr.responseText);
            if (xhr.status == 409) {
              modal("Niste uneli ispravan verifikacioni kod!", "");
            } else if (xhr.status == 401) {
              modal("Morate prvo proci proces registracije!", "");
            } else {
              modal("Greska na serveru molimo pokusajte kasnije!", "");
            }
          }
        );

        $("#adresa").val("");
        $("#grad").val("");
        $("#postanskiBroj").val("");
      }
    }
    /* Funkcija za ispis gresaka */
    function ispisiGresku(imePolja) {
      if (imePolja == "adresa")
        ispisGreskeIspodInputa("greskaAdresa", "Niste uneli ispravnu adresu");
      if (imePolja == "grad")
        ispisGreskeIspodInputa(
          "greskaGrad",
          "Prva slova velika, najviše 3 reči"
        );
      if (imePolja == "postanskiBroj")
        ispisGreskeIspodInputa(
          "greskaPostanskiBroj",
          "Samo brojevi, od 4 do 6 cifara"
        );
    }
    /* Ispis greske ispod inputa */
    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }
    /* Funkcija za ispitivanje unosa imena i prezimena */
    function proveriImePrezime(imePrezime) {
      let uzorakEmail =
        /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15})?$/;
      if (uzorakEmail.test(imePrezime)) return true;
      else return false;
    }
    function proveriIme(ime) {
      let uzorakIme = /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}$/;
      if (uzorakIme.test(ime)) return true;
      else return false;
    }
    function proveriKorisnickoIme(kIme) {
      let uzorakKIme = /^[A-ZČĆŠĐŽa-zčćšđž0-9_-]{1,20}$/;
      if (uzorakKIme.test(kIme)) return true;
      else return false;
    }
    function proveriPassword(sifra) {
      let uzorakPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
      if (uzorakPass.test(sifra)) return true;
      else return false;
    }
    /* Funkcija za ispitivanje unosa adrese */
    function proveraAdrese(adresa) {
      let uzorakAdresa =
        /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}(\s[1-9](?:[A-ZČĆŠĐŽ]|[a-zčćšđž]))?(\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15})?(?:\s[0-9]{0,3}|\s[1-9](?:[A-ZČĆŠĐŽ]|[a-zčćšđž]))?$/;
      if (uzorakAdresa.test(adresa)) return true;
      else return false;
    }
    /* Funkcija za ispitivanje unosa grada */
    function proveraGrad(grad) {
      let uzorakGrad =
        /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15})?(\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,15})?$/;
      if (uzorakGrad.test(grad)) return true;
      else return false;
    }
    function proveraPostanskiBroj(broj) {
      let uzorakBroj = /^[0-9]{3,6}\s*$/;
      if (uzorakBroj.test(broj)) return true;
      else return false;
    }
    function proveraTelefon(broj) {
      let uzorakBroj = /^06[0-9]{6,9}$/;
      if (uzorakBroj.test(broj)) return true;
      else return false;
    }

    $("#btnSlanjePorudzbine").on("click", (e) => {
      e.preventDefault();
      posaljiPorudzbinu();
    });

    function ispisUnutarPlacanjeProizvode(nizProizvodi) {
      let proizvodiKorpa = uzmiItemIzLocalStorage("proizvodiKorpa");
      let html = ``;
      let suma = 0;
      for (pk of proizvodiKorpa) {
        for (p of bazdniProizvodi) {
          if (pk.id == p.id) {
            suma += pk.kolicina * p.price;
            html += `<li>${pk.kolicina + "x " + p.title}<span>${parseFloat(
              pk.kolicina * p.price
            ).toFixed(2)}</span></li>`;
          }
        }
      }
      suma = parseFloat(suma).toFixed(2);
      if (suma > 3000) $("#besplatno").html("0.0 RSD");
      else {
        $("#besplatno").html("500 RSD");
        console.log(typeof suma);
        suma = parseFloat(suma) + 500;
        console.log(suma);
      }
      $("#porudzbina-stavke").html(html);
      $("#ukupno").html(suma + " RSD");
    }
    $("input[type=radio][name=placanje]").change(function () {
      //console.log(this.value);
      if (this.value == "pouzece") {
        $("#pouzeceKom").removeClass("visible");
        $("#pouzeceKom").addClass("invisible");
      } else if (this.value == "tekuciRacun") {
        $("#pouzeceKom").removeClass("invisible");
        $("#pouzeceKom").addClass("visible");
      }
    });
  } else if (url === "?page=verifikacija") {
    //console.log("alo");
    function proveriVerifikacioniKod() {
      let kod = $("#poljeKod").val();
      let regKod = /^[1-9][0-9]{5}$/;
      if (regKod.test(kod)) {
        $("#greskaPoljeKod").hide();
        let podatak = {
          kod: kod,
        };
        ajaxZaSlanje(
          "models/verifikacija.php",
          "POST",
          podatak,
          function (data) {
            modal("Uspeno ste verifikovali nalog!", "");
            setTimeout(() => {
              window.location.href = "index.php?page=login";
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            if (xhr.status == 409) {
              modal("Niste uneli ispravan verifikacioni kod!", "");
            } else if (xhr.status == 401) {
              modal("Morate prvo proci proces registracije!", "");
            } else {
              modal("Greska na serveru molimo pokusajte kasnije!", "");
            }
          }
        );
      } else {
        $("#greskaPoljeKod").show();
        $("#greskaPoljeKod").html("Nije ispravan format koda");
      }
    }
    $("#btnVerifikuj").on("click", (e) => {
      e.preventDefault();
      proveriVerifikacioniKod();
    });
  } else if (url === "?page=register") {
    /* Funkcija za proveru registracije korisnika */
    function registrujKorisnika() {
      let ime = $("#ime").val();
      proveriIme(ime) ? $("#greskaIme").hide() : ispisiGresku("ime");

      let prezime = $("#prezime").val();
      proveriIme(prezime)
        ? $("#greskaPrezime").hide()
        : ispisiGresku("prezime");

      let email = $("#email").val();
      proveraEmail(email) ? $("#greskaEmail").hide() : ispisiGresku("email");

      let kIme = $("#kIme").val();
      proveriKorisnickoIme(kIme)
        ? $("#greskaKIme").hide()
        : ispisiGresku("kIme");

      let sifra = $("#sifra").val();
      proveriPassword(sifra) ? $("#greskaSifra").hide() : ispisiGresku("sifra");

      if (
        proveriIme(ime) &&
        proveriIme(prezime) &&
        proveraEmail(email) &&
        proveriKorisnickoIme(kIme) &&
        proveriPassword(sifra)
      ) {
        let zaSlanje = {
          ime: $("#ime").val(),
          prezime: $("#prezime").val(),
          email: $("#email").val(),
          korisnickoIme: $("#kIme").val(),
          sifra: $("#sifra").val(),
        };
        ajaxZaSlanje(
          "models/registracija.php",
          "post",
          zaSlanje,
          function (rezultat) {
            //console.log(rezultat.poruka);
            modal("Uspešno ste se registrovali!", "");
            setTimeout(() => {
              window.location.href = "index.php?page=verifikacija";
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            //console.log(xhr.responseText);
            //console.log(xhr);
            if (xhr.status == 409) {
              modal("Korisnik sa tom e-mail adresom vec postoji", "");
            } else if (xhr.status == 408) {
              modal("Korisnik sa tim korisnickim imenom vec postoji", "");
            } else if (xhr.status == 404) {
              //console.log("Stranica nije pronadjena");
            } else {
              modal("Doslo je do greske, niste uspeli da se registrujete", "");
            }
          }
        );

        $("#ime").val("");
        $("#email").val("");
        $("#prezime").val("");
        $("#kIme").val("");
        $("#sifra").val("");
      }
    }
    /* Funkcija za ispis gresaka */
    function ispisiGresku(imePolja) {
      //let el = $(`#${imePolja}`);
      if (imePolja == "ime")
        ispisGreskeIspodInputa("greskaIme", "Prvo slovo velika!");
      if (imePolja == "prezime")
        ispisGreskeIspodInputa(
          "greskaPrezime",
          "Prvo slovo velika!"
        ) /* //console.log("Prva slova velika, najviše 3 reči!") */;
      if (imePolja == "email")
        ispisGreskeIspodInputa("greskaEmail", "Email nije u ispravnom formatu");
      if (imePolja == "kIme")
        ispisGreskeIspodInputa(
          "greskaKIme",
          "Korisnicko ime nije u ispravnom formatu"
        );
      if (imePolja == "sifra")
        ispisGreskeIspodInputa("greskaSifra", "Format sifre nije ispravan");
    }
    /* Ispis greske ispod inputa */
    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }
    function proveriIme(ime) {
      let uzorakIme = /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}$/;
      if (uzorakIme.test(ime)) return true;
      else return false;
    }
    /* Funkcija za ispitivanje unosa korisnickog imena */
    function proveriKorisnickoIme(kIme) {
      let uzorakKIme = /^[A-ZČĆŠĐŽa-zčćšđž0-9_-]{1,20}$/;
      if (uzorakKIme.test(kIme)) return true;
      else return false;
    }

    /* Funkcija za ispitivanje unosa passworda */
    function proveriPassword(sifra) {
      let uzorakPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
      if (uzorakPass.test(sifra)) return true;
      else return false;
    }

    $("#btnRegistrovanje").on("click", (e) => {
      e.preventDefault();
      registrujKorisnika();
    });
  } else if (url === "?page=login") {
    //console.log(url);
    /* Funkcija za proveru logovanje korisnika */
    function ulogujKorisnika() {
      let kImeIliMail = $("#imeIliMail").val();
      proveriKorisnickoImeIliMail(kImeIliMail)
        ? $("#greskaImeIliMail").hide()
        : ispisiGresku("imeIliMail");

      let sifra = $("#sifra").val();
      proveriPassword(sifra) ? $("#greskaSifra").hide() : ispisiGresku("sifra");

      if (proveriKorisnickoImeIliMail(kImeIliMail) && proveriPassword(sifra)) {
        let zaSlanje = {
          kImeIliMail: $("#imeIliMail").val(),
          sifra: $("#sifra").val(),
        };
        ajaxZaSlanje(
          "models/logovanje.php",
          "post",
          zaSlanje,
          function (result) {
            if (result.obj) modal("Uspešno ste se ulogovali", "");
            if (result.obj.naziv == "admin") {
              setTimeout(() => {
                window.location.href = "index.php?page=admin-panel";
              }, 2000);
            } else {
              setTimeout(() => {
                window.location.href = "index.php?page=pocetna";
              }, 2000);
            }
          },
          function (xhr, error) {
            //console.log(error);
            //console.log(xhr.status);
            //console.log(xhr.responseText.obj);
            //console.log(xhr);
            if (xhr.status == 500) {
              modal("Greska na serveru molimo pokusajte kasnije!", "");
            } else if (xhr.status == 409) {
              modal("Nalog nije verifikovan!", "");
            } else if (xhr.status == 400) {
              modal(
                "Ne postoji korisnik sa unetim podacima, proverite unete podatke!",
                ""
              );
            }
          }
        );
        $("#imeIliMail").val("");
        $("#sifra").val("");
      }
    }
    /* Funkcija za ispis gresaka */
    function ispisiGresku(imePolja) {
      if (imePolja == "imeIliMail")
        ispisGreskeIspodInputa(
          "greskaImeIliMail",
          "Email ili korisnicko ime nije ispravno"
        );
      if (imePolja == "sifra")
        ispisGreskeIspodInputa("greskaSifra", "Format sifre nije ispravan");
    }
    /* Ispis greske ispod inputa */
    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }
    /* Funkcija za ispitivanje unosa korisnickog imena */
    function proveriKorisnickoImeIliMail(kImeIliMail) {
      let uzorakKImeIliMail =
        /^([\w-.]+@([\w-]+.)+[\w-]{2,4})|([A-ZČĆŠĐŽa-zčćšđž0-9_-\S]{1,20})$/;
      if (uzorakKImeIliMail.test(kImeIliMail)) return true;
      else return false;
    }

    /* Funkcija za ispitivanje unosa passworda */
    function proveriPassword(sifra) {
      let uzorakPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
      if (uzorakPass.test(sifra)) return true;
      else return false;
    }

    $("#btnLogovanje").on("click", (e) => {
      e.preventDefault();
      ulogujKorisnika();
    });
  } else if (urlSaParametrom === "?page=admin-modifikovanje") {
    /* Funkcija za proveru izmene korisnika */
    let idK = url.substr(url.indexOf("&") + 5, url.length);
    let uloga_id, status;
    function uloga() {
      if ($("#uloga").val() == "admin") {
        uloga_id = 1;
      } else {
        uloga_id = 2;
      }
    }
    function statusKorisinika() {
      if ($("#status").val() == "aktivan") {
        status = 1;
      } else {
        status = 0;
      }
    }
    uloga();
    statusKorisinika();
    $("#uloga").on("change", () => {
      uloga();
    });
    $("#status").on("change", () => {
      statusKorisinika();
    });
    function izmeniKorisnika() {
      let ime = $("#ime").val();
      proveriIme(ime) ? $("#greskaIme").hide() : ispisiGresku("ime");

      let prezime = $("#prezime").val();
      proveriIme(prezime)
        ? $("#greskaPrezime").hide()
        : ispisiGresku("prezime");

      let email = $("#email").val();
      proveraEmail(email) ? $("#greskaEmail").hide() : ispisiGresku("email");

      let kIme = $("#kIme").val();
      proveriKorisnickoIme(kIme)
        ? $("#greskaKIme").hide()
        : ispisiGresku("kIme");

      if (
        proveriIme(ime) &&
        proveriIme(prezime) &&
        proveraEmail(email) &&
        proveriKorisnickoIme(kIme)
      ) {
        let zaSlanje = {
          ime: $("#ime").val(),
          prezime: $("#prezime").val(),
          email: $("#email").val(),
          korisnickoIme: $("#kIme").val(),
          uloga_id: uloga_id,
          status: status,
          idK: idK,
        };
        ajaxZaSlanje(
          "models/izmena.php",
          "post",
          zaSlanje,
          function (rezultat) {
            //console.log(rezultat);
            modal("Uspešno ste izmenili podatke korisnika!", "");
            setTimeout(() => {
              window.location.href = "index.php?page=admin-panel";
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            //console.log(xhr.responseText);
            //console.log(xhr);
            if (xhr.status == 409) {
              modal("Korisnik sa tom e-mail adresom vec postoji", "");
            } else if (xhr.status == 408) {
              modal("Korisnik sa tim korisnickim imenom vec postoji", "");
            } else if (xhr.status == 404) {
              //console.log("Stranica nije pronadjena");
            } else {
              modal("Doslo je do greske, niste uspeli da se registrujete", "");
            }
          }
        );
      }
    }
    /* Funkcija za ispis gresaka */
    function ispisiGresku(imePolja) {
      //let el = $(`#${imePolja}`);
      if (imePolja == "ime")
        ispisGreskeIspodInputa("greskaIme", "Prvo slovo veliko, bez razmaka!");
      if (imePolja == "prezime")
        ispisGreskeIspodInputa(
          "greskaPrezime",
          "Prvo slovo veliko, bez razmaka!"
        ) /* //console.log("Prva slova velika, najviše 3 reči!") */;
      if (imePolja == "email")
        ispisGreskeIspodInputa("greskaEmail", "Email nije u ispravnom formatu");
      if (imePolja == "kIme")
        ispisGreskeIspodInputa(
          "greskaKIme",
          "Korisnicko ime nije u ispravnom formatu"
        );
      if (imePolja == "sifra")
        ispisGreskeIspodInputa("greskaSifra", "Format sifre nije ispravan");
    }
    /* Ispis greske ispod inputa */
    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }
    function proveriIme(ime) {
      let uzorakIme = /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}$/;
      if (uzorakIme.test(ime)) return true;
      else return false;
    }
    /* Funkcija za ispitivanje unosa korisnickog imena */
    function proveriKorisnickoIme(kIme) {
      let uzorakKIme = /^[A-ZČĆŠĐŽa-zčćšđž0-9_-]{1,20}$/;
      if (uzorakKIme.test(kIme)) return true;
      else return false;
    }

    $("#btnIzmeni").on("click", (e) => {
      e.preventDefault();
      izmeniKorisnika();
    });

    $("#btnObrisi").on("click", (e) => {
      e.preventDefault();
      let zaSlanje = {
        idK: idK,
      };
      ajaxZaSlanje(
        "models/brisanje.php",
        "post",
        zaSlanje,
        function (rezultat) {
          //console.log(rezultat);
          modal("Uspešno ste obrisali korisnika!", "");
          setTimeout(() => {
            window.location.href = "index.php?page=admin-panel";
          }, 2000);
        },
        function (xhr) {
          //console.log(xhr.status);
          //console.log(xhr.responseText);
          //console.log(xhr);
          modal("Doslo je do greske, niste uspeli da obrisete korisnika", "");
        }
      );
    });
  } else if (url === "?page=admin-dodaj-proizvod") {
    //Dodavanje proizovoda
    function dodajProizvodUBazu() {
      let naslov = $("#naslovProizvoda").val();
      proveriNazivProizvoda(naslov)
        ? $("#greskaNaslov").hide()
        : ispisiGresku("naslovProizvoda");

      let kratakOpis = $("#kOpis").val();
      proveriKratkuDeskripcijuProizvoda(kratakOpis)
        ? $("#greskaKOpis").hide()
        : ispisiGresku("kOpis");

      let dugacakOpis = $("#dOpis").val();
      proveriKratkuDeskripcijuProizvoda(dugacakOpis)
        ? $("#greskaDOpis").hide()
        : ispisiGresku("dOpis");

      let tezina = $("#tezina").val();
      proveriTezinuProizvoda(tezina)
        ? $("#greskaTezina").hide()
        : ispisiGresku("tezina");

      let cena = $("#cenaProizvoda").val();
      proveriCenuProizvoda(cena)
        ? $("#greskaCena").hide()
        : ispisiGresku("cena");

      if (
        proveriNazivProizvoda(naslov) &&
        proveriKratkuDeskripcijuProizvoda(kratakOpis) &&
        proveriDuzuDeskripcijuProizvoda(dugacakOpis) &&
        proveriTezinuProizvoda(tezina) &&
        proveriCenuProizvoda(cena)
      ) {
        var fd = new FormData();
        var sveSlike = document.getElementById("fileSlika").files.length;
        for (var i = 0; i < sveSlike; i++)
          fd.append("slike[]", document.getElementById("fileSlika").files[i]);
        //console.log(typeof fd);
        let zaSlanje = {
          naslovProizvoda: $("#naslovProizvoda").val(),
          id_kategorija: $("#ddlKategorija").val(),
          id_boja: $("#ddlBoja").val(),
          id_velicina: $("#ddlVelicina").val(),
          tezina: $("#tezina").val(),
          cena: $("#cenaProizvoda").val(),
          stanje: $("input[name='stanje']:checked").val(),
          kraciOpis: $("#kOpis").val(),
          duziOpis: $("#dOpis").val(),
        };
        ajaxZaSlanje(
          "models/dodavanjeProizvoda.php",
          "post",
          zaSlanje,
          function (rezultat) {
            modal("Uspešno ste dodali proizvod!", "");
            $.ajax({
              url: "models/dodavanjeSlike.php",
              method: "POST",
              datatype: "json",
              data: fd,
              contentType: false,
              processData: false,
              success: function (data) {
                //console.log("uspesno poslata slika");
                //console.log(data);
              },
              error: function (err) {
                //console.log("nije uspela da se posalje slika");
                //console.log(err);
              },
            });
            setTimeout(() => {
              window.location.href = "index.php?page=admin-proizvodi";
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            //console.log(xhr.responseText);
            //console.log(xhr);
            if (xhr.status == 409) {
              modal("Postoji proizvod sa tim naslovom", "");
            } else if (xhr.status == 404) {
              //console.log("Stranica nije pronadjena");
            } else {
              modal("Doslo je do greske, niste uspeli da se registrujete", "");
            }
          }
        );
      }
    }

    function ispisiGresku(imePolja) {
      //let el = $(`#${imePolja}`);
      if (imePolja == "naslovProizvoda")
        ispisGreskeIspodInputa(
          "greskaNaslov",
          "Prvo slovo veliko, ostalo po zelji"
        );

      if (imePolja == "kOpis")
        ispisGreskeIspodInputa(
          "greskaKOpis",
          "Maximalna duzina opisa je 255 karaktera!"
        );

      if (imePolja == "dOpis")
        ispisGreskeIspodInputa(
          "greskaDOpis",
          "Maximalna duzina opisa je 10000 karaktera!"
        );

      if (imePolja == "tezina")
        ispisGreskeIspodInputa(
          "greskaTezina",
          "Najveca dozvoljena tezina je 10kg!"
        );

      if (imePolja == "cena")
        ispisGreskeIspodInputa(
          "greskaCena",
          "Niste uneli ispravnu vrednost za cenu!"
        );
    }

    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }

    //Funkcija za proveru naziva proizvoda
    function proveriNazivProizvoda(naziv) {
      let uzorakNaziv =
        /^[A-ZČĆŠĐŽa-zčćšđž]{1,15}(\s[A-ZČĆŠĐŽa-zčćšđž0-9\-]{1,15})+$/;
      if (uzorakNaziv.test(naziv)) return true;
      else return false;
    }

    //Funkcija za proveru kratke deskripcije proizvoda
    function proveriKratkuDeskripcijuProizvoda(naziv) {
      let uzorakNaziv = /^.{1,999}$/;
      if (uzorakNaziv.test(naziv)) return true;
      else return false;
    }

    //Funkcija za proveru duge deskripcije proizvoda
    function proveriDuzuDeskripcijuProizvoda(naziv) {
      let uzorakNaziv = /^.{1,99999}$/;
      if (uzorakNaziv.test(naziv)) return true;
      else return false;
    }

    //Funkcija za proveru tezine proizvoda
    function proveriTezinuProizvoda(tezina) {
      tezina = parseFloat(tezina);
      if (tezina < 11 && typeof tezina == "number" && isNaN(tezina) == false)
        return true;
      else return false;
    }

    function proveriCenuProizvoda(cena) {
      cena = parseFloat(cena);
      if (typeof cena == "number" && isNaN(cena) == false) return true;
      else return false;
    }

    $("#btnDodaj").on("click", (e) => {
      e.preventDefault();
      dodajProizvodUBazu();
    });
  } else if (url === "?page=admin-dodaj-anketu") {
    //Dodavanje ankete
    function dodajAnketu() {
      let naslov = $("#naslov").val();
      proveriNaslovAnketeITekstPitanja(naslov)
        ? $("#greskaNaslov").hide()
        : ispisiGresku("naslov");

      let prvoPitanje = $("#prvoPitanje").val();
      proveriNaslovAnketeITekstPitanja(prvoPitanje)
        ? $("#greskaPrvoPitanje").hide()
        : ispisiGresku("prvoPitanje");

      let prviOdgovor = $("#prviOdgovor").val();
      proveriNaslovAnketeITekstPitanja(prviOdgovor)
        ? $("#greskaPrviOdgovor").hide()
        : ispisiGresku("prviOdgovor");

      let drugiOdgovor = $("#drugiOdgovor").val();
      proveriNaslovAnketeITekstPitanja(drugiOdgovor)
        ? $("#greskaDrugiOdgovor").hide()
        : ispisiGresku("drugiOdgovor");

      let treciOdgovor = $("#treciOdgovor").val();
      proveriNaslovAnketeITekstPitanja(treciOdgovor)
        ? $("#greskaTreciOdgovor").hide()
        : ispisiGresku("treciOdgovor");

      if (
        proveriNaslovAnketeITekstPitanja(naslov) &&
        proveriNaslovAnketeITekstPitanja(prvoPitanje) &&
        proveriNaslovAnketeITekstPitanja(prviOdgovor) &&
        proveriNaslovAnketeITekstPitanja(drugiOdgovor) &&
        proveriNaslovAnketeITekstPitanja(treciOdgovor)
      ) {
        let zaSlanje = {
          naslov: $("#naslov").val(),
          pitanje: $("#prvoPitanje").val(),
          prviOdgovor: $("#prviOdgovor").val(),
          drugiOdgovor: $("#drugiOdgovor").val(),
          treciOdgovor: $("#treciOdgovor").val(),
        };
        ajaxZaSlanje(
          "models/dodavanjeAnketa.php",
          "post",
          zaSlanje,
          function (rezultat) {
            modal("Uspešno ste dodali anketu!", "");
            setTimeout(() => {
              window.location.href = "index.php?page=admin-ankete";
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            //console.log(xhr.responseText);
            //console.log(xhr);
            if (xhr.status == 409) {
              modal("Postoji anketa sa tim naslovom", "");
            } else if (xhr.status == 404) {
              //console.log("Stranica nije pronadjena");
            } else {
              modal("Doslo je do greske", "");
            }
          }
        );
      }
    }

    function ispisiGresku(imePolja) {
      //let el = $(`#${imePolja}`);
      if (imePolja == "naslov")
        ispisGreskeIspodInputa("greskaNaslov", "Prvo slovo veliko");

      if (imePolja == "prvoPitanje")
        ispisGreskeIspodInputa("greskaPrvoPitanje", "Prvo slovo veliko");

      if (imePolja == "prviOdgovor")
        ispisGreskeIspodInputa("greskaPrviOdgovor", "Prvo slovo veliko");

      if (imePolja == "drugiOdgovor")
        ispisGreskeIspodInputa("greskaDrugiOdgovor", "Prvo slovo veliko");

      if (imePolja == "treciOdgovor")
        ispisGreskeIspodInputa("greskaTreciOdgovor", "Prvo slovo veliko");
    }

    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }

    //Funkcija za proveru naziva proizvoda
    function proveriNaslovAnketeITekstPitanja(naziv) {
      let uzorakNaziv =
        /^[A-ZČĆŠĐŽ][a-zčćšđž\-\?]+(\s[A-ZČĆŠĐŽa-zčćšđž0-9\-\?]+)*$/;
      if (uzorakNaziv.test(naziv)) return true;
      else return false;
    }
    $("#btnDodaj").on("click", (e) => {
      e.preventDefault();
      dodajAnketu();
    });
  } else if (url === "?page=poruke") {
    //Slanje poruke adminu
    function posaljiPoruku() {
      let naslov = $("#naslov").val();
      proveriNazivProizvoda(naslov)
        ? $("#greskaNaslov").hide()
        : ispisiGresku("naslov");

      let textPoruke = $("#tPoruke").val();
      proveriTextPoruke(textPoruke)
        ? $("#greskaText").hide()
        : ispisiGresku("textPoruke");

      if (proveriNazivProizvoda(naslov) && proveriTextPoruke(textPoruke)) {
        let zaSlanje = {
          naslov: $("#naslov").val(),
          textPoruke: $("#tPoruke").val(),
        };
        ajaxZaSlanje(
          "models/porukeZaAdmina.php",
          "post",
          zaSlanje,
          function (rezultat) {
            modal("Uspešno ste poslali poruku!", "");
            setTimeout(() => {
              window.location.href = "index.php?page=pocetna";
            }, 2000);
          },
          function (xhr) {
            //console.log(xhr.status);
            //console.log(xhr.responseText);
            //console.log(xhr);
            modal("Doslo je do greske na serveru molimo pokušajte kasnije", "");
          }
        );
      }
    }

    function ispisiGresku(imePolja) {
      //let el = $(`#${imePolja}`);
      if (imePolja == "naslov")
        ispisGreskeIspodInputa("greskaNaslov", "Prvo slovo veliko");

      if (imePolja == "textPoruke")
        ispisGreskeIspodInputa(
          "greskaText",
          "Premašili ste maksimalnu dužinu poruke!"
        );
    }

    function ispisGreskeIspodInputa(id, greska) {
      $(`#${id}`).html(greska);
      $(`#${id}`).show();
    }

    //Funkcija za proveru naziva proizvoda
    function proveriNazivProizvoda(naziv) {
      let uzorakNaziv =
        /^[A-ZČĆŠĐŽ][a-zčćšđž]{1,15}(\s[A-ZČĆŠĐŽa-zčćšđž0-9\-]{1,15})*$/;
      if (uzorakNaziv.test(naziv)) return true;
      else return false;
    }

    //Funkcija za proveru duge deskripcije proizvoda
    function proveriTextPoruke(naziv) {
      let uzorakNaziv = /^.{1,999}$/;
      if (uzorakNaziv.test(naziv)) return true;
      else return false;
    }

    $("#btnPoruke").on("click", (e) => {
      e.preventDefault();
      posaljiPoruku();
    });
  } else if (url === "?page=admin-poruke") {
  } else if (url === "?page=ankete") {
  } else if (url === "?page=kontakt") {
    /*Kontakt stranica */
  }
  //Kraj ifova------------------------------
  ispisBrojaStavkiKorpe();

  $("#dugmeZaDodavanjeViseStavki").on("click", () => {
    dugmeDodajUKorpu(pomId);
  });

  //Funkcije za div ponistavanje filtera
  function vidljivPonistiFiltere() {
    $("#ponistiFiltere").removeClass("invisible");
    $("#ponistiFiltere").addClass("visible");
  }
  function nevidljivPonistiFiltere() {
    $("#ponistiFiltere").removeClass("visible");
    $("#ponistiFiltere").addClass("invisible");
  }
  //Funkcija za proveru cekiranih elemenata i restarovanje polja
  function proveraCekiranih(name) {
    //Funkcija za pro
    $(name).change(() => {
      if ($(name).is(":checked")) {
        vidljivPonistiFiltere();
      } else {
        nevidljivPonistiFiltere();
      }
    });

    $("input[name=ALL]").change(function () {
      if ($("input[name=ALL]").is(":checked")) {
        dohvatiSveIzBaze(function (niz) {
          ispisProdukta(niz, "product", 4, 6, 6);
        });
        nevidljivPonistiFiltere();
        $("input[name=ALL]").prop("checked", false);
      }
      $(name).prop("checked", false);
      $("#minamount").val(100 + " RSD");
      $("#maxamount").val(1000 + " RSD");
      initializePriceSlider();
      $("#poljeZaPretragu").val("");
      $("input[name=ALL]").prop("checked");
    });
  }
  // PHP DEO KODA----------------------------------------------------------------------------------------------
  function podaciZaIspisivanjeProizvoda() {
    let kategorije = cekiraneKategorije();
    let data = {
      kategorije: cekiraneKategorije(),
    };
    ajaxZaSlanje(
      "models/functions.php",
      "POST",
      data,
      function (result) {
        //console.log("Poslato");
      },
      function (xhr) {
        //console.log(xhr.status);
      }
    );
  }

  $(".kategorije").on("change", podaciZaIspisivanjeProizvoda);

  function cekiraneKategorije() {
    let nizSelektovanih = [];
    for (let i = 0; i < $(".kategorije:checked").length; i++) {
      nizSelektovanih.push(parseInt($(".kategorije:checked")[i].value));
    }
    //console.log(nizSelektovanih.toString());
    return nizSelektovanih.toString();
  }
});

//Kraj window.onload
var brStavki;
function dodajItemULocalStorage(ime, podatak) {
  localStorage.setItem(ime, JSON.stringify(podatak));
}

function uzmiItemIzLocalStorage(ime) {
  return JSON.parse(localStorage.getItem(ime));
}

function ispisBrojaStavkiKorpe() {
  let brojPodataka = uzmiItemIzLocalStorage("proizvodiKorpa");
  if (brojPodataka == null) {
    $("#korpicaBroj").addClass("invisible");
    $("#korpicaBroj2").addClass("invisible");
  } else {
    $("#korpicaBroj").removeClass("invisible");
    $("#korpicaBroj2").removeClass("invisible");
    $("#korpicaBroj").addClass("visible");
    $("#korpicaBroj2").addClass("visible");

    $("#korpicaBroj").html(brojPodataka.length);
    $("#korpicaBroj2").html(brojPodataka.length);
  }
}

let proizvodiUnutarKorpe = [];
function dodajProizvodKorpa(id, brojStavki) {
  if (brojStavki == undefined) brojStavki = 1;

  if (!localStorage.getItem("proizvodiKorpa")) {
    dodajPrviProizvod(id);
  } else {
    let korpa = uzmiItemIzLocalStorage("proizvodiKorpa");
    let xd = korpa.find((x) => x.id == id);
    if (!xd) {
      dodajNoviProizvod(id);
    } else {
      uvecajKolicinu(id);
    }
  }
  ispisBrojaStavkiKorpe();

  /* Funkcija koja dodaje prvi proizvod u korpu koja je prazna */
  function dodajPrviProizvod(idProduct) {
    let zaKorpu = {
      id: idProduct,
      kolicina: brojStavki,
    };
    proizvodiUnutarKorpe.push(zaKorpu);
    dodajItemULocalStorage("proizvodiKorpa", proizvodiUnutarKorpe);
  }

  /* Funkcija za dodavanje proizvoda u korpu koji trenutno nije u korpi */
  function dodajNoviProizvod(idProduct) {
    let zaKorpu = {
      id: idProduct,
      kolicina: brojStavki,
    };
    let korpa = uzmiItemIzLocalStorage("proizvodiKorpa");
    korpa.push(zaKorpu);
    dodajItemULocalStorage("proizvodiKorpa", korpa);
  }

  /* Funkcija za povecavanje kolicine proizvoda koji je vec u korpi */
  function uvecajKolicinu(idProduct) {
    let korpa = uzmiItemIzLocalStorage("proizvodiKorpa");
    let xd = korpa.find((x) => x.id == idProduct);
    korpa.filter((x) => x.id != idProduct);
    xd.kolicina += parseInt(brojStavki);
    dodajItemULocalStorage("proizvodiKorpa", korpa);
  }
}

/* Funkcija za dodoavanje vise elemenata u korpu sa stranice shop-details.html */

function dugmeDodajUKorpu(id) {
  brStavki = parseInt($("#poljeZaKolicinu").val());
  dodajProizvodKorpa(id, brStavki);
}
//Funkcija za ispis ukupne sume proizvoda
function ukupnaCenaProizvoda() {
  let korpa = uzmiItemIzLocalStorage("proizvodiKorpa");
  let ukupno = 0;
  /* //console.log(nizProizvodi); */
  if (korpa != null) {
    for (k of korpa) {
      for (p of bazdniProizvodi) {
        if (k.id == p.id) {
          ukupno += k.kolicina * p.price;
          ////console.log(ukupno);
        }
      }
    }
    $(".ukupnaCena").html(parseFloat(ukupno).toFixed(2) + " RSD");
  } else {
    $(".ukupnaCena").html(parseFloat(ukupno).toFixed(2) + " RSD");
  }
}

/* Povecaj broj kolicine */
function povecaj(id) {
  let broj = parseInt($(`#text${id}`).val());
  broj += 1;
  $(`#text${id}`).val(broj);
  let cena = parseFloat($(`#cenaJednogKomada${id}`).html());
  let suma = cena * broj;
  $(`#ukupnaCena${id}`).html(parseFloat(suma).toFixed(2));
  ////console.log(broj, cena, suma);
}
/* Smanji broj kolicine */
function smanji(id) {
  let broj = parseInt($(`#text${id}`).val());
  if (broj != 1) {
    broj -= 1;
    $(`#text${id}`).val(broj);
    let cena = parseFloat($(`#cenaJednogKomada${id}`).html()).toFixed(2);
    let suma = cena * broj;
    $(`#ukupnaCena${id}`).html(parseFloat(suma).toFixed(2));
    ////console.log(broj, cena, suma);
  }
}

/* Funkcija za ispis broja stavki korpe i ukupnog iznosa racuna korpe */
function izdracunajPodatkeRacuna() {
  let korpa = uzmiItemIzLocalStorage("proizvodiKorpa");
  let divovi = $(".glavniDiv .shopingcarttotal");
  let suma = 0;
  for (let i = 0; i < divovi.length; i++) {
    suma += parseInt(divovi[i].textContent);
  }
  $("#ukupanBrojProizvoda").html(korpa.length);
  $("#ukupnaCenaRacuna").html(suma);
}
/* Osvezavanje cele korpe */
function osveziKorpu() {
  let inputi = $(".counterInput");
  ////console.log(inputi);
  let objekti = [];
  for (let i = 0; i < inputi.length; i++) {
    objekti.push({
      id: parseInt(inputi[i].id.substr(4, inputi[i].id.length)),
      kolicina: parseInt(inputi[i].value),
    });
    ////console.log(inputi[i].id.substr(4, inputi[i].id.length), inputi[i].value);
  }
  dodajItemULocalStorage("proizvodiKorpa", objekti);
  izdracunajPodatkeRacuna();
}
/* Funkcija za izbacivanje proizvoda iz korpe */
function izbaciIzKorpe(id) {
  let obrisi = $(`#divJedanRedKorpa${id}`);
  obrisi.remove();
  osveziKorpu();
  ispisBrojaStavkiKorpe();
}

/* Funkcije za modal */
var keys = { 37: 1, 38: 1, 39: 1, 40: 1 };

function preventDefault(e) {
  e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
    preventDefault(e);
    return false;
  }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
  window.addEventListener(
    "test",
    null,
    Object.defineProperty({}, "passive", {
      get: function () {
        supportsPassive = true;
      },
    })
  );
} catch (e) {}
var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent =
  "onwheel" in document.createElement("div") ? "wheel" : "mousewheel";

/* Funkcija za disableovanje skrola */
function disableScroll() {
  window.addEventListener("DOMMouseScroll", preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener("touchmove", preventDefault, wheelOpt); // mobile
  window.addEventListener("keydown", preventDefaultForScrollKeys, false);
}
/* Funkcija za enableovanje skrola */
function enableScroll() {
  window.removeEventListener("DOMMouseScroll", preventDefault, false);
  window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
  window.removeEventListener("touchmove", preventDefault, wheelOpt);
  window.removeEventListener("keydown", preventDefaultForScrollKeys, false);
}
/* Pravljenje modala */

function modal(naslovModala, tekst) {
  disableScroll();
  let glavniDiv = document.createElement("div");
  let centralniDiv = document.createElement("div");
  let naslov = document.createElement("h1");
  let p = document.createElement("p");

  naslov.innerHTML = naslovModala;

  p.innerHTML = tekst;

  glavniDiv.classList.add("glavniDivModal");
  centralniDiv.classList.add("centralniDivModal");
  naslov.classList.add("naslovModal");

  centralniDiv.appendChild(naslov);
  centralniDiv.appendChild(p);
  glavniDiv.appendChild(centralniDiv);
  document.body.appendChild(glavniDiv);

  setTimeout(() => {
    glavniDiv.classList.add("d-none");
    document.body.removeChild(glavniDiv);
    enableScroll();
  }, 1800);
}
/* Funkcija za ispitivanje unosa emaila */
function proveraEmail(email) {
  let uzorakEmail = /^[\w-.]+@([\w-]+.)+[\w-]{2,4}$/;
  if (uzorakEmail.test(email)) return true;
  else return false;
}

$("#newsletter").on("click", (e) => {
  e.preventDefault();
  let value = $("#inputNewsletter").val();
  //console.log(value);
  if (proveraEmail(value) == true && value != "") {
    modal("Obaveštenje", "Uspešno ste se prijavili na newsletter!");
    $("#inputNewsletter").val("");
  } else {
    modal("Obaveštenje", "E-mail nije u ispravnom formatu");
  }
});

function idPoruke(id) {
  //console.log(id);
  let zaSlanje = {
    idPitanja: id,
  };
  ajaxZaSlanje(
    "models/updatePitanje.php",
    "POST",
    zaSlanje,
    function (data) {
      //console.log(data);
      window.location.href = "index.php?page=admin-poruke";
    },
    function (xhr) {
      //console.log(xhr.status);
    }
  );
}

//Funkcija za slanje odgovora ankete
function odgovorAnkete(odgovor, id, idAnketa) {
  //console.log(idAnketa);
  let zaSlanje = {
    id: id,
    odgovor: odgovor,
    idAnketa: idAnketa,
  };
  ajaxZaSlanje(
    "models/odgovorAnkete.php",
    "POST",
    zaSlanje,
    function (data) {
      //console.log("Odg ste na anketu");
      /* modal("Uspeno ste verifikovali nalog!", "");
      setTimeout(() => {
        window.location.href = "index.php?page=login";
      }, 2000); */
      location.reload();
    },
    function (xhr) {
      //console.log(xhr.status);
      if (xhr.status == 409) {
        modal("Niste uneli ispravan verifikacioni kod!", "");
      } else if (xhr.status == 401) {
        modal("Morate prvo proci proces registracije!", "");
      } else {
        modal("Greska na serveru molimo pokusajte kasnije!", "");
      }
    }
  );
}

function promeniStatusAnkete(id, st) {
  let zaSlanje = {
    id: id,
    st: st,
  };
  ajaxZaSlanje(
    "models/admin-promeni-status-ankete.php",
    "POST",
    zaSlanje,
    function (data) {
      //console.log("Odg ste na anketu");
      modal("Uspeno ste promenili status ankete!", "");
      setTimeout(() => {
        location.reload();
      }, 1800);
    },
    function (xhr) {
      ////console.log(xhr.status);
      modal("Greska na serveru molimo pokusajte kasnije!", "");
    }
  );
}

//Brisanje proizvoda
function obrisiProizvod(id) {
  let zaSlanje = {
    id: id,
  };
  ajaxZaSlanje(
    "models/brisanje-proizvoda.php",
    "POST",
    zaSlanje,
    function (data) {
      //console.log("Obrisali ste proizvod");
      modal("Uspeno ste obrisali proizvod!", "");
      setTimeout(() => {
        location.reload();
      }, 1800);
    },
    function (xhr) {
      ////console.log(xhr.status);
      modal("Greska na serveru molimo pokusajte kasnije!", "");
    }
  );
}

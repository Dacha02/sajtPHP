  <!-- Hero Section Begin -->
  <section class="hero hero-normal">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="hero__categories">
            <div class="hero__categories__all">
              <i class="fa fa-bars"></i>
              <span>Svi odeljci</span>
            </div>
            <ul id="kategorijeMeni">
            </ul>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="hero__search">
            <div class="hero__search__form">
              <form action="#">
                <!-- <div class="hero__search__categories">
                    All Categories
                    <span class="arrow_carrot-down"></span>
                  </div> -->
                <input id="poljeZaPretraguIndex" type="text" placeholder="Unesite pojam za pretragu" />
                <a href="shop-grid.html">
                  <button id="btnPretragaIndex" type="button" class="site-btn">
                    PRETRAGA
                  </button></a>
              </form>
            </div>
            <div class="hero__search__phone">
              <div class="hero__search__phone__icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="hero__search__phone__text">
                <h5>+381 63 996 851</h5>
                <span>podrška 24/7 time</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>Checkout</h2>
            <div class="breadcrumb__option">
              <a href="./index.html">Početna</a>
              <span>Checkout</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Checkout Section Begin -->
  <section class="checkout spad">
    <div class="container">

      <div class="checkout__form">
        <h4>Podaci kupca</h4>
        <form action="#">
          <div class="row">
            <div class="col-lg-8 col-md-6">

              <div class="checkout__input">
                <p>Adresa<span>*</span></p>
                <span class="text-danger" id="greskaAdresa"></span>
                <input id="adresa" type="text" placeholder="Brace Grim 32" />
              </div>
              <div class="checkout__input">
                <p>Grad<span>*</span></p>
                <span class="text-danger" id="greskaGrad"></span>
                <input placeholder="Beograd" type="text" id="grad" />
              </div>
              <div class="checkout__input">
                <p>Poštanski broj<span>*</span></p>
                <span class="text-danger" id="greskaPostanskiBroj"></span>
                <input placeholder="11307" type="text" id="postanskiBroj" />
              </div>

            </div>
            <div class="col-lg-4 col-md-6">
              <div class="checkout__order">
                <h4>Vaša porudzbina</h4>
                <div class="checkout__order__products">
                  Proizvodi <span>Ukupno</span>
                </div>
                <ul id="porudzbina-stavke">
                  <!-- <li>Vegetable’s Package <span>$75.99</span></li>
                    <li>Fresh Vegetable <span>$151.99</span></li>
                    <li>Organic Bananas <span>$53.99</span></li> -->
                </ul>
                <div class="checkout__order__subtotal">
                  Dostava <span id="besplatno"></span>
                </div>
                <div class="checkout__order__total">
                  Ukupno <span id="ukupno"></span>
                </div>

                <button type="submit" class="site-btn" id="btnSlanjePorudzbine">
                  Pošalji porudzbinu
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Checkout Section End -->
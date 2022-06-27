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
          <h2>Korpa</h2>
          <div class="breadcrumb__option">
            <a href="./index.html">Početna</a>
            <span>Korpa</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center">
          <div>
            <h3 class="mb-5">Proizvodi u korpi</h3>
          </div>
          <div id="sadrzajKorpe"></div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="shoping__cart__btns">
          <a href="index.php?page=shop" class="primary-btn cart-btn">NASTAVI KUPOVINU</a>
          <a href="javascript:void(0);" onclick="osveziKorpu()" id="btnOsveziKorpu" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span> AŽURIRAJ KORPU</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="shoping__continue">

        </div>
      </div>
      <div class="col-lg-6" id="">
        <div class="shoping__checkout">
          <h5>Ukupno u korpi</h5>
          <ul id="subTotalKorpa">
            <li>Broj proizvoda <span>$454.98</span></li>
            <li>Ukupno <span>$454.98</span></li>
          </ul>
          <a href="index.php?page=checkout" id="btnNastaviDalje" name="btnNastaviDalje" class="primary-btn">Nastavi dalje</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shoping Cart Section End -->
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
            <?php
            echo padajucaListaKategorija();
            ?>
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
              <input id="poljeZaPretragu" type="text" placeholder="Unesite pojam za pretragu" />
              <button id="btnPretraga" type="submit" class="site-btn">
                PRETRAGA
              </button>
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
<?php
include "pages/breadcrumb.php";
?>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-5">
        <div class="sidebar">
          <div class="sidebar__item">
            <div id="ponistiFiltere" class="invisible">
              <input id="all" class="chkPonisti" type="checkbox" name="ALL" />
              <label class="kursor" for="all">Poništi sve filtere</label>
            </div>
            <h4>Kategorije</h4>
            <div id="">
              <?php echo (chkKategorije()); ?>
            </div>
          </div>
          <div class="sidebar__item">
            <h4>Cena</h4>
            <div class="price-range-wrap">
              <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="100" data-max="5000" id="linija">
                <div class="ui-slider-range ui-corner-all"></div>
                <span tabindex="0" id="levi" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" id="desni" class="ui-slider-handle ui-corner-all ui-state-default"></span>
              </div>
              <div id="sredina" class="range-slider">
                <div class="price-input">
                  <input type="text" id="minamount" />
                  <input type="text" id="maxamount" />
                </div>
              </div>
            </div>
          </div>
          <div class="sidebar__item sidebar__item__color--option">
            <h4>Boje</h4>
            <div id="">
              <?php
              echo (rbBoja());
              ?>
            </div>
            <!--<div class="sidebar__item__color sidebar__item__color--white">
                          <label for="white">
                            White
                            <input type="radio" id="white" />
                          </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--gray">
                          <label for="gray">
                            Gray
                            <input type="radio" id="gray" />
                          </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--red">
                          <label for="red">
                            Red
                            <input type="radio" id="red" />
                          </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--black">
                          <label for="black">
                            Black
                            <input type="radio" id="black" />
                          </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--blue">
                          <label for="blue">
                            Blue
                            <input type="radio" id="blue" />
                          </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--green">
                          <label for="green">
                            Green
                            <input type="radio" id="green" />
                          </label>
                        </div> -->
          </div>
          <div class="sidebar__item">
            <h4>Veličina</h4>
            <div id="">
              <?php
              echo (rbVelicina());
              ?>
            </div>
            <!-- <div class="sidebar__item__size">
                          <label for="large">
                            Large
                            <input type="radio" id="large" />
                          </label>
                        </div>
                        <div class="sidebar__item__size">
                          <label for="medium">
                            Medium
                            <input type="radio" id="medium" />
                          </label>
                        </div>
                        <div class="sidebar__item__size">
                          <label for="small">
                            Small
                            <input type="radio" id="small" />
                          </label>
                        </div>
                        <div class="sidebar__item__size">
                          <label for="tiny">
                            Tiny
                            <input type="radio" id="tiny" />
                          </label>
                        </div> -->
          </div>
          <div class="sidebar__item">
            <div class="latest-product__text">
              <h4>Najsvežije</h4>
              <div class="latest-product__slider owl-carousel" id="">
                <?php
                echo (najsvezijeSlider());
                ?>
                <!-- <div class="latest-prdouct__slider__item" id="najsvezije1">
                                  <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                      <img src="img/latest-product/lp-1.jpg" alt="" />
                                    </div>
                                    <div class="latest-product__item__text">
                                      <h6>Crab Pool Security</h6>
                                      <span>$30.00</span>
                                    </div>
                                  </a>
                                  <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                      <img src="img/latest-product/lp-2.jpg" alt="" />
                                    </div>
                                    <div class="latest-product__item__text">
                                      <h6>Crab Pool Security</h6>
                                      <span>$30.00</span>
                                    </div>
                                  </a>
                                  <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                      <img src="img/latest-product/lp-3.jpg" alt="" />
                                    </div>
                                    <div class="latest-product__item__text">
                                      <h6>Crab Pool Security</h6>
                                      <span>$30.00</span>
                                    </div>
                                  </a>
                                </div> -->
                <div class="latest-prdouct__slider__item" id="najsvezije2">
                  <!-- <a href="#" class="latest-product__item">
                                      <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="" />
                                      </div>
                                      <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                      </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                      <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="" />
                                      </div>
                                      <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                      </div>
                                    </a>
                                    <a href="#" class="latest-product__item">
                                      <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="" />
                                      </div>
                                      <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                      </div>
                                    </a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-7">
        <div class="product__discount">
          <div class="section-title product__discount__title">
            <h2>Na sniženju</h2>
          </div>
          <div class="row">
            <div class="product__discount__slider owl-carousel" id="">
              <?php
              echo sgSlider();
              ?>
              <!-- <div class="col-lg-4">
                              <div class="product__discount__item">
                                <div
                                  class="product__discount__item__pic set-bg"
                                  data-setbg="img/product/discount/pd-1.jpg"
                                >
                                  <div class="product__discount__percent">-20%</div>
                                  <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-retweet"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="product__discount__item__text">
                                  <span>Dried Fruit</span>
                                  <h5><a href="#">Raisin’n’nuts</a></h5>
                                  <div class="product__item__price">
                                    $30.00 <span>$36.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="product__discount__item">
                                <div
                                  class="product__discount__item__pic set-bg"
                                  data-setbg="img/product/discount/pd-2.jpg"
                                >
                                  <div class="product__discount__percent">-20%</div>
                                  <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-retweet"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="product__discount__item__text">
                                  <span>Vegetables</span>
                                  <h5><a href="#">Vegetables’package</a></h5>
                                  <div class="product__item__price">
                                    $30.00 <span>$36.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="product__discount__item">
                                <div
                                  class="product__discount__item__pic set-bg"
                                  data-setbg="img/product/discount/pd-3.jpg"
                                >
                                  <div class="product__discount__percent">-20%</div>
                                  <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-retweet"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="product__discount__item__text">
                                  <span>Dried Fruit</span>
                                  <h5><a href="#">Mixed Fruitss</a></h5>
                                  <div class="product__item__price">
                                    $30.00 <span>$36.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="product__discount__item">
                                <div
                                  class="product__discount__item__pic set-bg"
                                  data-setbg="img/product/discount/pd-4.jpg"
                                >
                                  <div class="product__discount__percent">-20%</div>
                                  <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-retweet"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="product__discount__item__text">
                                  <span>Dried Fruit</span>
                                  <h5><a href="#">Raisin’n’nuts</a></h5>
                                  <div class="product__item__price">
                                    $30.00 <span>$36.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="product__discount__item">
                                <div
                                  class="product__discount__item__pic set-bg"
                                  data-setbg="img/product/discount/pd-5.jpg"
                                >
                                  <div class="product__discount__percent">-20%</div>
                                  <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-retweet"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="product__discount__item__text">
                                  <span>Dried Fruit</span>
                                  <h5><a href="#">Raisin’n’nuts</a></h5>
                                  <div class="product__item__price">
                                    $30.00 <span>$36.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="product__discount__item">
                                <div
                                  class="product__discount__item__pic set-bg"
                                  data-setbg="img/product/discount/pd-6.jpg"
                                >
                                  <div class="product__discount__percent">-20%</div>
                                  <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-retweet"></i></a>
                                    </li>
                                    <li>
                                      <a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="product__discount__item__text">
                                  <span>Dried Fruit</span>
                                  <h5><a href="#">Raisin’n’nuts</a></h5>
                                  <div class="product__item__price">
                                    $30.00 <span>$36.00</span>
                                  </div>
                                </div>
                              </div>
                            </div> -->
            </div>
          </div>
        </div>
        <div class="filter__item">
          <div class="row">
            <div class="col-lg-4 col-md-5">
              <div class="filter__sort">
                <span>Sortiraj po</span>
                <select id="sort">
                  <option value="">Izaberite</option>
                  <option value="nazivRastuce">Nazivu A-Z</option>
                  <option value="nazivOpadajuce">Nazivu Z-A</option>
                  <option value="cenaRastuce">Ceni rastuće</option>
                  <option value="cenaOpadajuce">Ceni opadajuće</option>
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="filter__found">
                <h6>
                  <span id="kolicinaProizvoda"></span> Proizvoda prondajeno
                </h6>
              </div>
            </div>
            <div class="col-lg-4 col-md-3">
              <div class="filter__sort">
                <span>Prikaz:</span>
                <select id="prikazPoStrani">
                  <option value="2">12</option>
                  <option value="4">24</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="productProizvodi">
          <?php
          //echo istaknutiProizvodiIndex(4, 6, 6, "product", 0);
          ?>
          <!--<div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                         <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-1.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="">
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-3.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-4.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-5.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-6.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-7.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-8.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-9.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-10.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-11.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="product__item">
                        <div
                          class="product__item__pic set-bg"
                          data-setbg="img/product/product-12.jpg"
                        >
                          <ul class="product__item__pic__hover">
                            <li>
                              <a href="#"><i class="fa fa-heart"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-retweet"></i></a>
                            </li>
                            <li>
                              <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                          </ul>
                        </div>
                        <div class="product__item__text">
                          <h6><a href="#">Crab Pool Security</a></h6>
                          <h5>$30.00</h5>
                        </div>
                      </div>
                    </div> -->
        </div>
        <div class="product__pagination d-flex justify-content-center" id="product__pagination">

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Section End -->
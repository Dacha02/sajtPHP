<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Svi odeljci</span>
                    </div>
                    <ul>
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
                            <input id="poljeZaPretraguIndex" type="text" placeholder="Unesite pojam za pretragu" />
                            <a href="shop-grid.php">
                                <button id="btnPretragaIndex" type="button" class="site-btn">
                                    PRETRAGA
                                </button>
                            </a>
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
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span>UVEK SVEŽI PROIZVODI</span>
                        <h2>Sve <br />100% Organsko</h2>
                        <p>Besplatno preuzimanje i dostava</p>
                        <a href="shop-grid.php" class="primary-btn">KUPI SAD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php
                echo sliderKategorije();
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Istaknuti proizvodi</h2>
                </div>

            </div>
        </div>
        <div class="row featured__filter" id="">
            <?php
            echo istaknutiProizvodiIndex(3, 4, 6, 8);
            ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->
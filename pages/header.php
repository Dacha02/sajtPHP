<body>
  <!-- Page Preloder -->
  <!-- <div id="preloder">
      <div class="loader"></div>
    </div> -->

  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
      <a href="#"><img src="img/logo.png" alt="" /></a>
    </div>
    <div class="humberger__menu__cart">
      <!-- <ul>
          <li>
            <a href="#"
              ><i class="fa fa-shopping-cart"></i> <span id="korpicaBroj"></span
            ></a>
          </li>
        </ul> -->
      <!-- <div class="header__cart__price">
          ukupno: <span id="ukupnaCena2"></span>
        </div> -->
      <?php if (isset($_SESSION['korisnik'])) : ?>
        <div class="header__top__right__auth">
          <a href="models/odjava.php"><i class="fa fa-user"></i> Log out</a>
        </div>

      <?php elseif (!isset($_SESSION['korisnik'])) : ?>
        <div class="header__top__right__auth">
          <a href="index.php?page=login"><i class="fa fa-user"></i> Login</a>
        </div>
        <div class="header__top__right__auth">
          <a href="index.php?page=register">| Registracija</a>
        </div>
      <?php endif; ?>
    </div>
    <!-- <div class="humberger__menu__widget">
        <div class="header__top__right__language">
          <img src="img/language.png" alt="" />
          <div>English</div>
          <span class="arrow_carrot-down"></span>
          <ul>
            <li><a href="#">Spanis</a></li>
            <li><a href="#">English</a></li>
          </ul>
        </div>
        <div class="header__top__right__auth">
          <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
      </div> -->
    <nav class="humberger__menu__nav mobile-menu">
      <ul>
        <?php
        echo (obicanMeni());
        ?>
        <!-- <li class="active"><a href="./index.php">Početna</a></li>
        <li><a href="./shop-grid.php">Shop</a></li>
        <li>
          <a href="#">Autor</a> -->
        <!-- <ul class="header__menu__dropdown">
              <li><a href="./shop-details.php">Shop Details</a></li>
              <li><a href="./shoping-cart.php">Shoping Cart</a></li>
              <li><a href="./checkout.php">Check Out</a></li>
              <li><a href="./blog-details.php">Blog Details</a></li>
            </ul> -->
        </li>
        <!-- <li><a href="./blog.php">Blog</a></li> -->
        <!-- <li><a href="./contact.php">Kontakt</a></li> -->
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
      <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
      <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
      <a href="https://www.linkedin.com/feed/"><i class="fa fa-linkedin"></i></a>
      <a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
      <ul>
        <li><i class="fa fa-envelope"></i> oganishop@gmail.com</li>
        <li>Besplatna dostava na kupovinu preko 3000 RSD</li>
      </ul>
    </div>
  </div>
  <!-- Humberger End -->

  <!-- Header Section Begin -->
  <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="header__top__left">
              <ul>
                <li><i class="fa fa-envelope"></i> oganishop@gmail.com</li>
                <li>Besplatna dostava na kupovinu preko 3000 RSD</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="header__top__right">
              <div class="header__top__right__social">
                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                <a href="https://www.linkedin.com/feed/"><i class="fa fa-linkedin"></i></a>
                <a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p"></i></a>
              </div>
              <!-- <div class="header__top__right__language">
                  <img src="img/language.png" alt="" />
                  <div>English</div>
                  <span class="arrow_carrot-down"></span>
                  <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                  </ul>
                </div> -->

              <?php if (isset($_SESSION['korisnik'])) : ?>
                <div class="header__top__right__auth">
                  <a href="models/odjava.php"><i class="fa fa-user"></i> Log out</a>
                </div>

              <?php elseif (!isset($_SESSION['korisnik'])) : ?>
                <div class="header__top__right__auth">
                  <a href="index.php?page=login"><i class="fa fa-user"></i> Login</a>
                </div>
                <div class="header__top__right__auth">
                  <a href="index.php?page=register">| Registracija</a>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="header__logo">
            <a href="./index.php"><img src="img/logo.png" alt="" /></a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="header__menu">
            <!--  <ul>
            <li><a href="./index.php">Home</a></li>
            <li class="active"><a href="./shop-grid.php">Shop</a></li>
            <li><a href="#">Pages</a>
              <ul class="header__menu__dropdown">
                <li><a href="./shop-details.php">Shop Details</a></li>
                <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                <li><a href="./checkout.php">Check Out</a></li>
                <li><a href="./blog-details.php">Blog Details</a></li>
              </ul>
            </li>
            <li><a href="./blog.php">Blog</a></li>
            <li><a href="./contact.php">Contact</a></li>
          </ul> -->
            <ul>
              <?php
              echo (obicanMeni());
              ?>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3">
          <div class="header__cart">
            <ul>
              <li>
                <a href="index.php?page=shoping-cart"><i class="fa fa-shopping-cart"></i>
                  <span id="korpicaBroj2"></span></a>
              </li>
            </ul>
            <div class="header__cart__price">
              ukupno: <span class="ukupnaCena">0.00 RSD</span>
            </div>
          </div>
        </div>
      </div>
      <div class="humberger__open">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <?php if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv == "admin") : ?>
    <div id="divIdMeni" class="bg-light p-2 container mb-4">
      <ul class="d-flex flex-column justify-content-around flex-wrap flex-sm-row text-center" id="adminMeni">
        <?php echo adminMeni(); ?>
      </ul>
    </div>
  <?php endif; ?>
  <!-- Header Section End -->
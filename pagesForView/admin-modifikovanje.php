<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-3">
        <h1 class="fs40">Podaci</h1>
    </div>
    <form class="d-flex flex-column col-12 col-md-6" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="checkout__input">
            <p>Ime</p>
            <input type="text" id="ime" value="<?php echo ($korisnik->ime); ?>" />
            <span class="text-danger" id="greskaIme"></span>
        </div>
        <div class="checkout__input">
            <p>Prezime</p>
            <input type="text" id="prezime" value="<?php echo ($korisnik->prezime); ?>" />
            <span class="text-danger" id="greskaPrezime"></span>
        </div>
        <div class="checkout__input">
            <p>Korisnicko ime</p>
            <input type="text" id="kIme" value="<?php echo ($korisnik->korisnicko_ime); ?>" />
            <span class="text-danger" id="greskaKIme"></span>
        </div>
        <div class="checkout__input">
            <p>Email</p>
            <input type="text" id="email" value="<?php echo ($korisnik->email); ?>" />
            <span class="text-danger" id="greskaEmail"></span>
        </div>
        <div class="checkout__input d-flex justify-content-around text-center">
            <div>
                <p>Uloga</p>
                <select name="uloga" id="uloga">
                    <?php if ($korisnik->naziv == "admin") : ?>
                        <option selected value="admin">Admin</option>
                        <option value="korisnik">Korisnik</option>
                    <?php else : ?>
                        <option value="admin">Admin</option>
                        <option selected value="korisnik">Korisnik</option>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <p>Status</p>
                <select name="status" id="status">
                    <?php if ($korisnik->statusAktivnosti == "1") : ?>
                        <option selected value="aktivan">Aktivan</option>
                        <option value="neaktivan">Neaktivan</option>
                    <?php else : ?>
                        <option value="aktivan">Aktivan</option>
                        <option selected value="neaktivan">Neaktivan</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="checkout__input">

        </div>
        <button type="submit" class="site-btn mb-3 bg-warning" id="btnIzmeni">
            Izmeni
        </button>
        <button type="submit" class="site-btn mb-3 bg-danger" id="btnObrisi">
            Obrisi
        </button>
    </form>
</div>
<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-3">
        <h1 class="fs40">Registruj se</h1>
    </div>
    <form class="d-flex flex-column col-12 col-md-6" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="checkout__input">
            <p>Ime<span>*</span></p>
            <input type="text" id="ime" placeholder="John" />
            <span class="text-danger" id="greskaIme"></span>
        </div>
        <div class="checkout__input">
            <p>Prezime<span>*</span></p>
            <input type="text" id="prezime" placeholder="Doe" />
            <span class="text-danger" id="greskaPrezime"></span>
        </div>
        <div class="checkout__input">
            <p>Korisnicko ime<span>*</span></p>
            <input type="text" id="kIme" placeholder="JDoe22" />
            <span class="text-danger" id="greskaKIme"></span>
        </div>
        <div class="checkout__input">
            <p>Email<span>*</span></p>
            <input type="text" id="email" placeholder="john.doe@gmail.com" />
            <span class="text-danger" id="greskaEmail"></span>
        </div>
        <div class="checkout__input">
            <p>Sifra<span>*</span></p>
            <input type="password" id="sifra" placeholder="Johndoe123" />
            <span class="text-danger" id="greskaSifra"></span>
        </div>
        <button type="submit" class="site-btn mb-3" id="btnRegistrovanje">
            Registrujte se
        </button>
    </form>
</div>
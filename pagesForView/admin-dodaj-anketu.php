<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-3">
        <h1 class="fs40">Sastavi anketu</h1>
    </div>
    <form class="d-flex flex-column col-12 col-md-6" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="checkout__input">
            <p>Naslov</p>
            <input type="text" id="naslov" />
            <span class="text-danger" id="greskaNaslov"></span>
        </div>
        <div class="checkout__input">
            <p>Pitanje</p>
            <input type="text" id="prvoPitanje" />
            <span class="text-danger" id="greskaPrvoPitanje"></span>
        </div>
        <div class="checkout__input">
            <p>Prvi ponudjeni odgovor</p>
            <input type="text" id="prviOdgovor" />
            <span class="text-danger" id="greskaPrviOdgovor"></span>
        </div>
        <div class=" checkout__input">
            <p>Drugi ponudjeni odgovor</p>
            <input type="text" id="drugiOdgovor" />
            <span class="text-danger" id="greskaDrugiOdgovor"></span>
        </div>
        <div class="checkout__input">
            <p>Treci ponudjeni odgovor</p>
            <input type="text" id="treciOdgovor" />
            <span class="text-danger" id="greskaTreciOdgovor"></span>
        </div>
        <button type="submit" class="site-btn mb-3" id="btnDodaj">
            Potvrdi
        </button>
    </form>
</div>
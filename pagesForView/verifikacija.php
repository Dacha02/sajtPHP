<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-5">
        <h1 class="fs40">Verifikacija</h1>
    </div>
    <form class="d-flex flex-column col-12 col-md-6 " method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="checkout__input">
            <p>Unesite kod<span>*</span></p>
            <input type="text" id="poljeKod" placeholder="123456" />
            <span class="text-danger" id="greskaPoljeKod"></span>
        </div>
        <button type="submit" class="site-btn my-5" id="btnVerifikuj">
            Potvrdi
        </button>
    </form>
</div>
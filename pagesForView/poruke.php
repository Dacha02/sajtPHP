<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-3">
        <h1 class="fs40">Pošalji poruku</h1>
    </div>
    <form class="d-flex flex-column col-12 col-md-6" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="checkout__input">
            <p>Naslov<span>*</span></p>
            <input type="text" id="naslov" />
            <span class="text-danger" id="greskaNaslov"></span>
        </div>
        <div class="checkout__input">
            <p>Tekst poruke</p>
            <textarea type="text" id="tPoruke"></textarea>
            <span class="text-danger" id="greskaText"></span>
        </div>
        <button type="submit" class="site-btn mb-3" id="btnPoruke">
            Pošalji poruku
        </button>
    </form>
</div>
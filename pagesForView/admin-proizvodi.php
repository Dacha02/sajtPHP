<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <div>
                        <h3 class="mb-5">Proizvodi</h3>
                        <a href="index.php?page=admin-dodaj-proizvod"><button type="submit" class="site-btn mb-3" id="btnDodajProizvod">
                                Dodaj proizvod
                            </button></a>
                    </div>
                    <?php
                    $proizvodi = ispisProizvoda();
                    foreach ($proizvodi as $p) :
                    ?>
                        <div id="divJedanRedKorpa<?php echo $p->id_korisnik ?>" class="glavniDiv d-flex flex-column justify-content-between align-items-center flex-md-row">
                            <div>
                                <img class="mb-2 malaSlika" src="img/skladistenjeSlika/<?php echo $p->src ?>" alt="${obj.img[0].naziv}" />
                            </div>
                            <div class="fix-duzina-naziv">
                                <h5 class="mb-2"><?php echo $p->naslov ?></h5>
                            </div>
                            <div class="fix-duzina-naziv">
                                <h5 class="mb-2"><?php echo $p->naslovKategorije ?></h5>
                            </div>
                            <div class="fix-duzina-naziv">
                                <h5 class="mb-2"><?php echo $p->naslovBoje ?></h5>
                            </div>
                            <div class="fix-duzina-naziv">
                                <h5 class="mb-2"><?php echo $p->naslovVelicine ?></h5>
                            </div>
                            <div class="fix-duzina-naziv">
                                <h5 class="mb-2"><?php echo $p->tezina ?> kg</h5>
                            </div>
                            <div class="fix-duzina-naziv">
                                <h5 class="mb-2"><?php echo $p->cena ?></h5>
                            </div>
                            <div class="shopingcartitem__close mb-2">
                                <span onclick="obrisiProizvod(<?php echo $p->id_proizvod ?>)" class="icon_close dugmeIzbrisi"></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <?php
    $id = $_SESSION['korisnik']->id_korisnik;
    $ankete = anketeKorisnika($id);
    if ($ankete) :
    ?>
        <div class="d-flex flex-column col-12 col-md-7 my-3">
            <h1 class="fs40">Dostupne ankete</h1>
        </div>
        <form class="d-flex flex-column col-12 col-md-6" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <?php
            foreach ($ankete as $a) :
            ?>
                <div class="mb-1">
                    <h4><?php echo $a->naslov ?></h4>
                    <p><?php echo $a->pitanje ?></p>
                    <div class="d-flex flex-column justify-content-around mb-3">
                        <div><input id="<?= $a->id_anketa ?>odgovorPrvi" type="radio" class="mr-2" name="<?= $a->id_anketa ?>odgovor" value="1" /><label for="<?= $a->id_anketa ?>odgovorPrvi"><?php echo $a->odgovor_prvi ?></label></div>
                        <div><input id="<?= $a->id_anketa ?>odgovorDrugi" type="radio" class="mr-2" name="<?= $a->id_anketa ?>odgovor" value="2" /><label for="<?= $a->id_anketa ?>odgovorDrugi"><?php echo $a->odgovor_drugi ?></label></div>
                        <div><input id="<?= $a->id_anketa ?>odgovorTreci" type="radio" class="mr-2" name="<?= $a->id_anketa ?>odgovor" value="3" /><label for="<?= $a->id_anketa ?>odgovorTreci"><?php echo $a->odgovor_treci ?></label></div>
                    </div>
                </div>
                <button type="submit" onclick="odgovorAnkete($('input[name=<?= $a->id_anketa ?>odgovor]:checked').val(),<?= $id ?>,<?= $a->id_anketa ?>); event.preventDefault()" class="site-btn mb-3 btnPosaljiAnketu" class="btnOdgAnketa">
                    Pošaslji odgovor
                </button>
            <?php endforeach;
        else :
            ?>
            <div class="d-flex flex-column col-12 col-md-7 m-4 text-center">
                <h1 class="fs40 m-4">Odgovorili ste na sve ankete</h1>
                <i class="fa fa-check-circle-o m-4 text-success fs-150" aria-hidden="true"></i>

            </div>
        <?php endif; ?>

        </form>
</div>
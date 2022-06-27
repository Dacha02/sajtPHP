<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-3">
        <?php
        $naslov = $anketa->naslov;
        $pitanje = $anketa->pitanje;
        $prviOdg = $anketa->odgovor_prvi;
        $drugiOdg = $anketa->odgovor_drugi;
        $treciOdg = $anketa->odgovor_treci;
        $statusAnkete = $anketa->statusAnkete;
        $brOdgovora = prebrojAnketeNaKojeJeOdgovoreno($anketa->id_anketa);
        $prviOdgBroj = prebrojOdgovore($anketa->id_anketa, 1);
        $drugiOdgBroj = prebrojOdgovore($anketa->id_anketa, 2);
        $treciOdgBroj = prebrojOdgovore($anketa->id_anketa, 3);
        $brOdgZaPrikaz = $brOdgovora->total;
        if ($brOdgovora->total == 0) {
            $brOdgovora->total = 1;
        }
        ?>


        <h2><?= $naslov ?></h2>
        <h3><?= $pitanje ?></h3>
        <p><?php echo ($prviOdg . ' ' . ((intval($prviOdgBroj->total) / intval($brOdgovora->total)) * 100) . '%');
            ?></p>
        <p><?php echo ($drugiOdg . ' ' . ((intval($drugiOdgBroj->total) / intval($brOdgovora->total)) * 100) . '%');
            ?></p>
        <p><?php echo ($treciOdg . ' ' . ((intval($treciOdgBroj->total) / intval($brOdgovora->total)) * 100) . '%');
            ?></p>
        <p><b>Broj odgovora: <?= $brOdgZaPrikaz ?></b></p>
        <?php if ($statusAnkete == 0) : ?>
            <button type="submit" onclick="promeniStatusAnkete(<?= $anketa->id_anketa ?>,0)" class="site-btn mb-3 w-25" id="btnAktiviraj">
                Aktiviraj
            </button>
        <?php else : ?>
            <button type="submit" onclick="promeniStatusAnkete(<?= $anketa->id_anketa ?>,1)" class="site-btn mb-3 w-25 bg-danger" id="btnDeaktivraj">
                Deaktiviraj
            </button>
        <?php endif; ?>
    </div>
</div>
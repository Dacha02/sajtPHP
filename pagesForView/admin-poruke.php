<div>
    <?php
    $rezultat = ispisPoruka();
    foreach ($rezultat as $r) :
        $idP = $r->id_pitanje;
        $imePrezime = $r->ImePrezime;
        $datum = $r->datum_pitanja;
        $naslov = $r->naslov;
        $tekst = $r->tekst;
        $statusProcitanosti = $r->statusProcitanosti;
    ?>
        <div class='container container-fluid border-bottom my-3 d-flex flex-column'>
            <div class='d-flex flex-row justify-content-between'>
                <span class='font-weight-bold mb-3'><?php echo $imePrezime ?></span>
                <span class='font-weight-bold'><?php echo $datum ?></span>
            </div>
            <div>
                <h3 class='font-weight-bold mb-3'><?php echo $naslov ?></h3>
            </div>
            <div>
                <p><?php echo $tekst ?></p>
            </div>
            <?php if ($statusProcitanosti == 1) : ?>
                <button type='submit' onclick='idPoruke(<?php echo $idP ?>)' class='site-btn mb-3 align-self-end bg-danger btnNeprocitano'>
                    Nepročitano
                </button>
            <?php else : ?>
                <button type='submit' class='site-btn mb-3 align-self-end' disabled id='btnProcitano'>
                    Pročitano
                </button>
            <?php endif; ?>


        </div>
    <?php endforeach; ?>
</div>
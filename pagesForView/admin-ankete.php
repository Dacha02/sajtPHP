<div class="container container-fluid d-flex flex-row justify-content-between flex-wrap spaceAdminPanel">
    <div class="col-12 d-flex flex-column justify-content-center align-items-center flex-wrap mb-5">
        <div class="col-6 card text-white mb-3 d-flex flex-row shadowBox" style="max-width: 18rem;">
            <!-- <div class="card-header">Header</div> -->
            <div class="p-2"><i class="fa fa-poll-h itag"></i></div>
            <div class="card-body">
                <h5 class="card-title text-secondary">Total Ankete</h5>
                <p class="card-text text-secondary"><b><?php echo prebrojAnkete() ?></b></p>
            </div>

        </div>
        <a href="index.php?page=admin-dodaj-anketu"><button type="submit" class="site-btn mb-3" id="btnDodajAnketu">
                Sastavi novu anketu
            </button></a>
    </div>
    <table class="table table-hover cursor text-center">
        <thead>
            <tr>
                <th scope="col">Redni broj</th>
                <th scope="col">Kreirao</th>
                <th scope="col">Naslov ankete</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rezultat = anketeMakeri();
            $br = 0;
            foreach ($rezultat as $r) :
            ?>
                <tr onclick="window.location='index.php?page=admin-pregled-ankete&aId=<?php echo $r->id_anketa ?>'">
                    <th scope="row"><?php echo $br = $br + 1;; ?></th>
                    <td><?php echo ($r->ImePrezime) ?></td>
                    <td><?php echo ($r->naslov) ?></td>
                    <td><?php if ($r->statusAnkete == 1) : ?>
                            <span class="text-success">Aktivna</span>
                        <?php else : ?>
                            <span class="text-danger">Neaktivna</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>
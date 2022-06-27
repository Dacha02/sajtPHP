<div class="container container-fluid d-flex flex-row justify-content-between flex-wrap spaceAdminPanel">
    <div class="col-12 d-flex flex-row justify-content-around flex-wrap mb-5 ">
        <div class="col-6 card text-white mb-3 d-flex flex-row shadowBox" style="max-width: 18rem;">
            <!-- <div class="card-header">Header</div> -->
            <div class="p-2"><i class="fa fa-user itag"></i></div>
            <div class="card-body">
                <h5 class="card-title text-secondary">Total Admin</h5>
                <p class="card-text text-secondary"><b><?php echo prebrojKorisnke(1) ?></b></p>
            </div>
        </div>
        <div class="col-6 card text-white mb-3 d-flex flex-row shadowBox" style="max-width: 18rem;">
            <!-- <div class="card-header">Header</div> -->
            <div class="p-2"><i class="fa fa-user itag"></i></div>
            <div class="card-body">
                <h5 class="card-title text-secondary">Total Korisnici</h5>
                <p class="card-text text-secondary"><b><?php echo prebrojKorisnke(2) ?></b></p>
            </div>
        </div>
    </div>

    <table class="table table-hover table-responsive w-auto m-auto text-center cursor">
        <thead>
            <tr>
                <th scope="col">Redni broj</th>
                <th scope="col">Ime i prezime</th>
                <th scope="col">Korisnicko ime</th>
                <th scope="col">E-mail</th>
                <th scope="col">Uloga</th>
                <th scope="col">status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rezultat = ispisKorisnikaAP();
            $br = 0;
            foreach ($rezultat as $r) :
            ?>
                <tr onclick="window.location='index.php?page=admin-modifikovanje&kId=<?php echo $r->id_korisnik ?>'">
                    <th scope="row"><?php echo $br = $br + 1;; ?></th>
                    <td><?php echo ($r->ime . " " . $r->prezime) ?></td>
                    <td><?php echo ($r->korisnicko_ime) ?></td>
                    <td><?php echo ($r->email) ?></td>
                    <td><?php echo ($r->naziv) ?></td>
                    <td><?php if ($r->statusAktivnosti == 1) : ?>
                            <span class="dot greenCircle"></span>
                        <?php else : ?>
                            <span class="dot redCircle"></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>
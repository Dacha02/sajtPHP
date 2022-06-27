<div class="container container-fluid d-flex my-5 flex-column align-items-center bg-light">
    <div class="d-flex flex-column col-12 col-md-7 my-3">
        <h1 class="fs40">Dodavanje proizvoda</h1>
    </div>
    <form class="d-flex flex-column col-12 col-md-6" method="POST" enctype="multipart/form-data" action="models/dodavanjeProizvoda.php">
        <div class="checkout__input">
            <p>Naslov</p>
            <input type="text" id="naslovProizvoda" />
            <span class="text-danger" id="greskaNaslov"></span>
        </div>
        <div class="checkout__input d-flex flex-row justify-content-around text-center flex-column flex-sm-row align-items-center">
            <div class="mb-1">
                <p>Kategorija</p>
                <select name="kategorija" id="ddlKategorija">
                    <?php $kat = ispisKategorija();
                    foreach ($kat as $k) :
                    ?>
                        <option value="<?php echo $k->id_kategorija ?>"><?php echo $k->naslov ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-1">
                <p>Boja</p>
                <select name="boja" id="ddlBoja">
                    <?php $boja = ispisBoja();
                    foreach ($boja as $b) :
                    ?>
                        <option value="<?php echo $b->id_boja ?>"><?php echo $b->naslov ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-1">
                <p>Velicina</p>
                <select name="velicina" id="ddlVelicina">
                    <?php $velicina = ispisVelicina();
                    foreach ($velicina as $v) :
                    ?>
                        <option value="<?php echo $v->id_velicina ?>"><?php echo $v->naslov ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="checkout__input">
            <p>Tezina</p>
            <input type="number" id="tezina" min="0" max="10" />
            <span class="text-danger" id="greskaTezina"></span>
        </div>
        <div class="checkout__input">
            <p>Cena</p>
            <input type="number" id="cenaProizvoda" min="0" />
            <span class="text-danger" id="greskaCena"></span>
        </div>
        <div class="d-flex flex-column justify-content-around mb-3">
            <p class="txtBlack">Stanje</p>
            <div><input type="radio" class="mr-2" name="stanje" id="naStanju" checked value="1" /><label for="naStanju">Na stanju</label></div>
            <div><input type="radio" class="mr-2" name="stanje" id="nemaNaStanju" value="0" /><label for="nemaNaStanju">Nema na stanju</label></div>
            <span class="text-danger" id="greskaTezina"></span>
        </div>

        <div class="checkout__input">
            <p>Kratak opis</p>
            <textarea type="text" id="kOpis"></textarea>
            <span class="text-danger" id="greskaKOpis"></span>
        </div>
        <div class="checkout__input">
            <p>Duzi opis</p>
            <textarea type="text" id="dOpis"></textarea>
            <span class="text-danger" id="greskaDOpis"></span>
        </div>
        <div class="checkout__input ">
            <p>Slike</p>
            <input type="file" name="fileSlika" multiple id="fileSlika" class="border-0" />
            <span class="text-danger" id="greskaDOpis"></span>
        </div>
        <button type="submit" class="site-btn mb-3" id="btnDodaj">
            Dodaj
        </button>
    </form>
</div>
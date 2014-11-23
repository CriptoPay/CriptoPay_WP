<div class="wrap">
    <h2>Cripto-Pay.com | Donaciones</h2>
    <h3>Administración de las donaciones</h3>

    <form method="post" action="options.php" novalidate="novalidate">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="cantminima">Cantidad mínima</label></th>
                    <td><input name="cantminima" type="number" id="cantminima" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cantrecom">Cantidad recomendada</label></th>
                    <td><input name="cantrecom" type="number" id="cantrecom" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cantmaxima">Cantidad máxima</label></th>
                    <td><input name="cantmaxima" type="number" id="cantmaxima" value="" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">Divisas para las donaciones</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Divisas para las donaciones</span></legend>
                            <label title="BTC"><input type="checkbox" name="div_don_btc" value="BTC" checked="checked"> <span>bitcoin</span></label><br>
                            <label title="LTC"><input type="checkbox" name="div_don_ltc" value="LTC" checked="checked"> <span>litecoin</span></label><br>
                            <label title="DGC"><input type="checkbox" name="div_don_dgc" value="DGC" checked="checked"> <span>dogecoin</span></label><br>
                            <label title="PTC"><input type="checkbox" name="div_don_ptc" value="PTC" checked="checked"> <span>pesetacoin</span></label><br>
                            <label title="SPA"><input type="checkbox" name="div_don_spa" value="SPA" checked="checked"> <span>spaincoin</span></label><br>
                        </fieldset>
                        <p class="description">Selecciona las divisas que podrán elegir los usuarios para realizar las donaciones.</p>
                    </td>
                </tr>
                
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios"></p>
    </form>

</div>
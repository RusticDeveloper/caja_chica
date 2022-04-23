<?php include('common/header.php') ?>
<h1>Saldo inicial de la caja chica</h1>

<button type="button" class="back-btn">Regresar</button>
<form method="post" id="pt-box-form">
    <!-- DDRC-C: campo oculto para mostrar la accion que se va a realizar -->
    <input type="text" hidden id="action_input" name="action">
    <!-- DDRC-C: condicional para la actualización o creación de caja chica -->
    <?php if ($futureAction === 'create') { ?>
        <div class="field">
            <label for="usuario">¿Quien sera el usuario responsable de la caja chica?:</label>
            <select name="usuario" id="usuario" required>
                <?php
                if (isset($usuarios)) {
                    foreach ($usuarios as $key => $value) {
                        echo ' <option value="' . $value["id_usuario"] . '">' . $value["nombres"] . '</option>';
                    }
                } else {
                    echo '<option value="NoU">no existen usuarios</option>';
                }
                ?>
            </select>
        </div>
    <?php } else {
        echo '<h2> Responsable de caja chica: ' . $nombre . ' ' . $apellido . '</h2>';
    } ?>

    <!-- DDRC-C:ver si esto se agrega a la caja chica para ingresar el valor por cantidades menores -->
    <?php if ($futureAction === 'create') { ?>
    <div class="fieldContainer">
        <fieldset class="columns">
            <legend>Billetes</legend>
            <div class="field">
                <label for="b_cien">¿Cuantos billetes de 100 hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="b_cien" id="b_cien">
            </div>
            <div class="field">
                <label for="b_cincuenta">¿Cuantos billetes de 50 hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="b_cincuenta" id="b_cincuenta">
            </div>
            <div class="field">
                <label for="b_veinte">¿Cuantos billetes de 20 hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="b_veinte" id="b_veinte">
            </div>
            <div class="field">
                <label for="b_diez">¿Cuantos billetes de 10 hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="b_diez" id="b_diez">
            </div>
            <div class="field">
                <label for="b_cinco">¿Cuantos billetes de 5 hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="b_cinco" id="b_cinco">
            </div>
            <div class="field">
                <label for="b_uno">¿Cuantos billetes de 1 hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="b_uno" id="b_uno">
            </div>
        </fieldset>
        <fieldset class="columns">
            <legend>Monedas</legend>
            <div class="field">
                <label for="m_un">¿Cuantas monedas de 1 dolar hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_un" id="m_un">
            </div>
            <div class="field">
                <label for="m_cincuenta">¿Cuantas monedas de 50 centavos hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_cincuenta" id="m_cincuenta">
            </div>
            <div class="field">
                <label for="m_veinticinco">¿Cuantas monedas de 25 centavos hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_veinticinco" id="m_veinticinco">
            </div>
            <div class="field">
                <label for="m_diez">¿Cuantas monedas de 10 centavos hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_diez" id="m_diez">
            </div>
            <div class="field">
                <label for="m_cinco">¿Cuantas monedas de 5 centavos hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_cinco" id="m_cinco">
            </div>
            <div class="field">
                <label for="m_uno">¿Cuantas monedas de 1 centavo hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_uno" id="m_uno">
            </div>
        </fieldset>
    </div>
    <?php } ?>
    <div class="field">
        <label for="monto">Establesca el saldo de la caja chica:</label>
        <input type="number" step=".01" min="1" max="99999.99" name="monto" id="monto" required readonly value="<?php echo $V = ($futureAction !== 'create') ? floatval($efectivo_caja_chica) : ''; ?>">
        
    </div>
    
    <div class="field">
        <label for="descripcion">Descripción:</label>
        <!-- <input type="text"  name="descripcion" id="descripcion"> -->
        <textarea name="descripcion" id="descripcion" cols="30" rows="2"><?php echo $V = ($futureAction !== 'create') ? $descripcion_caja_chica : ''; ?></textarea>
    </div>


    <div class="actions">
        <!-- DDRC-C: condicional para la actualización o creación de caja chica -->
        <?php if ($futureAction === 'create') { ?>
            <button type="submit" id="create-pettybox-btn">Crear caja chica</button>
        <?php } else { ?>
            <button type="submit" id="update-pettybox-btn">Actualizar caja chica</button>
            <!-- <button type="submit" id="delete-pettybox-btn">Eliminar caja chica</button> -->
        <?php } ?>
    </div>
</form>


<?php include('common/footer.php') ?>
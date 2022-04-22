<?php include('common/header.php') ?>

<h1>Arqueo</h1>

<form action="settlement" method="post">
    <!-- DDRC-C: campo oculto para demostrar la accion que se va a realizar -->
    <input type="text" hidden id="action_input" name="action">

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
                <label for="m_uno">¿Cuantas monedas de 1 centavos hay en caja?</label>
                <input required step="1" min="0" max="999" type="number" name="m_uno" id="m_uno">
            </div>

        </fieldset>
    </div>
    <div class="actions">
        <button type="submit" id="create-settlement">Guardar Saldos y generar arqueo</button>
    </div>
</form>


<div class="detailMovesContainer">
    <h1>Listado de movimientos de la caja chica</h1>
    <table class="detailMovesTable tablemanager">
        <thead>
            <tr>
                <th class="table_header disableFilterBy disableSort">Concepto</th>
                <th class="table_header disableFilterBy disableSort">Valor</th>
                <th class="table_header">Autorizado por</th>
                <th class="table_header">Solicitado por</th>
                <th class="table_header">Fecha</th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($isEmpthy)) {
            echo '<h1>no existen datos de movimientos </h1>';
        } else if (isset($movimientos)) {
            foreach ($movimientos as $key => $value) {
                echo '<tr>';
                echo '<td data-column="Concepto:">' . $value['descripcion'] . '</td>';
                echo '<td data-column="Valor:">' . $value['monto_movimiento'] . '</td>';
                echo '<td data-column="Autorizado por:">' . $value['nsol'] . ' ' . $value['apsol'] . '</td>';
                echo '<td data-column="Solicitado por:">' . $value['nauth'] . ' ' . $value['apauth'] . '</td>';
                echo '<td data-column="Fecha:">' . $value['fecha_movimiento'] . '</td>';
                echo '</tr>';
            }
        } ?>
        </tbody>
    </table>
    <button class="back-to-LA-btn">Regresar al menu</button>

</div>


<?php include('common/footer.php') ?>
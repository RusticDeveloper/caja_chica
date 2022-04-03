<?php include('common/header.php') ?>

<h1>arqueo</h1>
<p>basicamente el arqueo y la reposicion son lo mismo asi que se repiten con pequeñas diferencias</p>


<form action="." method="post">
    <div class="fieldContainer">
        <fieldset class="columns">
            <legend>Billetes</legend>

            <div class="field">
                <label for="b_cien">¿Cuantos billetes de 100 hay en caja?</label>
                <input required type="text" name="b_cien" id="b_cien">
            </div>
            <div class="field">
                <label for="b_cincuenta">¿Cuantos billetes de 50 hay en caja?</label>
                <input required type="text" name="b_cincuenta" id="b_cincuenta">
            </div>
            <div class="field">
                <label for="b_veinte">¿Cuantos billetes de 20 hay en caja?</label>
                <input required type="text" name="b_veinte" id="b_veinte">
            </div>
            <div class="field">
                <label for="b_diez">¿Cuantos billetes de 10 hay en caja?</label>
                <input required type="text" name="b_diez" id="b_diez">
            </div>
            <div class="field">
                <label for="b_cinco">¿Cuantos billetes de 5 hay en caja?</label>
                <input required type="text" name="b_cinco" id="b_cinco">
            </div>
            <div class="field">
                <label for="b_uno">¿Cuantos billetes de 1 hay en caja?</label>
                <input required type="text" name="b_uno" id="b_uno">
            </div>
        </fieldset>
        <fieldset class="columns">
            <legend>Monedas</legend>
            <div class="field">
                <label for="m_un">¿Cuantas monedas de 1 dolar hay en caja?</label>
                <input required type="text" name="m_un" id="m_un">
            </div>
            <div class="field">
                <label for="m_cincuenta">¿Cuantas monedas de 50 monedas hay en caja?</label>
                <input required type="text" name="m_cincuenta" id="m_cincuenta">
            </div>
            <div class="field">
                <label for="m_veincinco">¿Cuantas monedas de 25 monedas hay en caja?</label>
                <input required type="text" name="m_veincinco" id="m_veincinco">
            </div>
            <div class="field">
                <label for="m_diez">¿Cuantas monedas de 10 monedas hay en caja?</label>
                <input required type="text" name="m_diez" id="m_diez">
            </div>
            <div class="field">
                <label for="m_cinco">¿Cuantas monedas de 5 monedas hay en caja?</label>
                <input required type="text" name="m_cinco" id="m_cinco">
            </div>
            <div class="field">
                <label for="m_uno">¿Cuantas monedas de 1 monedas hay en caja?</label>
                <input required type="text" name="m_uno" id="m_uno">
            </div>

        </fieldset>
    </div>
    <div class="actions">
        <button type="submit">Guardar Saldos</button>
    </div>
</form>

<div class="detailMovesContainer">
    <table class="detailMovesTable">
        <tr>
            <th class="table_header">fecha</th>
            <th class="table_header">concepto</th>
            <th class="table_header">valor</th>
            <th class="table_header">autorizado por</th>
            <th class="table_header">solicitado por</th>
        </tr>
        <tr>
            <td>fdsfds</td> 
        </tr>
        
        <?php echo 'Aqui va los datos buscados de la base de datos'; ?>
    </table>

    <button onclick="loadPettyCashSettlement()">solicitar la reposicion de caja chica</button>
    <button onclick="goToMenu()">Regresar al menu</button>

</div>


<?php include('common/footer.php') ?>
<?php include('common/header.php') ?>

<h1>movimientos de caja chica</h1>

<form action="." method="post">
    <div class="fieldContainer">
        <fieldset class="columns">
            <legend>Información de movimientos</legend>

            <div class="field">
                <label for="bcien">Autorizado por :</label>
                <input type="text" name="bcien" id="bcien">
            </div>
            <div class="field">
                <label for="bcien">Solcicitado por :</label>
                <input type="text" name="bcien" id="bcien">
            </div>
            <div class="field">
                <label for="bcien">Monto :</label>
                <input type="text" name="bcien" id="bcien">
            </div>
            <div class="field">
                <label for="bcien">Descripción</label>
                <input type="text" name="bcien" id="bcien">
            </div>
            <div class="field">
                <label for="bcien">Adjunte la proforma</label>
                <input type="text" name="bcien" id="bcien">
            </div>
        </fieldset>
    </div>
    <div class="actions">
        <button type="submit">Solicitar transacción</button>
        <button type="button" onclick="goToMenu">Regresar al menú</button>
    </div>
</form>

<?php include('common/footer.php') ?>
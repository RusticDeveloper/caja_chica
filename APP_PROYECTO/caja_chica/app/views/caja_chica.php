<?php include('common/header.php') ?>

<h1>pantalla que se muestra si no existe una caja chica activa</h1>
<h1>Saldo incicial de la caja chica</h1>
<button type="button">Regresar</button>
    
<form action="../controllers/cajaChica.controller.php" method="post">
    <input type="text" hidden name="action" value="actualizar">
    <div class="field">
        <label for="usuario">¿Quien sera el usuario responsabe de la caja chica?:</label>
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
    <div class="field">
        <label for="monto">Establesca el saldo de la caja chica:</label>
        <input type="number" step=".01" name="monto" id="monto" required>
    </div>
    <div class="field">
        <label for="descripcion">Descripción:</label>
        <input type="text"  name="descripcion" id="descripcion" required>
    </div>
    <button type="submit">Crear caja chica</button>
    <button type="submit">Actualizar caja chica</button>
    <button type="submit">Eliminar caja chica</button>
</form>


<?php include('common/footer.php') ?>
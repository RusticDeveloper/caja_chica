<?php include('common/header.php') ?>

<h1>movimientos de caja chica</h1>

<form action="../controllers/movimientosCajaChica.controller.php" method="post" enctype="multipart/form-data">
    <div class="fieldContainer">
        <fieldset class="columns">
            <legend>Información de movimientos</legend>
            <!-- DDRC-C: campo oculto para demostrar la accion que se va a realizar -->
            <input type="text" hidden id="action_input" name="action">
            <div class="field">
                <label for="autorizado">Autorizado por :</label>
                <?php if ($futureAction === 'CREAR') { ?>
                    <select name="autorizado" id="autorizado" required>
                    <?php } else { ?>
                        <select name="autorizado" id="autorizado" required disabled>
                        <?php }
                    if (isset($usuarios)) {
                        foreach ($usuarios as $key => $value) {
                            if ($value['id_usuario'] === $currentMove['authID']) {
                                echo ' <option selected value="' . $value["id_usuario"] . '">' . $value["nombres"] . ' ' . $value["apellidos"]  . '</option>';
                            } else {
                                echo ' <option value="' . $value["id_usuario"] . '">' . $value["nombres"] . ' ' . $value["apellidos"]  . '</option>';
                            }
                        }
                    } else {
                        echo '<option value="NoU">no existen usuarios</option>';
                    }
                        ?>
                        </select>

            </div>
            <div class="field">
                <label for="solicitado">Solcicitado por :</label>
                <?php if ($futureAction === 'CREAR') { ?>
                    <select name="solicitado" id="solicitado" required>
                    <?php } else { ?>
                        <select name="solicitado" id="solicitado" required disabled>
                        <?php }
                    if (isset($usuarios)) {
                        foreach ($usuarios as $key => $value) {
                            if ($value['id_usuario'] === $currentMove['solID']) {
                                echo ' <option selected value="' . $value["id_usuario"] . '">' . $value["nombres"] . ' ' . $value["apellidos"]  . '</option>';
                            } else {
                                echo ' <option value="' . $value["id_usuario"] . '">' . $value["nombres"] . ' ' . $value["apellidos"]  . '</option>';
                            }
                        }
                        echo '<option value="noUser">No es un usuario registrado</option>';
                    } else {
                        echo '<option value="NoU">no existen usuarios</option>';
                    }
                        ?>
                        </select>

            </div>
            <div class="field">
                <label for="monto_mov">Monto del movimiento:</label>
                <?php if ($futureAction === 'CREAR') { ?>
                    <input type="number" step=".01" min="1" max="99999.99" name="monto_mov" id="monto_mov" required>
                <?php } else { ?>
                    <input type="number" step=".01" min="1" max="99999.99" name="monto_mov" id="monto_mov" required disabled value="<?php echo floatval($currentMove['monto_movimiento']) ?>">
                <?php } ?>
            </div>
            <div class="field">
                <label for="description">Descripción</label>
                <?php if ($futureAction === 'CREAR' || $futureAction === 'ANULAR') { ?>
                    <textarea name="description" id="description" cols="30" rows="2"></textarea>
                    <?php } else { ?>
                        <textarea name="description" id="description" cols="30" rows="2" disabled><?php echo $currentMove['descripcion']?></textarea>
                    <?php } ?>
            </div>
            <div class="field">
                <label for="comprovante">Adjunte la proforma</label>
                <input type="file" accept="application/pdf,image/*" name="comprovante" id="comprovante">
            </div>
        </fieldset>
    </div>
    <div class="actions">
        <?php if ($futureAction === 'ACTUALIZAR') { ?>
            <button type="submit" id="update-move">Actualizar transacción</button>
        <?php } else if ($futureAction === 'ANULAR') { ?>
            <button type="submit" id="nullify-move">Anular transacción</button>
        <?php } else if ($futureAction === 'CREAR') { ?>
            <button type="submit" id="make-move">Solicitar transacción</button>
        <?php } ?>
        <button type="button" class="back-to-LM-btn">Regresar al menú</button>
    </div>
</form>

<?php include('common/footer.php') ?>
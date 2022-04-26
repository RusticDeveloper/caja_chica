<?php include('common/header.php');
$tipoMovimiento = array('INGRESO', 'EGRESO');
$tipoPago = array('EFECTIVO', 'CHEQUE', 'TARJETA', 'TRANSFERENCIA', 'CREDITO');
?>

<h1>movimientos de caja chica</h1>

<form id="move-form" method="post" enctype="multipart/form-data">
    <div class="fieldContainer">
        <?php
        if (isset($_SESSION['noFunds'])) {
            echo '<h1>' . $_SESSION['noFunds'] . '</h1>';
            unset($_SESSION['noFunds']);
        }
        ?>
        <fieldset class="columns">
            <legend>Información de movimientos</legend>
            <!-- DDRC-C: saldo que una caja chica tiene al momento de elaborar un movimiento. -->
            <label>Saldo actual en caja chica: <?= $saldoCC ?></label>
            <!-- DDRC-C: campo oculto para demostrar la accion que se va a realizar -->
            <input type="text" hidden id="action_input" name="action">
            <div class="field">
                <label for="autorizado">Autorizado por:</label>
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
            <?php if ($futureAction === 'CREAR') { ?>
                <div class="field">
                    <label for="clave_auth">Clave de autorización:</label>
                    <input type="password" name="clave_auth" id="clave_auth" required>
                    <?php
                    if (isset($_SESSION['invalidKey'])) {
                        echo '<label>' . $_SESSION['invalidKey'] . '</label>';
                        unset($_SESSION['invalidKey']);
                    }
                    ?>
                </div>
            <?php } ?>
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
                <label for="tipoMovimiento">Tipo de movimiento:</label>
                <?php if ($futureAction === 'CREAR') { ?>
                    <select name="tipoMovimiento" id="tipoMovimiento" required>
                <?php } else { ?>
                    <select name="tipoMovimiento" id="tipoMovimiento" required disabled>
                <?php } 
                        foreach ($tipoMovimiento as $key => $value) {
                            if ($value === $currentMove['tipo_movimiento']) {
                                echo '<option selected value="' . $value . '">' . $value . '</option>';
                            } else {
                                echo '<option value="' . $value . '">' . $value . '</option>';
                            }
                        }
                        ?>
                        </select>

            </div>
            <div class="field">
                <label for="tipoPago">Tipo de pago:</label>
                <?php if ($futureAction === 'CREAR') { ?>
                        <select name="tipoPago" id="tipoPago" required>
                <?php } else { ?>
                    <select name="tipoPago" id="tipoPago" required disabled>
                <?php }
                    foreach ($tipoPago as $key => $value) {
                        if ($value === $currentMove['tipo_pago']) {
                            echo '<option selected value="' . $value . '">' . $value . '</option>';
                        } else {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="field">
                <label for="monto_mov">Monto del movimiento:</label>
                <?php if ($futureAction === 'CREAR') { ?>
                    <input type="number" step=".01" min="1" max="99999.99" name="monto_mov" id="monto_mov" required>
                <?php } else { ?>
                    <input type="number" step=".01" min="1" max="99999.99" name="monto_mov" id="monto_mov" required readonly value="<?php echo floatval($currentMove['monto_movimiento']) ?>">
                <?php } ?>
            </div>
            <div class="field">
                <label for="description">Descripción</label>
                <?php if ($futureAction === 'CREAR' || $futureAction === 'ANULAR') { ?>
                    <textarea name="description" id="description" cols="30" rows="2"></textarea>
                <?php } else { ?>
                    <textarea name="description" id="description" cols="30" rows="2" readonly><?php echo isset($currentMove) ? $currentMove['descripcion'] : '' ?></textarea>
                <?php } ?>
            </div>

            <?php if ($futureAction !== 'CREAR') { ?>
                <iframe src=" ./<?= $currentMove['url_comprobante'] ?>" width="100%" height="500" frameborder="0"></iframe>
            <?php } ?>

            <?php if ($futureAction === 'ACTUALIZAR' || $futureAction === 'CREAR') { ?>
                <div class="field">
                    <label for="comprovante">Adjunte la proforma</label>
                    <input type="file" accept="application/pdf,image/*" name="comprovante" id="comprovante" required>
                    <label id="mensaje"></label>
                </div>
            <?php } ?>
        </fieldset>
    </div>
    <div class="actions">
        <?php if ($futureAction === 'ACTUALIZAR') { ?>
            <button type="submit" id="update-move"> Actualizar transacción</button>
        <?php } else if ($futureAction === 'ANULAR') { ?>
            <button type="submit" id="nullify-move">Anular transacción</button>
        <?php } else if ($futureAction === 'CREAR') { ?>
            <button type="submit" id="make-move">Realizar transacción</button>
            <!-- <button type="button" id="make-egress-bill">Crear nueva factura de egreso</button> -->
        <?php } ?>
        <button type="button" class="back-to-LM-btn"><img src="./assets/img/back.svg" alt="Regresar a la lista" height ="50" width="50" ></button>
    </div>
</form>

<?php include('common/footer.php') ?>
<?php include('common/header.php') ?>

<h1>pantalla que se muestra si no existe una caja chica activa</h1>
<h1>Saldo incicial de la caja chica</h1>
<button type="button" class="back-btn">Regresar</button>
    
<form action="../controllers/cajaChica.controller.php" method="post">
    <!-- DDRC-C: campo oculto para mostrar la accion que se va a realizar -->
    <input type="text" hidden id="action_input" name="action">
    <!-- DDRC-C: condicional para la actualización o creación de caja chica -->
    <?php if($futureAction==='create'){ ?>
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
    <?php }else{
        echo '<h2> Responsable de caja chica: '.$nombre .' '. $apellido .'</h2>';
     }?>
        
    <div class="field">
        <label for="monto">Establesca el saldo de la caja chica:</label>
        <input type="number" step=".01" min="1" max="99999.99" name="monto" id="monto" required
        value="<?php echo $V = ($futureAction!=='create')?floatval($efectivo_caja_chica):''; ?>"
        >
    </div>
    <div class="field">
        <label for="descripcion">Descripción:</label>
        <!-- <input type="text"  name="descripcion" id="descripcion"> -->
        <textarea name="descripcion" id="descripcion" cols="30" rows="2" ><?php echo $V = ($futureAction!=='create')?$descripcion_caja_chica:''; ?></textarea>
    </div>
    <div class="actions">
        <!-- DDRC-C: condicional para la actualización o creación de caja chica -->
    <?php if($futureAction==='create'){ ?>
    <button type="submit" id="create-pettybox-btn">Crear caja chica</button>
    <?php }else{ ?>
    <button type="submit" id="update-pettybox-btn">Actualizar caja chica</button>
    <button type="submit" id="delete-pettybox-btn">Eliminar caja chica</button>
    <?php } ?>
    </div>
</form>


<?php include('common/footer.php') ?>
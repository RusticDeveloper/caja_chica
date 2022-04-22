<?php include('common/header.php') ?>

<h1>Lista de movimientos</h1>
<!-- <h2>Aqui se listan los arqueos realizados en un periodo de tiempo</h2> -->
<div class="actions">
    <button class="back-btn">Regresar</button>    
    <button class="add-move" onclick="sendSettlementAction('CREAR')">Realizar Arqueo</button>
</div>
<div class="move_list">
    <table class="tablemanager">
        <thead>
        <tr>
            <th >Fecha Arqueo</th>
            <th >Observaciones</th>
            <th class="disableFilterBy disableSort">Total en caja</th>
            <th class="disableFilterBy disableSort">Total en Movimientos</th>
            <th class="disableFilterBy disableSort">Monto caja chica</th>
            <th class="disableFilterBy disableSort">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($isEmpthy)) {
            echo '<h1>no hay datos de arqueos</h1>';
        } else if (isset($arqueos)) {
            foreach ($arqueos as $key => $value) {
                echo '<tr>';
                echo '<td data-column="Fecha arqueo:">' . $value['fecha_arqueo'] . '</td>';
                echo '<td data-column="Observaciones:">' . $value['descripcion'] . '</td>';
                echo '<td data-column="Total en caja:">' . $value['total_caja_chica'] . '</td>'; 
                echo '<td data-column="Total en Movimientos:">' . $value['total_movimientos'] . '</td>';
                echo '<td data-column="Monto caja chica:">' . $value['monto_caja_chica'] . '</td>';
                echo '
                    <td data-column="Acciones:">
                        <button type="button" onclick="sendSettlementReport(' . "'settlement'," . $value['arqId'] . ')"><img src="./assets/img/review.svg" alt="revisar movimiento" height ="50" width="50" ></button>
                    </td>
                </tr>
                ';
            }
        } ?>
        
    </table>
</div>


<?php include('common/footer.php') ?>
<?php include('common/header.php') ?>

<h1>Lista de movimientos</h1>

<div class="actions">
    <button class="back-btn">Regresar</button>
    <?php if ($action === 'NULLIFIED') { ?>
        <button class="nullified" onclick="sendAction('FLAG')">revisar movimientos</button>
    <?php } else { ?>
        <button class="nullified" onclick="sendAction('NULLIFIED')">revisar movimientos anulados</button>
    <?php } ?>
    
    <button class="add-move" onclick="sendAction('CREAR')">Realizar movimientos</button>
</div>
<div class="move_list">
    <table class="tablemanager">
        <thead>
        <tr>
            <th class="disableSort disableFilterBy">Descripción</th>
            <th class="disableFilterBy disableSort">Monto</th>
            <th>Solicitado por</th>
            <th>Autorizado por</th>
            <th class="disableSort disableFilterBy">Fecha Transacción</th>
            <?php if ($action === 'NULLIFIED') { echo '<th>Fecha Anulación</th>';} ?>
            <th class="disableFilterBy">Acciones</th>
        </tr>
        </thead>
        <tBody>
        <?php if (isset($isEmpthy)) {
            echo '<h1>no hay datos en la base de datos</h1>';
        } else if (isset($movimientos)) {
            foreach ($movimientos as $key => $value) {
                echo '<tr>';
                echo '<td data-column="Descripción:">' . $value['descripcion'] . '</td>';
                echo '<td data-column="Monto:">' . $value['monto_movimiento'] . '</td>';
                echo '<td data-column="Solicitado por:">' . $value['nsol'] . ' ' . $value['apsol'] . '</td>';
                echo '<td data-column="Autorizado por:">' . $value['nauth'] . ' ' . $value['apauth'] . '</td>';
                echo '<td data-column="Fecha Transacción:">' . $value['fecha_movimiento'] . '</td>';
                echo '
                    <td data-column="Acciones:">
                        <button type="button" onclick="sendAction(' . "'REVISAR'," . $value['id'] . ')"><img src="../../assets/img/review.svg" alt="revisar movimiento" height ="50" width="50" ></button>
                        <button type="button" onclick="sendAction(' . "'ACTUALIZAR'," . $value['id'] . ')"><img src="../../assets/img/edit.svg" alt="actualizar movimiento" height ="50" width="50" ></button>
                        <button type="button" onclick="sendAction(' . "'ANULAR'," . $value['id'] . ')"><img src="../../assets/img/nullify.svg" alt="anular movimiento" height ="50" width="50" ></button>
                    </td>
                </tr>
                ';
            }
        } ?>
        <?php if (isset($isNullifiedEmpthy)) {
            echo '<h1>no hay datos en la base de datos</h1>';
        } else if (isset($movimientosAnulados)) {
            foreach ($movimientosAnulados as $key => $value) {
                echo '<tr>';
                echo '<td data-column="Descripción:">' . $value['descripcion'] . '</td>';
                echo '<td data-column="Monto:">' . $value['monto_movimiento'] . '</td>';
                echo '<td data-column="Solicitado por:">' . $value['nsol'] . ' ' . $value['apsol'] . '</td>';
                echo '<td data-column="Autorizado por:">' . $value['nauth'] . ' ' . $value['apauth'] . '</td>';
                echo '<td data-column="Fecha transacción:">' . $value['fecha_movimiento'] . '</td>';
                echo '<td data-column="Fecha anulación:">' . $value['fecha_anulacion'] . '</td>';
                echo '
                    <td data-column="Acciones:">
                        <button type="button" onclick="sendAction(' . "'REVISAR'," . $value['id'] . ')"><img src="../../assets/img/review.svg" alt="revisar movimiento" height ="50" width="50" ></button>
                    </td>
                </tr>
                ';
            }
        } ?>
        </tBody>
    </table>
</div>


<?php include('common/footer.php') ?>
<?php include('common/header.php') ?>

<h1>Lista de movimientos</h1>
<h2>Aqui se listan los movimientos realizados en un periodo de tiempo</h2>
<div class="actions">
    <button class="back-btn">Regresar</button>
    <button class="nullified" onclick="sendAction('NULLIFIED')">revisar movimientos anulados</button>
    <button class="add-move" onclick="sendAction('CREAR')">Realizar movimientos</button>
</div>
<div class="move_list">
    <table>
        <tr>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Solicitador por</th>
            <th>Autorizado por</th>
            <th>Fecha Transacción</th>
            <th>Acciones</th>
        </tr>
        <?php if (isset($isEmpthy)) {
            echo '<h1>no hay datos en la base de datos</h1>';
        } else {
            foreach ($movimientos as $key => $value) {
                echo '<tr>';
                echo '<td>' . $value['descripcion']. '</td>';
                echo '<td>' . $value['monto_movimiento']. '</td>';
                echo '<td>' . $value['nsol'] . ' ' . $value['apsol'] . '</td>';
                echo '<td>' . $value['nauth'] . ' ' . $value['apauth'] . '</td>';
                echo '<td>' . $value['fecha_movimiento']. '</td>';
                echo '
                    <td>
                        <button type="button" onclick="sendAction('."'REVISAR',".$value['id'].')">Revisar movimiento</button>
                        <button type="button" onclick="sendAction('."'ACTUALIZAR',".$value['id'].')">actualizar movimiento</button>
                        <button type="button" onclick="sendAction('."'ANULAR',".$value['id'].')">anular movimiento</button>
                    </td>
                </tr>
                ';
            }
        } ?>
    </table>
</div>


<?php include('common/footer.php') ?>
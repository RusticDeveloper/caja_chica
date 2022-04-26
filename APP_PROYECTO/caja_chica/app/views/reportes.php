<?php include('common/header.php') ?>

<h1>Reportes</h1>
<button class="back-btn"><img src="./assets/img/back.svg" alt="Regresar" height ="50" width="50" ></button>
<div class="report-container">
    <div id="report_settlement">
        <h2>Reporte de arqueos</h2>
    </div>
    <div id="report_moves">
        <h2>Reporte de movimientos</h2>
    </div>
    <div id="report_result_state">
        <h2>Estado de resultados</h2>
        <form method="post" action="result-state-report?action=resultState">
            <label for="startDate">Fecha de inicio: </label>
            <input type="date" id="startDate" name="startDate" required>
            <br>
            <label for="endDate">Fecha de finalización: </label>
            <input type="date" id="endDate" name="endDate" required>
            <br>
            <button type="submit" >Consultar</button>
        </form>
    </div>
</div>
<?php include('common/footer.php') ?>
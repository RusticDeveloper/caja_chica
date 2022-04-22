// DDRC-C: carga la funcionalidad cuando el dom ha sido completamente cargado
document.addEventListener("DOMContentLoaded", function () {

    // DDRC-C: revisando desde que navegador se revisando
    /* Storing user's device details in a variable*/
    let details = navigator.userAgent;

    /* Creating a regular expression 
    containing some mobile devices keywords 
    to search it in details string*/
    let regexp = /android|iphone|kindle|ipad/i;

    /* Using test() method to search regexp in details
    it returns boolean value*/
    let isMobileDevice = regexp.test(details);
    var isMobile = false;
    if (isMobileDevice) {
        isMobile = true;
        console.log("You are using a Mobile Device");
    } else {
        isMobile = false;
        console.log("You are using Desktop");
    }

    // DDRC-C: escuchadores de eventos para los distintos botones
    let botonCrear = document.getElementById("create-pettybox-btn");
    let botonActualizar = document.getElementById("update-pettybox-btn");
    let botonEliminar = document.getElementById("delete-pettybox-btn");
    let formularioCajaChica = document.getElementById("pt-box-form");
    let actualizarMovimiento = document.getElementById("update-move");
    let anularMovimiento = document.getElementById("nullify-move");
    let crearMovimiento = document.getElementById("make-move");
    let formularioMovimiento = document.getElementById("move-form");
    let crearArqueo = document.getElementById("create-settlement");
    let crearReporteArqueo = document.getElementById("report_settlement");
    let crearReporteMovimiento = document.getElementById("report_moves");
    let b_cien = document.getElementById("b_cien");
    let b_cincuenta = document.getElementById("b_cincuenta");
    let b_veinte = document.getElementById("b_veinte");
    let b_diez = document.getElementById("b_diez");
    let b_cinco = document.getElementById("b_cinco");
    let b_uno = document.getElementById("b_uno");
    let m_un = document.getElementById("m_un");
    let m_cincuenta = document.getElementById("m_cincuenta");
    let m_veinticinco = document.getElementById("m_veinticinco");
    let m_diez = document.getElementById("m_diez");
    let m_cinco = document.getElementById("m_cinco");
    let m_uno = document.getElementById("m_uno");
    let monto = document.getElementById("monto");
    let archivo = document.getElementById("comprovante");
    let mensaje = document.getElementById("mensaje");



    // DDRC-C: acciones para botones en general
    document.querySelectorAll('.back-btn').forEach(item => {
        item.addEventListener('click', goToMain);
    });
    document.querySelectorAll('.back-to-LM-btn').forEach(item => {
        item.addEventListener('click', goOneUp.bind(this, 'moves-list'), false);
    });
    document.querySelectorAll('.back-to-LA-btn').forEach(item => {
        item.addEventListener('click', goOneUp.bind(this, 'settlements-list'), false);
    });

    if (b_cien && monto) {
        b_cien.addEventListener("input", totalCash);
        b_cincuenta.addEventListener("input", totalCash);
        b_veinte.addEventListener("input", totalCash);
        b_diez.addEventListener("input", totalCash);
        b_cinco.addEventListener("input", totalCash);
        b_uno.addEventListener("input", totalCash);
        m_un.addEventListener("input", totalCash);
        m_uno.addEventListener("input", totalCash);
        m_cincuenta.addEventListener("input", totalCash);
        m_veinticinco.addEventListener("input", totalCash);
        m_diez.addEventListener("input", totalCash);
        m_cinco.addEventListener("input", totalCash);
    }
    // DDRC-C: acciones para botones especificos
    if (botonCrear) {
        botonCrear.addEventListener("click", setFormAction.bind(this, "crear"), false);
        formularioCajaChica.action='create-pettybox';
    } 
    if (botonActualizar) {
        botonActualizar.addEventListener("click", setFormAction.bind(this, "actualizar"), false);
        formularioCajaChica.action='update-pettybox';
    }
    if (botonEliminar) {
        botonEliminar.addEventListener("click", setFormAction.bind(this, "eliminar"), false);
        formularioCajaChica.action='delete-pettybox';
    }

    if (actualizarMovimiento) {
        actualizarMovimiento.addEventListener("click", setFormAction.bind(this, "actualizar"), false);
        formularioMovimiento.action='move-performance';
    } else if (anularMovimiento) {
        anularMovimiento.addEventListener("click", setFormAction.bind(this, "anular"), false);
        formularioMovimiento.action='move-performance';
    } else if (crearMovimiento) {
        crearMovimiento.addEventListener("click", setFormAction.bind(this, "crear"), false);
        formularioMovimiento.action='move-performance';
    }

    if (archivo) {
        archivo.addEventListener("change", checkZise);
    }

    if (crearArqueo) {
        crearArqueo.addEventListener("click", setFormAction.bind(this, "crear"), false);
    }

    if (crearReporteArqueo) {
        crearReporteArqueo.addEventListener("click", goToReport.bind(this, "moves"), false);
    }

    if (crearReporteMovimiento) {
        crearReporteMovimiento.addEventListener("click", goToReport.bind(this, "settlements"), false);
    }

    // DDRC-C: funcionalidades para los distintos elementos de las vistas

    //DDRC-C: establece el valor del campo oculto de acción
    function setFormAction(actionValue) {
        let ActionInput = document.getElementById("action_input");
        ActionInput.value = actionValue;
        // alert('boton-presionado: ' + ActionInput.value);
    }
    //DDRC-C: envia al inicio de la aplicacion desde cualquier documento
    function goToMain() {
        let currentFolder = document.location.pathname;
        let part = currentFolder.slice(0, currentFolder.indexOf('/', 15));
        window.location.assign(part);
    }
    //DDRC-C: Abre una nueva pestala para los reportes
    function goToReport(accion) {
        console.log(document.location.pathname);
        ruta = 'reports?action=' + accion;
        window.open(ruta, "_blank");
        window.focus();
        // window.location.href = ruta +'?action='+ accion;
    }
    //DDRC-C: envia un escalon arriva de la aplicacion desde cualquier documento
    function goOneUp(controllerName) {
        let currentFolder = document.location.pathname;
        let part = currentFolder.slice(0, currentFolder.lastIndexOf('/')) + '/' + controllerName;
        // console.log(part);
        window.location.assign(part);
    }
    //DDRC-C: establece el monto
    function totalCash() {
        valorTotal = ((b_cien.value * 100) + (b_cincuenta.value * 50) + (b_veinte.value * 20) + (b_diez.value * 10) + (b_cinco.value * 5) +
            (b_uno.value * 1) + (m_un.value * 1) + (m_cincuenta.value * 0.5) + (m_veinticinco.value * 0.25) + (m_diez.value * 0.1) + (m_cinco.value * 0.05) + (m_uno.value * 0.01)).toFixed(2);
        monto.setAttribute('value', valorTotal);
        monto.innerHTML = valorTotal;
        console.log(monto.value);
    }
    //DDRC-C: verifica el tamaño del archivo
    function checkZise() {
        // 2097152
        tamano=archivo.files[0].size;
        if (tamano>2097152) {
            mensaje.innerHTML='el archivo pesa mas de 2 MB, debe ser menor';
            archivo.value=null;
        } else {
            mensaje.innerHTML='el archivo es menor a 2 MB, se puede subir';
        }
    }
    function formatBytes(a, b = 2, k = 1024) { with (Math) { let d = floor(log(a) / log(k)); return 0 == a ? "0 Bytes" : parseFloat((a / pow(k, d)).toFixed(max(0, b)))} }
});

//DDRC-C: funcion para enviar una accion y un id0 de la lista de movimientos a los movimientos en general
function sendAction(mensaje, identificacion = '') {
    // alert('Hola '+mensaje);
    window.location.href = 'moves-list?action=' + mensaje + '&identificador=' + identificacion;
    // window.location.href = '../../app/controllers/listaMovimientosCajaChica.controller.php?action=' + mensaje + '&identificador=' + identificacion;
}
function sendSettlementAction(mensaje, identificacion = '') {
    // alert('Hola '+mensaje);
    window.location.href = 'settlements-list?action=' + mensaje + '&identificador=' + identificacion;
}
function sendSettlementReport(mensaje, identificacion = '') {
    // alert('Hola '+mensaje);
    // window.location.href = ;
    window.open('settlement-report?action=' + mensaje + '&identificador=' + identificacion, "_blank");
}


//DDRC-C: useful ways of executing JS code after page is loaded, use "DOMContentLoaded" when able
// document.addEventListener("DOMContentLoaded", function(){
//     dom is fully loaded, but maybe waiting on images & css files
// });
// window.addEventListener("load", function(){
//     everything is fully loaded, don't use me if you can use DOMContentLoaded
// });
// var someEventHander=function(){
// 	console.log(event,param1,param2);
// }
//add listener
// document.getElementById("someid").addEventListener('click',someEventHander.bind(event,param1,param2));

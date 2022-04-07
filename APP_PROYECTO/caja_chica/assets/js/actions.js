// DDRC-C: carga la funcionalidad cuando el dom ha sido completamente cargado
document.addEventListener("DOMContentLoaded", function () {


    // DDRC-C: escuchadores de eventos para los distintos botones
    let botonCrear = document.getElementById("create-pettybox-btn");
    let botonActualizar = document.getElementById("update-pettybox-btn");
    let botonEliminar = document.getElementById("delete-pettybox-btn");
    let actualizarMovimiento = document.getElementById("update-move");
    let anularMovimiento = document.getElementById("nullify-move");
    let crearMovimiento = document.getElementById("make-move");

    // DDRC-C: acciones para botones en general
    document.querySelectorAll('.back-btn').forEach(item => {
        item.addEventListener('click', goToMain);
    });
    document.querySelectorAll('.back-to-LM-btn').forEach(item => {
        item.addEventListener('click', goOneUp.bind(this, 'listaMovimientosCajaChica.controller.php'), false);
    });
    document.querySelectorAll('.back-to-LA-btn').forEach(item => {
        item.addEventListener('click', goOneUp.bind(this, 'listaArqueosCajaChica.controller.php'), false);
    });

    // DDRC-C: acciones para botones especificos
    if (botonCrear) {
        botonCrear.addEventListener("click", setFormAction.bind(this, "crear"), false);
    } else if (botonActualizar) {
        botonActualizar.addEventListener("click", setFormAction.bind(this, "actualizar"), false);
        botonEliminar.addEventListener("click", setFormAction.bind(this, "eliminar"), false);
    }

    if (actualizarMovimiento) {
        actualizarMovimiento.addEventListener("click", setFormAction.bind(this, "actualizar"), false);
    } else if (anularMovimiento) {
        anularMovimiento.addEventListener("click", setFormAction.bind(this, "anular"), false);
    } else if (crearMovimiento) {
        crearMovimiento.addEventListener("click", setFormAction.bind(this, "crear"), false);
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
    //DDRC-C: envia un escalon arriva de la aplicacion desde cualquier documento
    function goOneUp(controllerName) {
        let currentFolder = document.location.pathname;
        let part = currentFolder.slice(0, currentFolder.lastIndexOf('/')) + '/' + controllerName;
        window.location.assign(part);
    }
});

//DDRC-C: funcion para enviar una accion y un id0 de la lista de movimientos a los movimientos en general
function sendAction(mensaje, identificacion = '') {
    // alert('Hola '+mensaje);
    window.location.href = '../../app/controllers/listaMovimientosCajaChica.controller.php?action=' + mensaje + '&identificador=' + identificacion;
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

// DDRC-C: carga la funcionalidad cuando el dom ha sido completamente cargado
document.addEventListener("DOMContentLoaded", function () {


    // DDRC-C: escuchadores de eventos para los distintos botones
    let botonCrear = document.getElementById("create-pettybox-btn");
    // document.getElementsByClassName('back-btn').addEventListener("click", goToMain.bind(null));
    document.querySelectorAll('.back-btn').forEach(item => {
        item.addEventListener('click',goToMain);
      });
    if (botonCrear !== null) {
        botonCrear.addEventListener("click", setFormAction.bind(this, "crear"), false);
    } else {
        document.getElementById("update-pettybox-btn").addEventListener("click", setFormAction.bind(this, "actualizar"), false);
        document.getElementById("delete-pettybox-btn").addEventListener("click", setFormAction.bind(this, "eliminar"), false);
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
        let part=currentFolder.slice(0,currentFolder.indexOf('/',15));
        window.location.assign(part);
    }

});



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

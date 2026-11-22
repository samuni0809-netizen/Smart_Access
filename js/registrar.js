// IDENTIFICAR LOS BOTONES
const botonPermanente = document.getElementById("boton-permanente");
const botonTemporal = document.getElementById("boton-temporal");

// IDENTIFICAR LOS FORMULARIOS
const formularioPermanente = document.getElementById("formulario-permanente");
const formularioTemporal = document.getElementById("formulario-temporal");

// OCULTAR EL FORMULARIO TEMPORAL AL INICIAR
formularioTemporal.classList.add("d-none");


// CAMBIAR AL FORMULARIO PERMANENTE
botonPermanente.addEventListener("click", function () {

    formularioPermanente.classList.remove("d-none");
    formularioTemporal.classList.add("d-none");

    botonPermanente.classList.remove("btn-secondary");
    botonPermanente.classList.add("btn-success");

    botonTemporal.classList.remove("btn-success");
    botonTemporal.classList.add("btn-secondary");

});

// CAMBIAR AL FORMULARIO TEMPORAL
botonTemporal.addEventListener("click", function () {

    formularioTemporal.classList.remove("d-none");
    formularioPermanente.classList.add("d-none");

    botonTemporal.classList.remove("btn-secondary");
    botonTemporal.classList.add("btn-success");

    botonPermanente.classList.remove("btn-success");
    botonPermanente.classList.add("btn-secondary");

});
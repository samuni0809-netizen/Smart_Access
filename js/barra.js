/* Elementos del menu */

const botonMenu = document.getElementById("boton-menu");

const estructura = document.querySelector(".estructura-administrativa");

const fondoMenu = document.getElementById("fondo-menu");

const navegacion = document.getElementById("navegacion-header");

/* Comprobar que los elementos existen */

if (botonMenu && estructura && fondoMenu && navegacion){

    /* Abrir y cerrar el menu */

    botonMenu.addEventListener("click", function (){

        const menuAbierto = estructura.classList.toggle("menu-abierto");

        botonMenu.setAttribute("aria-expanded", menuAbierto);
    });

    /* Cerrar el menu al pulsar el fondo */

    fondoMenu.addEventListener("click", function (){

        estructura.classList.remove("menu-abierto");

        botonMenu.setAttribute("aria-expanded", "false");

    });
}
/* Elementos del menu */

const botonMenu = document.getElementById("boton-menu");

const estructura = document.querySelector(".estructura-administrativa");

const fondoMenu = document.getElementById("fondo-menu");

const navegacion = document.getElementById("navegacion-header");

const navegacion_u = document.getElementById("navegacion-header_Usuario");

const navegacion_v = document.getElementById("navegacion-header_vigilante");

/* Comprobar que los elementos existen Administrador */

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

/* Comprobar que los elementos existen Usuario */

if (botonMenu && estructura && fondoMenu && navegacion_u){

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

/* Comprobar que los elementos existen Vigilante */

if (botonMenu && estructura && fondoMenu && navegacion_v){

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
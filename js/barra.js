/* elementos del menu */

const botonMenu = document.getElementById("boton-menu");

const estructura = document.querySelector(".estructura-administrativa");

const fondoMenu = document.getElementById("fondo-menu");

const navegacion = document.getElementById("navegacion-header");

const navegacion_u = document.getElementById("navegacion-header-usuario");

const navegacion_v = document.getElementById("navegacion-header-vigilante");

/* comprobar que los elementos existen administrador */

if (botonMenu && estructura && fondoMenu && navegacion){

    /* abrir y cerrar el menu */

    botonMenu.addEventListener("click", function (){

        const menuAbierto = estructura.classList.toggle("menu-abierto");

    });

    /* cerrar el menu al pulsar el fondo */

    fondoMenu.addEventListener("click", function (){

        estructura.classList.remove("menu-abierto");


    });
}

/* comprobar que los elementos existen usuario */

if (botonMenu && estructura && fondoMenu && navegacion_u){

    /* abrir y cerrar el menu */

    botonMenu.addEventListener("click", function (){

        const menuAbierto = estructura.classList.toggle("menu-abierto");

    });

    /* cerrar el menu al pulsar el fondo */

    fondoMenu.addEventListener("click", function (){

        estructura.classList.remove("menu-abierto");


    });
}

/* comprobar que los elementos existen vigilante */

if (botonMenu && estructura && fondoMenu && navegacion_v){

    /* abrir y cerrar el menu */

    botonMenu.addEventListener("click", function (){

        const menuAbierto = estructura.classList.toggle("menu-abierto");

    });

    /* cerrar el menu al pulsar el fondo */

    fondoMenu.addEventListener("click", function (){

        estructura.classList.remove("menu-abierto");


    });
}
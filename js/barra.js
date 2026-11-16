// Seleccionar el boton 

const botonMenu = document.getElementById("boton-menu");

// Seleccionar la estructura principal

const estructura = document.querySelector(".estructura-administrativa");

// Seleccionar el fondo oscuro 

const fondoMenu = document.getElementById("fondo-menu");

// Abrir y cerrar el menu

botonMenu.addEventListener("click", function (){
    estructura.classList.toggle("menu-abierto");

    const menuAbierto = estructura.classList.contains("menu-abierto");

    botonMenu.setAttribute("aria-expanded", menuAbierto)
})

// Cerrar el menu al pulsar la pantalla

fondoMenu.addEventListener("click", function (){
    estructura.classList.remove("menu-abierto");

    botonMenu.setAttribute("aria-expanded", "false")
})
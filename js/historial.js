// Filtros del historial

// Seleccionar los botones de los filtros

const filtroTodos = document.getElementById("filtro-todos");

const filtroIngresos = document.getElementById("filtro-ingresos");

const filtroSalidas = document.getElementById("filtro-salidas");

// Seleccionar las filas de la tabla

const filasHistorial = document.querySelectorAll(".tabla-ultimos-registros tbody tr");

// Funcion para filtar los registros

function filtrarMovimientos(tipo) {

    filasHistorial.forEach(function (fila) {

        const movimiento = fila.querySelector(".movimiento");

        if (tipo === "todos" ||
            movimiento.classList.contains(tipo)) {

            fila.style.display = "";

        } else {

            fila.style.display = "none";

        }

    });

}

// Eventos de los filtros

filtroTodos.addEventListener("click", function () {
    filtrarMovimientos("todos");
});

filtroIngresos.addEventListener("click", function () {
    filtrarMovimientos("ingreso");
});

filtroSalidas.addEventListener("click", function () {
    filtrarMovimientos("salida");
});
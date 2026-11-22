

/* carga la navegación del administrador */
fetch("../components/nav.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    });

    /* carga la navegación del vigilante */
    fetch("../components/nav_vigilante.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header-vigilante").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    });

    /* carga la navegación del usuario */
    fetch("../components/nav_usuarios.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header-usuario").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    });
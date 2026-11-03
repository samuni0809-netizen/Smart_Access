

fetch("../components/nav.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    })

    fetch("../components/nav_vigilante.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegación-header_vigilante").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    })

    fetch("../components/nav_usuario.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header_Usuario").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    })
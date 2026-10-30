

fetch("../components/nav.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    })

    fetch("../components/nav_vigilante.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegación-header_vigilante").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    })

    fetch("../components/nav_usuario.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header_Usuario").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegación: ", error)
    })
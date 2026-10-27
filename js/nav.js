

fetch("../components/nav.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegació: ", error)
    })

    fetch("../components/nav_celador.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header_celador").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegació: ", error)
    })

    fetch("../components/nav_usuario.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("navegacion-header_Usuario").innerHTML = data;
    })
    .catch(error => {
        console.error("Error en cargar la navegació: ", error)
    })
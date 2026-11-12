// 1. Identificar los botones
const btnLogin = document.getElementById("btn-login");
const btnRegistro = document.getElementById("btn-registro");

// 2. Identificar los formularios
const formularioLogin = document.getElementById("formulario-login");
const formularioRegistro = document.getElementById("formulario-registro");

// 3. Cuando se presiona Iniciar Sesión
btnLogin.addEventListener("click", function () {
    formularioLogin.hidden = false;
    formularioRegistro.hidden = true;

    btnLogin.classList.add("active");
    btnRegistro.classList.remove("active");
});

// 4. Cuando se presiona Registrarse
btnRegistro.addEventListener("click", function () {
    formularioLogin.hidden = true;
    formularioRegistro.hidden = false;

    btnRegistro.classList.add("active");
    btnLogin.classList.remove("active");
});

// 5. Pestaña inicial seleccionada
btnLogin.classList.add("active");
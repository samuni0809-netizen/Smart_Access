/* 1. identificar los botones */
const btnLogin = document.getElementById("btn-login");
const btnRegistro = document.getElementById("btn-registro");

/* 2. identificar los formularios */
const formularioLogin = document.getElementById("formulario-login");
const formularioRegistro = document.getElementById("formulario-registro");

/* 3. cuando se presiona iniciar sesión */
btnLogin.addEventListener("click", function () {
    formularioLogin.hidden = false;
    formularioRegistro.hidden = true;

    btnLogin.classList.add("active");
    btnRegistro.classList.remove("active");
});

/* 4. cuando se presiona registrarse */
btnRegistro.addEventListener("click", function () {
    formularioLogin.hidden = true;
    formularioRegistro.hidden = false;

    btnRegistro.classList.add("active");
    btnLogin.classList.remove("active");
});

/* 5. pestaña inicial seleccionada */
btnLogin.classList.add("active");

document.addEventListener('DOMContentLoaded', function () {
    const botonesEditar = document.querySelectorAll('.boton-editar-registro');

    const campoId = document.getElementById('editar-id-usuario');
    const campoNombres = document.getElementById('editar-nombre');
    const campoApellidos = document.getElementById('editar-apellido');
    const campoDocumento = document.getElementById('editar-documento');
    const campoCorreo = document.getElementById('editar-correo');
    const campoEstado = document.getElementById('editar-estado');
    const campoCentro = document.getElementById('editar-centro');
    const campoTipo = document.getElementById('editar-tipo');
    const campoRol = document.getElementById('editar-rol');

    botonesEditar.forEach(function (boton) {
        boton.addEventListener('click', function () {
            campoId.value = boton.dataset.id;
            campoNombres.value = boton.dataset.nombres;
            campoApellidos.value = boton.dataset.apellidos;
            campoDocumento.value = boton.dataset.documento;
            campoCorreo.value = boton.dataset.correo;
            campoEstado.value = boton.dataset.estado;
            campoCentro.value = boton.dataset.centro;
            campoTipo.value = boton.dataset.tipoCuenta;
            campoRol.value = boton.dataset.idRol;
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var filas = document.querySelectorAll("table tbody tr");

    filas.forEach(function(fila) {
        var editarBtn = fila.querySelector(".editar");
        var eliminarBtn = fila.querySelector(".eliminar");
        var guardarBtn = fila.querySelector(".guardar");
        var cancelarEditarBtn = fila.querySelector(".cancelarEditar");
        var confirmarEliminarBtn = fila.querySelector(".confirmarEliminar");
        var cancelarEliminarBtn = fila.querySelector(".cancelarEliminar");
        var labelNombres = fila.querySelector(".label_nombres");
        var labelTelefono = fila.querySelector(".label_telefono");
        var labelCorreo = fila.querySelector(".label_correo");
        var inputNombre = fila.querySelector(".input_nombre");
        var inputApellido1 = fila.querySelector(".input_apellido1");
        var inputApellido2 = fila.querySelector(".input_apellido2");
        var inputTelefono = fila.querySelector(".input_telefono");
        var inputCorreo = fila.querySelector(".input_correo");

        fila.addEventListener("click", function(event) {
            var botonClickeado = event.target;
            var fila = botonClickeado.closest("tr");

            if (botonClickeado.classList.contains("editar")) {
                // Ocultar botón editar y mostrar guardar y cancelar
                editarBtn.classList.add("hidden");
                eliminarBtn.classList.add("hidden");
                guardarBtn.classList.remove("hidden");
                cancelarEditarBtn.classList.remove("hidden");

                labelNombres.classList.add("hidden");
                inputNombre.classList.remove("hidden");
                labelTelefono.classList.add("hidden");
                inputTelefono.classList.remove("hidden");
                labelCorreo.classList.add("hidden");
                inputCorreo.classList.remove("hidden");
            } else if (botonClickeado.classList.contains("cancelarEditar")) {
                // Ocultar guardar y cancelar, mostrar editar
                guardarBtn.classList.add("hidden");
                cancelarEditarBtn.classList.add("hidden");
                editarBtn.classList.remove("hidden");
                eliminarBtn.classList.remove("hidden");

                labelNombres.classList.remove("hidden");
                inputNombre.classList.add("hidden");
                labelTelefono.classList.remove("hidden");
                inputTelefono.classList.add("hidden");
                labelCorreo.classList.remove("hidden");
                inputCorreo.classList.add("hidden");
            } else if (botonClickeado.classList.contains("guardar")) {
                // Aquí deberías enviar los datos al servidor para guardar los cambios
                // Puedes hacerlo utilizando AJAX o un formulario submit, dependiendo de tu preferencia

                // Ocultar guardar y cancelar, mostrar editar
                guardarBtn.classList.add("hidden");
                cancelarEditarBtn.classList.add("hidden");
                editarBtn.classList.remove("hidden");
                eliminarBtn.classList.remove("hidden");

                labelNombres.classList.remove("hidden");
                inputNombre.classList.add("hidden");
                labelTelefono.classList.remove("hidden");
                inputTelefono.classList.add("hidden");
                labelCorreo.classList.remove("hidden");
                inputCorreo.classList.add("hidden");
            }
        });
    });
});


// Función para mostrar la alerta
function mostrarAlerta() {
    // Obtener el contenedor de la alerta
    var alerta = document.getElementById('alerta');

    // Mostrar la alerta
    alerta.style.display = 'block';

    // Cerrar la alerta después de 5 segundos (5000 milisegundos)
    setTimeout(function() {
        alerta.style.display = 'none';
    }, 5000); // Cambia este valor si deseas que la alerta se muestre durante más o menos tiempo
}
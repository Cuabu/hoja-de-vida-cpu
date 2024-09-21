// Esperar a que el documento esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencia al botón de abrir modal
    var btnAbrirModal = document.getElementById('btnAbrirModal');

    // Agregar evento de clic al botón
    btnAbrirModal.addEventListener('click', function () {
        // Mostrar el modal
        $('#modalAlertas').modal('show');

        // Aquí puedes agregar la lógica para cargar las alertas dinámicamente
        cargarAlertas(); // Esta función debe cargar las alertas desde la base de datos o alguna fuente de datos
    });
});

// Función para cargar las alertas (simulación de datos)
function cargarAlertas() {
    // Aquí puedes hacer una solicitud AJAX para obtener las alertas desde el servidor
    // Por ahora, simplemente simularemos algunos datos de alerta
    var alertas = [
        "Alerta 1: Consumo alto de CPU",
        "Alerta 2: Memoria RAM al 90%",
        "Alerta 3: Disco duro próximo al límite de capacidad"
    ];

    // Limpiar el contenido anterior
    var contenidoAlertas = document.getElementById('contenidoAlertas');
    contenidoAlertas.innerHTML = '';

    // Agregar cada alerta al modal
    alertas.forEach(function (alerta) {
        var p = document.createElement('p');
        p.textContent = alerta;
        contenidoAlertas.appendChild(p);
    });
}

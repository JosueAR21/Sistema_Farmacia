// Seleccionar elementos del DOM
const toggleButton = document.getElementById("toggleButton");
const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const navItems = document.querySelectorAll('.nav-item1');
const darkModeToggle = document.getElementById("darkModeToggle");
const darkModeStylesheet = document.getElementById("dark-mode-stylesheet");

// Función para aplicar el modo oscuro según el estado del checkbox
function applyDarkMode(isDarkMode) {
    if (isDarkMode) {
        darkModeStylesheet.removeAttribute('disabled'); // Habilitar modo oscuro
        darkModeToggle.checked = true; // Marcar el checkbox como seleccionado
    } else {
        darkModeStylesheet.setAttribute('disabled', ''); // Deshabilitar modo oscuro
        darkModeToggle.checked = false; // Desmarcar el checkbox
    }
}

// Alternar la barra lateral y el contenido
document.getElementById("toggleButton").addEventListener("click", function() {
    const sidebar = document.querySelector(".sidebar");
    const content = document.querySelector(".content");

    sidebar.classList.toggle("hidden");

    // Alterna la clase `fullwidth` para el contenido cuando el sidebar está oculto
    if (sidebar.classList.contains("hidden")) {
        content.classList.add("fullwidth");
    } else {
        content.classList.remove("fullwidth");
    }
});


// Evento para el interruptor de modo oscuro
darkModeToggle.addEventListener('change', function () {
    const isChecked = this.checked; // Obtener el estado del checkbox
    applyDarkMode(isChecked); // Aplicar el modo oscuro según el estado del checkbox

    // Guardar la preferencia del usuario en localStorage
    localStorage.setItem('darkMode', isChecked);
});

// Activar el elemento del menú
navItems.forEach(item => {
    item.addEventListener('click', () => {
        navItems.forEach(i => i.classList.remove('active')); // Eliminar la clase activa de otros elementos
        item.classList.add('active'); // Activar el elemento seleccionado
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Verificar la preferencia de modo oscuro al cargar la página
    const darkModePreference = localStorage.getItem('darkMode') === 'true'; // Obtener la preferencia
    applyDarkMode(darkModePreference); // Aplicar el modo oscuro

    const links = document.querySelectorAll('.nav-link1'); // Seleccionar enlaces de navegación

    links.forEach(link => {
        link.addEventListener('click', function () {
            // Primero, remueve la clase 'active' de todos los enlaces
            links.forEach(link => link.classList.remove('active'));

            // Luego, agrega la clase 'active' al enlace actual
            this.classList.add('active');

            // No se evita el comportamiento predeterminado, así que navegará a la URL
        });
    });
});



function toggleDarkModeChart(isDarkMode) {
    ventasChart.options.scales.x.grid.color = isDarkMode ? "rgba(255, 255, 255, 0.1)" : "rgba(0, 0, 0, 0.1)";
    ventasChart.options.scales.x.grid.borderColor = isDarkMode ? "#FFFFFF" : "#ccc";
    ventasChart.options.scales.y.grid.color = isDarkMode ? "rgba(255, 255, 255, 0.1)" : "rgba(0, 0, 0, 0.1)";
    ventasChart.options.scales.y.grid.borderColor = isDarkMode ? "#FFFFFF" : "#ccc";
    ventasChart.update();
}

// Configurar y cargar el modo oscuro inicial
const darkModeToggle2 = document.getElementById("darkModeToggle");
const savedDarkMode = localStorage.getItem("darkMode") === "true"; // Cargar preferencia del usuario
darkModeToggle2.checked = savedDarkMode; // Marcar el checkbox si está guardado en true
toggleDarkModeChart(savedDarkMode); // Aplicar el modo inicial al gráfico

// Evento para el interruptor de modo oscuro
darkModeToggle.addEventListener('change', function () {
    const isDarkMode = this.checked;
    localStorage.setItem("darkMode", isDarkMode); // Guardar preferencia en localStorage
    toggleDarkModeChart(isDarkMode); // Aplicar los cambios del gráfico en modo oscuro
});
// Verificar la preferencia de modo oscuro al cargar la página
window.onload = function () {
    const isDarkMode = localStorage.getItem('darkMode') === 'true'; // Obtener el estado guardado
    applyDarkMode(isDarkMode); // Aplicar modo oscuro según la preferencia guardada
    toggleDarkModeChart(isDarkMode);
};

function confirmarAnulacion() {
    var modalEl = document.getElementById('anularModal');
    var modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide();
    var toastEl = document.getElementById('toastAnulacion');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
    setTimeout(function () {
        toast.hide();
    }, 5000);
}


document.getElementById('limpiarForm').addEventListener('click', function() {
    // Obtener el formulario
    const formulario = document.getElementById('formEditarCliente'); // Cambia 'miFormulario' al ID de tu formulario
    
    // Reiniciar todos los campos del formulario
    formulario.reset();
});
function confirmarEliminar(idCliente) {
    if (confirm("¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.")) {
        // Redirigir al controlador con el ID del cliente y la acción "delete"
        window.location.href = `http://localhost/Ekuifarm-Frontend/controller/clienteController/clienteController.php?action=delete&id=${idCliente}`;
    }
}


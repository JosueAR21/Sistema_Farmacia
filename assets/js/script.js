
// Seleccionar elementos del DOM
const toggleButton = document.getElementById("toggleButton");
const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const navItems = document.querySelectorAll('.nav-item');
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
toggleButton.addEventListener("click", () => {
    sidebar.classList.toggle("active"); // Alternar clase activa en la barra lateral
    sidebar.classList.toggle("hidden"); // Alternar clase oculta en la barra lateral
    content.classList.toggle("fullwidth"); // Alternar clase para que el contenido ocupe todo el ancho
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

// Cargar contenido dinámicamente al hacer clic en un enlace
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav-link'); // Seleccionar enlaces de navegación

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

            const url = this.getAttribute('href'); // Obtener la URL del enlace

            // Cargar contenido usando fetch
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok'); // Lanzar un error si la respuesta no es correcta
                    }
                    return response.text(); // Convertir la respuesta a texto
                })
                .then(html => {
                    document.getElementById('content').innerHTML = html; // Cargar contenido en el contenedor

                    // Reaplicar configuraciones de modo oscuro después de cargar nuevo contenido
                    const isDarkMode = localStorage.getItem('darkMode') === 'true'; // Verificar el estado guardado
                    applyDarkMode(isDarkMode); // Aplicar modo oscuro según la preferencia guardada
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error); // Manejar errores de la operación fetch
                });
        });
    });
});

// Configurar gráficos
const ctx1 = document.getElementById("ventasChart").getContext("2d"); // Contexto para el gráfico de ventas
const ventasChart = new Chart(ctx1, {
    type: "bar", // Cambiar tipo según sea necesario
    data: {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"], // Etiquetas del gráfico
        datasets: [{
            label: "Ventas",
            data: [120, 190, 300, 500, 200, 300], // Datos de ventas
            backgroundColor: "skyblue", // Color de fondo
            borderColor: "white", // Color del borde
            borderWidth: 1, // Ancho del borde
        }],
    },
    options: {
        responsive: true, // Hacer el gráfico responsivo
        scales: {
            y: {
                beginAtZero: true, // Iniciar el eje Y en cero
            },
        },
    },
});

// Configurar segundo gráfico
const ctx2 = document.getElementById("productosChart").getContext("2d"); // Contexto para el gráfico de productos
const productosChart = new Chart(ctx2, {
    type: "pie", // Cambiar a 'doughnut' si se prefiere
    data: {
        labels: ["Producto A", "Producto B", "Producto C", "Producto D"], // Etiquetas del gráfico
        datasets: [{
            label: "Productos",
            data: [30, 25, 20, 25], // Datos de productos
            backgroundColor: [
                "rgba(255, 99, 132, 0.5)", // Colores de fondo
                "rgba(54, 162, 235, 0.5)",
                "rgba(255, 206, 86, 0.5)",
                "rgba(75, 192, 192, 0.5)",
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)", // Colores del borde
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
            ],
            borderWidth: 1, // Ancho del borde
        }],
    },
    options: {
        responsive: true, // Hacer el gráfico responsivo
        plugins: {
            legend: {
                position: "left", // Posición de la leyenda
            },
            title: {
                display: true, // Mostrar título
                text: "Distribución de Productos", // Texto del título
            },
        },
    },
});

// Verificar la preferencia de modo oscuro al cargar la página
window.onload = function() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true'; // Obtener el estado guardado
    applyDarkMode(isDarkMode); // Aplicar modo oscuro según la preferencia guardada
};

function confirmarAnulacion() {
    var modalEl = document.getElementById('anularModal');
    var modal = bootstrap.Modal.getInstance(modalEl);
    modal.hide(); 
    var toastEl = document.getElementById('toastAnulacion');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
    setTimeout(function() {
        toast.hide(); 
    }, 5000);
}

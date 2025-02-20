document.addEventListener('DOMContentLoaded', function () {
    // Inicializa los campos de precios al cargar la página
    actualizarCampos();

    // Agregar eventos para cambiar el producto y la cantidad
    document.getElementById("producto").addEventListener("change", actualizarCampos);
    document.getElementById("cantidad").addEventListener("input", calcularTotal);
});

function actualizarCampos() {
    const select = document.getElementById("producto");
    const selectedOption = select.options[select.selectedIndex]; // Obtener la opción seleccionada
    const precioUnitario = parseFloat(selectedOption.getAttribute("data-precio")); // Obtener el precio desde data-precio

    // Actualizar los campos de precio
    document.getElementById("precioBruto").innerText = "Precio Bruto: $" + precioUnitario.toFixed(2);
    document.getElementById("precioUnitario").innerText = "Precio Unitario: $" + precioUnitario.toFixed(2);
    
    // Calcular el total con la cantidad actual
    calcularTotal();
}

function calcularTotal() {
    const select = document.getElementById("producto");
    const selectedOption = select.options[select.selectedIndex]; // Obtener la opción seleccionada
    const precioUnitario = parseFloat(selectedOption.getAttribute("data-precio")); // Obtener el precio desde data-precio
    const cantidad = parseInt(document.getElementById("cantidad").value) || 0;

    const total = precioUnitario * cantidad;
    document.getElementById("total").innerText = "Total: $" + total.toFixed(2);
}
function agregarAlCarrito() {
    const select = document.getElementById("producto");
    const cantidad = parseInt(document.getElementById("cantidad").value) || 0;
    const nombreProducto = select.options[select.selectedIndex].text;
    const precioUnitario = parseFloat(select.value);
    const total = precioUnitario * cantidad;

    // Crear un nuevo elemento de lista para el carrito
    const carrito = document.getElementById("carrito");
    const nuevoElemento = document.createElement("li");

    nuevoElemento.classList.add("list-group-item");
    nuevoElemento.innerHTML = `
        ${nombreProducto} - Cantidad: ${cantidad} - Precio: $${precioUnitario.toFixed(2)} - Total: $${total.toFixed(2)}
    `;

    carrito.appendChild(nuevoElemento);
    
    // Limpiar los campos
    select.selectedIndex = 0; // Selecciona la opción por defecto
    document.getElementById("cantidad").value = 1; // Resetea la cantidad a 1
    document.getElementById("precioBruto").innerText = "Precio Bruto: $0.00"; // Resetea el precio
    document.getElementById("precioUnitario").innerText = "Precio Unitario: $0.00";
    document.getElementById("total").innerText = "Total: $0.00";
}

function actualizarIdCliente() {
    var select = document.getElementById("cliente");
    var idCliente = select.options[select.selectedIndex].value;
    document.getElementById("id_cliente").value = idCliente;
}
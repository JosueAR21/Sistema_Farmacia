function cambiarTitulo(accion) {
    const titulo = document.querySelector('.action');
    switch (accion) {
        case 'register':
            titulo.textContent = 'REGISTRO DE PRODUCTOS';
            break;
        case 'edit':
            titulo.textContent = 'EDITAR PRODUCTO';
            break;
        case 'delete':
            titulo.textContent = 'ELIMINAR PRODUCTO';
            break;
        default:
            titulo.textContent = 'REGISTRO DE PRODUCTOS';
    }
}

function llenarFormulario(idProducto, nombre, descripcion, idCategoria, idMarca, precio, stock) {
    document.getElementById("idProducto").value = idProducto;
    document.getElementById("nombre").value = nombre;
    document.getElementById("descripcion").value = descripcion;
    document.getElementById("categoria").value = idCategoria; // Asumiendo que idCategoria corresponde al valor del option
    document.getElementById("marca").value = idMarca; // Asumiendo que idMarca corresponde al valor del option
    document.getElementById("precio").value = precio;
    document.getElementById("stock").value = stock;

    document.getElementById("action").value = "edit"; // Si necesitas un valor de acción
    document.getElementById("btnCancelar").style.display = 'inline-block';
    document.getElementById("btnSubmit").textContent = "Guardar"; // Actualiza el texto del botón
    cambiarTitulo('edit');
}

function cancelarEdicion() {
    document.getElementById("idProducto").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("categoria").value = "";
    document.getElementById("marca").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("stock").value = "";

    document.getElementById("action").value = "register";
    document.getElementById("btnSubmit").textContent = "Registrar";
    document.getElementById("btnCancelar").style.display = 'none';
    cambiarTitulo('register');
}
function mostrarAlerta(status, mensaje) {
    if (status === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    }
}

document.getElementById('limpiarForm').addEventListener('click', function() {
    document.getElementById('formEditarProducto').reset();
    document.getElementById("action").value = "register";
    document.getElementById("btnSubmit").textContent = "Registrar";
    cambiarTitulo('register');
});
function confirmarEliminar(idProducto) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.")) {
        // Redirigir a la URL de eliminación
        window.location.href = `http://localhost/Ekuifarm-Frontend/controller/productoController/productoController.php?action=delete&id=${idProducto}`;
    }
}

$(document).ready(function() {
    table = $('#tablaProductos').DataTable({
        ajax: {
            url: 'http://localhost//Ekuifarm-Frontend/controller/productoController/productoController.php?ajax=productos', // Cambia esto a la ruta de tu controlador
            dataSrc: 'data' // Especifica que los datos están en el campo 'data'
        },
        columns: [{
                data: 'Id'
            },
            {
                data: 'Nombre'
            },
            {
                data: 'Descripcion'
            },
            {
                data: 'Id_Categoria'
            },
            {
                data: 'Id_Marca'
            },
            {
                data: 'Precio'
            },
            {
                data: 'Stock'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
<button type="button" class="btn btn-success" onclick="llenarFormulario(${row.Id}, '${row.Nombre}', '${row.Descripcion}', ${row.Id_Categoria}, ${row.Id_Marca}, ${row.Precio}, ${row.Stock})">
    <i class="fa-regular fa-pen-to-square"></i>
</button>
<button type="button" class="btn btn-danger" onclick="confirmarEliminar(${row.Id})">
    <i class="fa-regular fa-trash-can"></i>
</button>
`;
                }
            }
        ],
        paging: true,
        pageLength: 10,
        lengthChange: false,
        searching: true,
        ordering: false,
        info: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    });

    $('#tablaProductos').on('draw.dt', function() {
        var info = table.page.info();
        $('#total-registros').text(`Total de registros: ${info.recordsTotal}`);
    });
});
$('#formEditarProducto').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url: 'http://localhost/Ekuifarm-Frontend/controller/productoController/productoController.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            const res = JSON.parse(response);
            mostrarAlerta(res.status, res.message);
            if (res.status === 'success') {
                $('#formEditarProducto')[0].reset();
                table.ajax.reload();
            }
        },
        error: function() {
            mostrarAlerta('error', 'Error al procesar la solicitud.');
        }
    });
})
window.confirmarEliminar = function(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'http://localhost/Ekuifarm-Frontend/controller/productoController/productoController.php',
                method: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    mostrarAlerta(res.status, res.message);
                    if (res.status === 'success') {
                        table.ajax.reload();
                    }
                },
                error: function() {
                    mostrarAlerta('error', 'Error al eliminar el producto.');
                }
            });
        }
    });
};

function mostrarAlerta(status, mensaje) {
    if (status === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    }
}
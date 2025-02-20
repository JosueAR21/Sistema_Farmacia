$(document).ready(function() {
    const table = $('#tablaClientes').DataTable({
        ajax: {
            url: 'http://localhost/Ekuifarm-Frontend/controller/clienteController/clienteController.php?ajax=clientes',
            dataSrc: 'data'
        },
        columns: [{
                data: 'Id'
            },
            {
                data: 'Nombre'
            },
            {
                data: 'Apellido'
            },
            {
                data: 'Telefono'
            },
            {
                data: 'Email'
            },
            {
                data: 'Dirección'
            },
           
            {
                data: null,
                render: function(data) {
                    return `
                    <button type="button" class="btn btn-success" onclick="abrirModal(${data.Id}, '${data.Nombre}', '${data.Apellido}', '${data.Telefono}', '${data.Email}', '${data.Dirección}')">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="confirmarEliminar(${data.Id})">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>`;
                }
            }
        ],
        paging: true,
    pageLength: 10,
    lengthChange: false,
    searching: true,
    ordering: false,
    info: true,
    });

    $('#formEditarCliente').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'http://localhost/Ekuifarm-Frontend/controller/clienteController/clienteController.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response);
                mostrarAlerta(res.success ? 'success' : 'error', res.message);
                if (res.success) {
                    $('#formEditarCliente')[0].reset();
                    table.ajax.reload();
                }
            },
            error: function() {
                mostrarAlerta('error', 'Error al procesar la solicitud.');
            }
        });
    });

    window.confirmarEliminar = function(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'http://localhost/Ekuifarm-Frontend/controller/clienteController/clienteController.php',
                    method: 'POST',
                    data: {
                        action: 'delete',
                        id: id
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        mostrarAlerta(res.success ? 'success' : 'error', res.message);
                        if (res.success) {
                            table.ajax.reload();
                        }
                    },
                    error: function() {
                        mostrarAlerta('error', 'Error al eliminar el cliente.');
                    }
                });
            }
        });
    };

    function mostrarAlerta(status, mensaje) {
        Swal.fire({
            icon: status === 'success' ? 'success' : 'error',
            title: status === 'success' ? 'Éxito' : 'Error',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    }
});
function cambiarTitulo(accion) {
const titulo = document.querySelector('.action');
switch (accion) {
    case 'register':
        titulo.textContent = 'REGISTRO DE CLIENTES';
        break;
    case 'edit':
        titulo.textContent = 'EDITAR CLIENTE';
        break;
    case 'delete':
        titulo.textContent = 'ELIMINAR CLIENTE';
        break;
    default:
        titulo.textContent = 'REGISTRO DE CLIENTES';
}

}
function abrirModal(idCliente, nombre, apellido, telefono, email, direccion) {
    // Llenar los campos del formulario con los datos del cliente
    document.getElementById("idCliente").value = idCliente;
    document.getElementById("nombre").value = nombre;
    document.getElementById("apellido").value = apellido;
    document.getElementById("telefono").value = telefono;
    document.getElementById("email").value = email;
    document.getElementById("direccion").value = direccion;

    // Cambiar la acción a "edit" en modo de edición
    document.getElementById("action").value = "edit";
    document.getElementById("btnSubmit").textContent = "Guardar";
    document.getElementById("btnCancelar").style.display = 'inline-block'; // Muestra el botón
    cambiarTitulo('edit');
}

function cancelarEdicion() {
    document.getElementById("idCliente").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("apellido").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("email").value = "";
    document.getElementById("direccion").value = "";
    document.getElementById("action").value = "register";
    document.getElementById("btnSubmit").textContent = "Registrar";

    document.getElementById("btnCancelar").style.display = 'none';
    cambiarTitulo('register');
}
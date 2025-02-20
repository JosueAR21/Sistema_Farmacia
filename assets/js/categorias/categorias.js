$(document).ready(function() {
    const table = $('#tablaCategorias').DataTable({
        ajax: {
            url: 'http://localhost/Ekuifarm-Frontend/controller/categoriaController/categoriaController.php?ajax=categorias',
            dataSrc: 'data'
        },
        columns: [
            { data: 'Id' },
            { data: 'Nombre' },
            { data: 'Descripcion' },
            {
                data: null,
                render: function(data) {
                    return `
                    <button type="button" class="btn btn-success" onclick="abrirModal(${data.Id}, '${data.Nombre}', '${data.Descripcion}')">
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

    $('#formCategoria').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'http://localhost/Ekuifarm-Frontend/controller/categoriaController/categoriaController.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response);
                mostrarAlerta(res.success ? 'success' : 'error', res.message);
                if (res.success) {
                    $('#formCategoria')[0].reset();
                    table.ajax.reload();
                    cancelarEdicion();
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
                    url: 'http://localhost/Ekuifarm-Frontend/controller/categoriaController/categoriaController.php',
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
                        mostrarAlerta('error', 'Error al eliminar la categoría.');
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
    const titulo = document.getElementById('formTitle');
    switch (accion) {
        case 'register':
            titulo.textContent = 'REGISTRAR CATEGORÍA';
            break;
        case 'edit':
            titulo.textContent = 'EDITAR CATEGORÍA';
            break;
    }
}

function abrirModal(idCategoria, nombre, descripcion) {
    document.getElementById("idCategoria").value = idCategoria;
    document.getElementById("nombre").value = nombre;
    document.getElementById("descripcion").value = descripcion;

    document.getElementById("action").value = "edit";
    document.getElementById("btnSubmit").textContent = "Guardar";
    document.getElementById("btnCancelar").style.display = 'inline-block';
    cambiarTitulo('edit');
}

function cancelarEdicion() {
    document.getElementById("idCategoria").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("action").value = "register";
    document.getElementById("btnSubmit").textContent = "Registrar";
    document.getElementById("btnCancelar").style.display = 'none';
    cambiarTitulo('register');
}
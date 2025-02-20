<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/rol/rolController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');

$roles = $model->obtenerRoles(); // Asegúrate de que esto esté en el controlador adecuado
$vistas = [
    ['id' => 'itemProducts', 'nombre' => 'Productos', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/mantenimiento/productos/productos.php'],
    ['id' => 'itemClients', 'nombre' => 'Clientes', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/mantenimiento/clientes/clientes.php'],
    ['id' => 'itemEmployees', 'nombre' => 'Empleados', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/mantenimiento/empleados/empleados.php'],
    ['id' => 'itemRoles', 'nombre' => 'Roles', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/roles/roles.php'],
    ['id' => 'itemProveedores', 'nombre' => 'Proveedores', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/proveedores/proveedores.php'],
    ['id' => 'itemCategorias', 'nombre' => 'Categorías', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/mantenimiento/categorias/categorias.php'],
    ['id' => 'itemVentas', 'nombre' => 'Ventas', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/ventas/ventas.php'],
    ['id' => 'itemFacturacion', 'nombre' => 'Facturación', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/facturacion/facturacion.php'],
    ['id' => 'itemReportes', 'nombre' => 'Reportes', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/reportes/reportes.php'],
    ['id' => 'itemEstadoDeCuenta', 'nombre' => 'Estado de Cuenta', 'ruta' => 'http://localhost/Ekuifarm-Frontend/view/estadoDeCuenta/estadoDeCuenta.php'],
];


?>

<!doctype html>
<html lang="es">

<head>
    <title>Roles y Permisos</title>
    <link rel="stylesheet" href="http://localhost/Ekuifarm-Frontend/assets/css/productos.css">
    <link rel="stylesheet" href="http://localhost/Ekuifarm-Frontend/assets/css/darkmode.css" id="dark-mode-stylesheet" disabled>
    
</head>

<style>
    .estado-activo {
        color: green;
        background-color: lightgreen;
        padding: 4px;
        border-radius: 4px;
    }

    .estado-inactivo {
        color: white;
        background-color: red;
        padding: 4px;
        border-radius: 4px;
    }


    .view-switches {
        margin-left: 10px;
        /* Espaciado entre switches */
    }
</style>

<main class="content content-area">
    <div class="my-4 productos">
        <h2 class="mb-4 mt-5">Gestión de Roles y Permisos</h2>
        <div class="row">
            <div class="col-md-4">
                <section class="gestion-productos mb-4 p-4">
                    <h4 class="mb-4 productSection">ACCIONES</h4>
                    <div class="d-grid gap-2 botones2">
                        <button class="btn btn-primary" id="addRoleBtn">Añadir</button>

                    </div>
                </section>

                <section class="registrar-producto p-4">
                    <h4 class="productSection">REGISTRO DE ROLES</h4>
                    <form id="roleForm">
                        <input type="hidden" name="id" id="roleId">
                        <input type="hidden" name="action" id="roleAction" value="register">
                        <div class="mb-3">
                            <label class="form-label">Nombre del Rol:</label>
                            <input type="text" class="input" name="nombre" id="roleName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado:</label>
                            <select name="estado" id="roleStatus" class="input" style="font-size: 13px">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-md">Guardar Rol</button>
                    </form>
                </section>
            </div>

            <div class="col-md-8">
                <section class="lista-productos p-4">
                    <h4 class="mb-3 productSection">LISTADO DE ROLES</h4>
                    <div class="container mb-2">
                        <div class="table-wrapper">
                            <table class="table table-hover text-center" id="rolesTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NOMBRE</th>
                                        <th class="text-center">ESTADO</th>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- El contenido se llenará dinámicamente con AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal para Asignar Permisos -->
    <div id="permissionsModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar Permisos</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 id="rolNombre"></h6> <!-- Aquí se mostrará el nombre del rol -->
                    <div id="rolesContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="savePermissionsBtn" class="btn btn-primary">Guardar Permisos</button>
                </div>
            </div>
        </div>
    </div>

</main>



<script>
    $(document).ready(function() {
        const table = $('#rolesTable').DataTable({
            ajax: {
                url: 'http://localhost/Ekuifarm-Frontend/controller/rol/rolController.php?ajax=roles',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'Id'
                },
                {
                    data: 'Nombre'
                },
                {
                    data: 'Estado',
                    render: function(data) {
                        const estadoTexto = data === "0" ? 'Inactivo' : 'Activo';
                        const estadoClase = data === "0" ? 'estado-inactivo' : 'estado-activo';
                        return `<span class="${estadoClase}">${estadoTexto}</span>`;
                    }
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                            <button class="btn editRoleBtn btn-success btn-sm" data-id="${data.Id}" data-nombre="${data.Nombre}" data-estado="${data.Estado}"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="btn deleteRoleBtn btn-warning btn-sm" data-id="${data.Id}"><i class="fa-regular fa-square-minus" style='color: white;'></i></button>
                              <button id="assignPermissionsBtn" class="btn btn-primary btn-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#permissionsModal"
                data-id="${data.Id}" 
                data-nombre="${data.Nombre}">
            <i class="fa-solid fa-key"></i>
        </button>
                        `;
                    }
                }
            ]
        });

        // Manejo del formulario de roles
        $('#roleForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'http://localhost/Ekuifarm-Frontend/controller/rol/rolController.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const res = JSON.parse(response);
                    Swal.fire({
                        icon: res.status === 'success' ? 'success' : 'error',
                        title: res.status === 'success' ? 'Éxito' : 'Error',
                        text: res.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        if (res.status === 'success') {
                            $('#roleForm')[0].reset();
                            $('#roleStatus').val("1");
                            $('#roleAction').val('register');
                            table.ajax.reload();
                        }
                    });
                }
            });
        });

        // Editar rol
        $(document).on('click', '.editRoleBtn', function() {
            $('#roleId').val($(this).data('id'));
            $('#roleName').val($(this).data('nombre'));
            $('#roleStatus').val($(this).data('estado'));
            $('#roleAction').val('edit');
        });

        // Eliminar rol
        $(document).on('click', '.deleteRoleBtn', function() {
            const roleId = $(this).data('id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'El rol pasará a estado inactivo.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, anular',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('http://localhost/Ekuifarm-Frontend/controller/rol/rolController.php', {
                        action: 'deactivate',
                        id: roleId
                    }, function(response) {
                        const res = JSON.parse(response);
                        Swal.fire({
                            icon: res.status === 'success' ? 'success' : 'error',
                            title: res.status === 'success' ? 'Éxito' : 'Error',
                            text: res.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            table.ajax.reload();
                        });
                    });
                }
            });
        });

        // Abrir modal para asignar permisos
        // Abrir modal para asignar permisos
        // Abrir modal para asignar permisos
        // Abrir modal para asignar permisos
        $(document).on('click', '#assignPermissionsBtn', function() {
    const rolId = $(this).data('id'); // Obtén el ID del rol del botón
    console.log('ID del rol:', rolId);
    $('#rolesContainer').empty(); // Limpia el contenedor de roles
    $('#permissionsModal').modal('show'); // Abre el modal

    // Cargar el rol y permisos específicos
    cargarRolYPermisos(rolId);
});

function agregarPermisos(rol, permisos) {
    const rolHtml = `
    <div class="rol-container" data-rol-id="${rol.Id}">
        <h5>${rol.Nombre}</h5>
        <div class="permissions-container">
            ${permisos.map(permiso => `
                <div class="form-check form-switch">
                    <label class="form-check-label" for="permiso_${rol.Id}_${permiso.vista}">${permiso.vista}</label>
                    <input class="form-check-input" type="checkbox" id="permiso_${rol.Id}_${permiso.vista}" 
                        ${permiso.acceso == 1 ? 'checked' : ''} 
                        data-vista="${permiso.vista}" data-rol-id="${rol.Id}">
                </div>
            `).join('')}
        </div>
    </div>`;

    $('#rolesContainer').append(rolHtml);
}

function cargarRolYPermisos(rolId) {
    $.ajax({
        url: `http://localhost/Ekuifarm-Frontend/controller/rol/rolController.php?ajax=roles2&rolId=${rolId}`,
        method: 'GET',
        success: function(response) {
            const rolesResponse = JSON.parse(response);
            console.log(rolesResponse); // Verificar la estructura de la respuesta

            if (rolesResponse.data) {
                // Mostrar el nombre del rol
                $('#rolNombre').text(rolesResponse.data.Nombre); // Asegúrate de tener un elemento con este ID en tu modal

                // Agregar los switches para los permisos
                agregarPermisos(rolesResponse.data, rolesResponse.data.Permisos);
            } else {
                console.error('No se encontraron datos para el rol.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar rol:', error);
        }
    });
}


$(document).on('click', '#savePermissionsBtn', function() {
    const permisos = [];
    
    // Recoger los permisos seleccionados de los checkboxes
    $('#rolesContainer .rol-container').each(function() {
        const rolId = $(this).data('rol-id'); // Obtén el ID del rol del contenedor de rol
        $(this).find('input[type="checkbox"]').each(function() {
            const vista = $(this).data('vista');
            const acceso = $(this).is(':checked') ? 1 : 0; // Cambia a 1 o 0

            permisos.push({
                rol_id: rolId,
                vista: vista,
                acceso: acceso // Asegúrate de que esto sea 0 o 1
            });
        });
    });

    // Enviar la solicitud AJAX para guardar los permisos
    $.ajax({
        type: "POST",
        url: "http://localhost/Ekuifarm-Frontend/controller/rol/rolController.php",
        data: {
            action: "assignPermissions",
            permisos: JSON.stringify(permisos)
        },
        success: function(response) {
            console.log(response);
            
            // Mostrar una notificación de éxito usando SweetAlert
            Swal.fire({
                title: 'Éxito',
                text: 'Permisos asignados correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                // Si el usuario hace clic en "Aceptar", cerramos el modal
                if (result.isConfirmed) {
                    // Cerrar el modal (si estás usando un modal de Bootstrap, por ejemplo)
                    $('#permissionsModal').modal('hide'); // Asegúrate de que el ID de tu modal sea 'permissionsModal'
                }
            });

            // Actualizar la visibilidad del menú después de asignar permisos
            updateMenuVisibility(permisos);
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            
            // Mostrar una notificación de error
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al asignar los permisos.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });
});


// Función para actualizar la visibilidad de los menús
// Actualizar la visibilidad del menú después de asignar permisos
function updateMenuVisibility(permisos) {
    // Recargar los permisos desde la base de datos
    $.ajax({
        type: "GET",
        url: "http://localhost/Ekuifarm-Frontend/controller/rol/rolController.php",
        data: {
            action: "getPermissions" // Llamar a una acción para obtener los permisos guardados
        },
        success: function(response) {
            const permisosGuardados = JSON.parse(response);
            // Ahora actualizamos la visibilidad de los menús basándonos en los permisos guardados
            $('.menu-item').each(function() {
                const vista = $(this).data('vista'); // Obtener la vista asociada a este menú
                if (permisosGuardados.includes(vista)) {
                    $(this).show(); // Mostrar el menú si tiene permiso
                } else {
                    $(this).hide(); // Ocultar el menú si no tiene permiso
                }
            });
        }
    });
}


    });


    // Guardar cambios de permisos
</script>

</html>
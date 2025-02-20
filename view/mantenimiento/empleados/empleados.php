<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/logs.php');
include($_SERVER['DOCUMENT_ROOT'] . '/Ekuifarm-Frontend/controller/empleado/empleadoController.php');
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Módulo de Empleados</title>
    <link rel="stylesheet" href="http://localhost/Ekuifarm-Frontend/assets/css/productos.css">

</head>

<body>
    <main class="content content-area">
        <div class="my-4 productos">
            <h2 class="mb-4 mt-5 productSection">Módulo de Empleados</h2>
            <div class="row">
                <div class="col-md-4">
                    <section class="gestion-productos mb-4 p-4">
                        <h4 class="mb-4 productSection">ACCIONES</h4>
                        <button class="btn btn-primary" id="btnRegistrar">Añadir</button>
                        <button class="btn btn-danger" id="btnEliminar">Eliminar</button>
                        <button class="btn btn-success" id="btnEditar">Editar</button>
                        <button class="btn btn-secondary" id="limpiarForm">Limpiar</button>
                    </section>
                    <section class="registrar-producto p-4">
                        <h4 class="productSection mb-4 action">REGISTRO DE EMPLEADOS</h4>
                        <form id="formRegistrarEmpleado">
                            <input type="hidden" name="id" id="idEmpleado" value="" />
                            <input type="hidden" name="action" id="action" value="register">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">NOMBRE:</label>
                                <input type="text" class="input" name="nombre" id="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">APELLIDO:</label>
                                <input type="text" class="input" name="apellido" id="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_rol" class="form-label">ROL:</label>
                                <select class="input" name="id_rol" id="id_rol" required style="font-size: 13px">
                                    <option value="">Seleccione un rol</option>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= htmlspecialchars($rol['Id']); ?>"><?= htmlspecialchars($rol['Nombre']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">TELEFONO:</label>
                                <input type="tel" class="input" name="telefono" id="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">EMAIL:</label>
                                <input type="email" class="input" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="contraseña" class="form-label">CONTRASEÑA:</label>
                                <input type="password" class="input" name="contraseña" id="contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Registrar</button>
                            <button type="button" class="btn btn-secondary" id="btnCancelar" style="display:none;" onclick="cancelarEdicion()">Cancelar</button>
                        </form>
                    </section>
                </div>
                <div class="col-md-8">
                    <section class="lista-productos p-4">
                        <h4 class="mb-3 productSection">LISTA DE EMPLEADOS</h4>
                        <div class="table-wrapper">
                            <table class="table table-hover text-center" id="tablaEmpleados">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NOMBRE</th>
                                        <th class="text-center">APELLIDO</th>
                                        <th class="text-center">ID ROL</th>
                                        <th class="text-center">TELEFONO</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">CONTRASEÑA</th>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Se llenará con JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            table = $('#tablaEmpleados').DataTable({
                ajax: {
                    url: 'http://localhost/Ekuifarm-Frontend/controller/empleado/empleadoController.php?ajax=empleados',
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
                        data: 'Id_Rol'
                    },
                    {
                        data: 'Telefono'
                    },
                    {
                        data: 'Email'
                    },
                    { data: 'Contraseña' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                    <button type="button" class="btn btn-success" onclick="llenarFormulario(${row.Id}, '${row.Nombre}', '${row.Apellido}', ${row.Id_Rol}, '${row.Telefono}', '${row.Email}','${row.Contraseña}')">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="confirmarEliminar(${row.Id})">
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
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }
            });

            $('#tablaEmpleados').on('draw.dt', function() {
                var info = table.page.info();
                $('#total-registros').text(`Total de registros: ${info.recordsTotal}`);
            });

            function cambiarTitulo(accion) {
                const titulo = document.querySelector('.action');
                switch (accion) {
                    case 'register':
                        titulo.textContent = 'REGISTRO DE EMPLEADOS';
                        break;
                    case 'edit':
                        titulo.textContent = 'EDITAR EMPLEADO';
                        break;
                    case 'delete':
                        titulo.textContent = 'ELIMINAR EMPLEADO';
                        break;
                    default:
                        titulo.textContent = 'REGISTRO DE EMPLEADOS';
                }
            }
            $('#formRegistrarEmpleado').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'http://localhost/Ekuifarm-Frontend/controller/empleado/empleadoController.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        const res = JSON.parse(response);
                        mostrarAlerta(res.status, res.message);
                        if (res.status === 'success') {
                            $('#formRegistrarEmpleado')[0].reset();
                            table.ajax.reload();
                        }
                    },
                    error: function() {
                        mostrarAlerta('error', 'Error al registrar el empleado.');
                    }
                });
            });



            window.confirmarEliminar = function(idEmpleado) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede deshacer!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'http://localhost/Ekuifarm-Frontend/controller/empleado/empleadoController.php',
                            method: 'POST',
                            data: {
                                action: 'delete',
                                id: idEmpleado
                            },
                            success: function(response) {
                                const res = JSON.parse(response);
                                mostrarAlerta(res.status, res.message);
                                if (res.status === 'success') {
                                    table.ajax.reload();
                                }
                            },
                            error: function() {
                                mostrarAlerta('error', 'Error al eliminar el empleado.');
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

            document.getElementById('limpiarForm').addEventListener('click', function() {
                document.getElementById('formRegistrarEmpleado').reset();
                document.getElementById("action").value = "register"; // Restablecer acción a registrar
                document.getElementById("btnSubmit").textContent = "Registrar"; // Cambiar texto del botón a registrar
                cambiarTitulo('register'); // Cambiar título a "REGISTRO DE EMPLEADOS"
            });
        });

        function llenarFormulario(idEmpleado, nombre, apellido, idRol, telefono, email) {
            document.getElementById("idEmpleado").value = idEmpleado;
            document.getElementById("nombre").value = nombre;
            document.getElementById("apellido").value = apellido;
            document.getElementById("id_rol").value = idRol;
            document.getElementById("telefono").value = telefono;
            document.getElementById("email").value = email;
            document.getElementById("action").value = "edit"; // Cambiar acción a editar
            document.getElementById("btnCancelar").style.display = 'inline-block'; // Mostrar botón cancelar
            document.getElementById("btnSubmit").textContent = "Guardar"; // Cambiar texto del botón
            cambiarTitulo('edit'); // Cambiar título a "EDITAR EMPLEADO"
        };

        window.cancelarEdicion = function() {
            document.getElementById("idEmpleado").value = "";
            document.getElementById("nombre").value = "";
            document.getElementById("apellido").value = "";
            document.getElementById("id_rol").value = "";
            document.getElementById("telefono").value = "";
            document.getElementById("email").value = "";

            document.getElementById("action").value = "register"; // Restablecer acción a registrar
            document.getElementById("btnSubmit").textContent = "Registrar"; // Cambiar texto del botón a registrar
            document.getElementById("btnCancelar").style.display = 'none'; // Ocultar botón cancelar
            cambiarTitulo('register'); // Cambiar título a "REGISTRO DE EMPLEADOS"
        };
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>EkuiFarm - Sistema de Farmacia</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="login">
    <header class="ms-3 d-flex">
        <img src="./assets/img/logo.png" width="60px" height="50px">
        <h1 class="text-primary text-center mt-2" style="font-weight: 700; font-size: 30px;">EkuiFarm</h1>
    </header>

    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 d-flex justify-content-center mb-4 logo-container">
                    <img class="img-fluid logo" src="./assets/img/logo.png" alt="Logo" />
                </div>
                <div class="form col-12 col-md-6 d-flex p-5 justify-content-center">
                    <div class="w-100">
                        <h3 class="text-center" style="white-space: nowrap;">Sistema de Farmacia</h3>
                        <h6 class="text-center mb-5" style="white-space: normal; font-size: 13px">Sistema de gestión y inventario de ventas EkuiFarm</h6>

                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        <?php endif; ?>

                        <form id="loginForm">
                            <div class="mb-5">
                                <input type="text" class="input w-100" name="nombre" id="nombre" placeholder=" " required>
                                <label for="nombre" class="form-label floating-label">Usuario</label>
                            </div>
                            <div class="mb-5">
                                <input type="password" class="input w-100" name="contraseña" id="contraseña" placeholder=" " required>
                                <label for="contraseña" class="form-label floating-label">Contraseña</label>
                            </div>

                            <button type="submit" class="btn w-100 mt-3">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-2" style="font-weight: 700; background-color: #6499E9">
        <p class="mb-0 text-white" style="font-weight: 500;">
            &copy; 2024 EkuiFarm. Todos los derechos reservados.
        </p>
        <a href="#" class="text-white" style="font-weight: 500">Política de Privacidad</a>
    </footer>
      <script>
       document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío normal del formulario

    const formData = new FormData(this); // Obtener los datos del formulario

    fetch('http://localhost/Ekuifarm-Frontend/controller/loginController/loginController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Inspecciona el estado de la respuesta
        console.log('Response Status:', response.status);
        return response.json(); // Procesar la respuesta JSON
    })
    .then(data => {
        if (data.status === 'success') {
            // Mostrar SweetAlert de éxito
            Swal.fire({
                title: 'Éxito!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'Continuar'
            }).then(() => {
                // Redirigir después de cerrar la alerta
                window.location.href = 'http://localhost/Ekuifarm-Frontend/panelAdmin.php';
            });
        } else {
            // Mostrar SweetAlert de error
            Swal.fire({
                title: 'Error!',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'Intentar de nuevo'
            });
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        // Mostrar mensaje de error genérico
        Swal.fire({
            title: 'Error!',
            text: "Ocurrió un error al procesar la solicitud. Intente de nuevo más tarde.",
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
    });
});

      </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

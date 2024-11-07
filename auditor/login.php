<!DOCTYPE html>
<html lang="en">
<?php
include "../template/header.php";
include '../controller/business.php';

?>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
<link rel='stylesheet' href='../lib/sweetalert2.min.css'>

<body class="body_login">
    <form class="formloaud" id="envialoaud" name="envialoaud" action="../controller/actionLogin.php" method="post">
        <h1>Login Auditor</h1>
        <div class="formulario-grupo" id="grupo-correo" style="margin-bottom: 15px;">
            <label for="correo" class="formulario-label">Correo</label>
            <div class="formulario-grupo-input">
                <input class="campos" type="email" name="email" id="email" placeholder="correo@correo.com">
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">Correo inválido</p>
        </div>

        <div class="formulario-grupo" id="grupo-pas" style="margin-bottom: 15px;">
            <label for="correo" class="formulario-label">Contraseña</label>
            <div class="formulario-grupo-input">
                <input class="campos" type="password" name="pass">
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">Contraseña inválida</p>
        </div>
        <div class="formulario-grupo">
            <input type="hidden" name="envialoaud">
            <button type="submit" class="button">INGRESAR</button>

            <p style="text-align: center;"><a href="loginTI.php" style="text-decoration: none;color: #424242;">Login TI</a></p>
            <!--<p style="text-align: center;"><a href="recuperarPassword.php" style="text-decoration: none;color: #424242;">¿Olvidaste tu contraseña?</a></p>
            <p style="text-align: center;"><a href="registroAuditor.php" style="text-decoration: none;color: #424242;">Registrarse</a></p>
            -->
            <p style="text-align: center;"><a href="javascript:void(0);" style="text-decoration: none;color: #424242;" data-bs-toggle="modal" data-bs-target="#recuperarPasswordModal">¿Olvidaste tu contraseña?</a></p>
            <p style="text-align: center;"><a href="registroAuditor.php" style="text-decoration: none;color: #424242;">Registrarse</a></p>

        </div>
    </form>

    <!-- Modal para Recuperar Contraseña -->
    <div class="modal fade" id="recuperarPasswordModal" tabindex="-1" aria-labelledby="recuperarPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recuperarPasswordModalLabel">Recuperar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de Recuperación de Contraseña -->
                    <form id="recuperarPasswordForm" action="../controller/enviarCodigo.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese su correo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar código</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para Nueva Contraseña -->
    <div class="modal fade" id="newPasswordModal" tabindex="-1" aria-labelledby="newPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPasswordModalLabel">Nueva contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newPasswordForm" action="../controller/verificarCodigo.php" method="POST">
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código de recuperación</label>
                            <input type="text" name="codigo_recuperacion" class="form-control" required>
                            <input type="hidden" name="email" id="emailHidden">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva contraseña</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Restablecer contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Redireccionar a la página de nueva contraseña después de enviar el código
            $('#recuperarPasswordForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Abre el modal de nueva contraseña y cierra el anterior
                        $('#recuperarPasswordModal').modal('hide');
                        $('#newPasswordModal').modal('show');
                    }
                });
            });

            // SweetAlert cuando se restablece la contraseña
            $('#newPasswordForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Contraseña restablecida!',
                            text: 'Ahora puedes iniciar sesión.',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../auditor/login.php';
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/Login.js"></script>
<script type="text/javascript" src="../js/principal.js"></script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
<script src='../lib/sweetalert2.all.js'></script>
<script src='../lib/sweetalert2.min.js'></script>

</html>
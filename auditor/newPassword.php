<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/registro.css"> <!-- Puedes reutilizar el CSS del registro -->
</head>
<body>
    <form action="../controller/verificarCodigo.php" method="POST" id="formRecuperarPassword">
        <h2>Verificar código</h2>
        <div>
            <label for="codigo">Código de recuperación</label>
            <input type="text" name="codigo_recuperacion" required>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        </div>
        <div class="formulario-grupo" id="grupo-new_password">
            <label for="new_password">Nueva contraseña</label>
            <div class="formulario-grupo-input">
                <input type="password" name="new_password" id="new_password" required>
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">La contraseña debe tener entre 6 y 20 caracteres, incluir al menos una mayúscula, un número y no puede contener espacios.</p>
        </div>
        <button type="submit">Restablecer contraseña</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="../js/newPassword.js"></script> <!-- Script de validación -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>


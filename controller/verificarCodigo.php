<?php

require 'connection.php';
if (isset($_POST['codigo_recuperacion']) && isset($_POST['new_password'])) {
    $codigo = $_POST['codigo_recuperacion'];
    $email = $_POST['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Asegúrate de hashear la nueva contraseña

    $query = "SELECT codigo_expiracion FROM usuarios WHERE correo = '$email' AND codigo_recuperacion = '$codigo'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        $expiracion = $usuario['codigo_expiracion'];

        // Verificar si el código ha expirado
        if (strtotime($expiracion) > time()) {
            // Código válido, actualizar la contraseña
            $update_query = "UPDATE usuarios SET contrasena = '$new_password', codigo_recuperacion = NULL, codigo_expiracion = NULL WHERE correo = '$email'";
            if (mysqli_query($con, $update_query)) {
                echo "Contraseña actualizada correctamente.";
                header('Location: ../auditor/login.php'); // Redirigir a la página de login
            } else {
                echo "Error al actualizar la contraseña.";
            }
        } else {
            echo "El código ha expirado.";
        }
    } else {
        echo "El código de recuperación es inválido.";
    }
}
?>


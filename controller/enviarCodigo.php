<?php

//date_default_timezone_set('America/Lima'); // Establecer la zona horaria
require '../vendor/autoload.php'; // Incluye el autoload.php de Composer
require 'connection.php'; // Incluye tu archivo de conexión a la base de datos

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Verificar si el correo existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE correo = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Generar un código aleatorio
        $codigo = rand(100000, 999999);

        // Establecer fecha de expiración (ejemplo: 15 minutos)
        $expiracion = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Actualizar el código de recuperación y la expiración en la base de datos
        $update_query = "UPDATE usuarios SET codigo_recuperacion = '$codigo', codigo_expiracion = '$expiracion' WHERE correo = '$email'";
        mysqli_query($con, $update_query);

        // Configurar y enviar el correo
        $mail = new PHPMailer(true);

        try {
            // Configura el servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'notificacionesoben@gmail.com'; // Tu correo de Gmail
            $mail->Password = 'qmac xsrt jrug ykbs';      // Tu contraseña de Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinatario
            $mail->setFrom('notificacionesoben@gmail.com', 'Recuperacion de contrasena');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Codigo de recuperacion de contrasena';
            $mail->Body    = "Tu codigo de recuperacion es: <b>$codigo</b>. Tienes 15 minutos para usarlo.";

            //$mail->send();
            echo "Codigo de recuperacion enviado a tu correo.";
            if ($mail->send()) {
                header('Location: ../auditor/newPassword.php?email=' . urlencode($email)); // Redirige a la página para ingresar el código
                exit;
            } else {
                echo "Error al enviar el código.";
            }
        } catch (Exception $e) {
            echo "Error al enviar el código: {$mail->ErrorInfo}";
        }
    } else {
        echo "El correo no está registrado.";
    }
    
}
?>

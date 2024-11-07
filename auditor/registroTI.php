<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,maximum-scale=1.0,minimum-scale=1.0">
    <title>Internal Audit</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/registro.css">

</head>

<?php
       
        include '../controller/business.php';
        
?>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
<link rel='stylesheet' href='../lib/sweetalert2.min.css'>
<body class="body_registro"> 
    
    <h1 class="formh1">Registro</h1>
    <form class="formreaud" id="enviarRegistroTI" name="enviarRegistroTI" action="../controller/actionRegistroTI.php" method="post">
        <div class="formulario-grupo" id="grupo-nombres">
            <label for="nombre" class="formulario-label">Nombres</label>
            <div class="formulario-grupo-input">
                <input class="campos" type="text" name="nombres" placeholder="Luis Fernando" required>
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">El nombre tiene que ser de 4 a 16 caracteres y solo puede contener letras</p>
        </div>

        <div class="formulario-grupo" id="grupo-apellidos">
            <label for="apellido" class="formulario-label">Apellidos</label>
            <div class="formulario-grupo-input">
                <input class="campos" type="text" name="apellidos" placeholder="Flores Basurto" required>
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">El apellido tiene que ser de 4 a 16 caracteres y solo puede contener letras</p>
        </div>

        <div class="formulario-grupo" id="grupo-correo">
            <label for="correo" class="formulario-label">Correo</label>
            <div class="formulario-grupo-input">
                <input class="campos" type="email" name="correo" placeholder="correo@correo.com" required>
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">El correo solo puede contener letras, números, puntos, guiones y guión bajo.</p>
        </div>

        <div class="formulario-grupo" id="grupo-contrasena">
            <label for="pas" class="formulario-label">Contraseña</label>
            <div class="formulario-grupo-input">
                <input class="campos" type="password" name="contrasena" placeholder="" required>
                <i class="formulario-validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario-input-error">La contraseña tiene que ser de 1 mayúscula,1 número y será de no menos de 6 caracteres</p>
        </div>

        <div class="formulario-grupo" id="grupo-button">
            <input type="hidden" name="enviarRegistroTI">
            <button type="submit" class="buttonre">Register</button>
        </div>
    </form>
</body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/RegistroTI.js"></script>
    <script src="../js/principal.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src='../lib/sweetalert2.all.js'></script>
    <script src='../lib/sweetalert2.min.js'></script>
</html>
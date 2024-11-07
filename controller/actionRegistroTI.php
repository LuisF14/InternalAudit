<?php
// REGISTRO AUDITOR
if (isset($_POST["enviarRegistroTI"])) {
    include_once 'connection.php';
    include_once 'business.php';
    $obj = new Negocio();
    $nom = $_POST["nombres"];
    $ape = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"],PASSWORD_DEFAULT);
    $area = 2;

    $query = "select * from usuarios where correo='$correo'";
    $resultado = $con->query($query);

    if (mysqli_num_rows($resultado) > 0) {
        $respuesta = array(
            'respuesta' => 'correoexiste'
        );
    } else {
        // Captura el ID autoincremental después de registrar el auditor
        $last_id = $obj->registroAudit($area, $nom, $ape);

        if ($last_id && $last_id != "Error") {
            // Pasa el ID a la función de registro de usuario
            $obj->registroUsu($last_id, $correo, $contrasena);
            $respuesta = array(
                'respuesta' => 'exitoso'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error_registro_auditor'
            );
        }
    }
    die(json_encode($respuesta));
}

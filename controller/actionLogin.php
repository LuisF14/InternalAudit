<?php
if (isset($_POST["envialoaud"])) {
    include_once 'business.php';
    $obj = new Negocio();
    $resultado = $obj->loginAuditor($_POST["email"], $_POST["pass"]);

    if ($resultado == "error") {
        $respuesta = array(
            'respuesta' => 'error'
        );
    } else {
        session_start();
        $_SESSION["id_usuario"] = $resultado[0];;
        // Puedes agregar más variables de sesión si es necesario

        $respuesta = array(
            'respuesta' => 'exitoso',
            'usuario' => $_SESSION["id_usuario"]
        );
    }

    die(json_encode($respuesta));
}
?>

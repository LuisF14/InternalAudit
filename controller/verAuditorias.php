<?php

//APARTADO DE ALCANCE

//AGREGAR 
if (isset($_POST['verAuditorias'])) {
    session_start();
    $idAud = $_POST['idAud'];
    $anio = date("Y");
    $estado = 1;

    include_once 'connection.php';
    $query = "SELECT * FROM auditorias
              WHERE `estado`=$estado AND `anio`=$anio";
    if (mysqli_query($con, $query) == 1) {
        $respuesta = array(
            'respuesta' => 'exitoso'
        );
    } else {
        $respuesta = array(
            'respuesta' => 'datos incorrectos'
        );
    }

    die(json_encode($respuesta));
}
?>
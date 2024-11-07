<?php

//APARTADO DE ALCANCE

//AGREGAR 
if (isset($_POST['addAlcance'])) {
    session_start();
    $idplan = $_POST['idplan'];
    $tipo = $_POST['tipo'];
    $descAlc = $_POST['descAlc'];

    include_once 'connection.php';
    $query = "INSERT INTO alcances(id_plan, tipo, descripcion) 
                    VALUES ('$idplan','$tipo','$descAlc')";
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

// EDITAR
if (isset($_POST['updateAlcance'])) {
    session_start();
    $idAlc = $_POST['idAlc'];
    $desc = $_POST['descAlc'];
    

            include_once 'connection.php';
            $query = "UPDATE alcances SET descripcion='$desc' 
                    WHERE id_alcance= '". $idAlc."'";
            if (mysqli_query($con, $query) == 1) {
                $respuesta = array(
                    'respuesta' => 'exito'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'datos incorrectos'
                );
            }
        
   
    die(json_encode($respuesta));
}

// ELIMINAR
if ($_POST['registroAlcance'] == 'eliminar') {
$idAlc = $_POST['id'];
    try {
        include_once 'connection.php';
        $query = "DELETE FROM `alcances` WHERE id_alcance= '".$idAlc."'";

        if (mysqli_query($con, $query) == 1) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_borrar' => $idAlc
            );
        } else {
            $respuesta = array(
                'respuesta' => 'eliminación incorrecta'
            );
        }
    } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
    }

    die(json_encode($respuesta));
}

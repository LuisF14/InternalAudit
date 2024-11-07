<?php
if (isset($_POST['addcronograma'])) {
    session_start();

    // Conexión a la base de datos
    include_once 'connection.php';

    $idplan = $_POST['idplan'];
    $idTipoArray = $_POST['idTipo'];
    $fechas_inicio = $_POST['fecha1'];
    $fechas_fin = $_POST['fecha2'];

    $exito = true;
    $errores = [];

    for ($i = 0; $i < count($idTipoArray); $i++) {
        $idTipo = $idTipoArray[$i];
        $fecha_inicio = $fechas_inicio[$i];
        $fecha_fin = $fechas_fin[$i];

        // Validar las fechas
        if ($fecha_inicio > $fecha_fin) {
            $errores[] = "La fecha de fin para el rango en la actividad $idTipo es incorrecta.";
            $exito = false;
            continue;
        }

        // Verificar si ya existen entradas para el id_plan y id_cronograma
        $query = "SELECT count(*) AS total FROM cronograma WHERE id_plan = '$idplan' AND tipo='$idTipo'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['total'] > 0) {
            // Si existen, hacer un UPDATE
            $update_query = "UPDATE cronograma 
                             SET fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin' 
                             WHERE id_plan = '$idplan' AND tipo='$idTipo' ";

            if (!mysqli_query($con, $update_query)) {
                $exito = false;
                $errores[] = "Error al actualizar la base de datos en la actividad $idTipo: " . mysqli_error($con);
            }
        } else {
            // Si no existen, hacer un INSERT
            $insert_query = "INSERT INTO cronograma (fecha_inicio, tipo, fecha_fin, id_plan) 
                             VALUES ('$fecha_inicio', '$idTipo', '$fecha_fin', '$idplan')";

            if (!mysqli_query($con, $insert_query)) {
                $exito = false;
                $errores[] = "Error al insertar en la base de datos en la actividad $idTipo: " . mysqli_error($con);
                break;
            }
        }
    }

    if ($exito) {
        $respuesta = array(
            'respuesta' => 'exitoso'
        );
    } else {
        $respuesta = array(
            'respuesta' => 'error',
            'errores' => $errores
        );
    }

    die(json_encode($respuesta));
}

?>

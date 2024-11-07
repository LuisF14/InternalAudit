<?php 

if (isset($_POST['crear'])) {
    session_start();           
    $estado = 0;
    $area = 2;
    $anio = date("Y");
    //$nombre1 = $anio . "-" . 1;
    $fecha_apertura = date("Y-m-d");
    $fecha_cierre = new DateTime();
    $fecha_cierre->modify('+6 months');
    $fecha_cierre = $fecha_cierre->format('Y-m-d'); // Convertir el objeto DateTime a string

    include_once 'connection.php';

     // Primero, contar cuántas auditorías ya existen para el año actual
     $query_count = "SELECT COUNT(*) as total FROM auditorias WHERE anio = '$anio'";
     $result_count = mysqli_query($con, $query_count);
     $row_count = mysqli_fetch_assoc($result_count);
     $count = $row_count['total']; // Número de auditorías existentes para el año actual
 
     // Incrementar el número en el nombre basado en el conteo
     $nombre = $anio . "-" . ($count + 1); 

    // Insertar las auditorías
    $query = "INSERT INTO `auditorias`(`id_area`, `nombre`, `estado`, `anio`,`fecha_inicio`,`fecha_vcto`) 
              VALUES ('$area','$nombre',0, '$anio','$fecha_apertura','$fecha_cierre')";
    
    if (mysqli_query($con, $query)) {
        // Ejecutar la consulta para obtener el id_auditoria
        $query3 = "SELECT id_auditoria FROM auditorias WHERE estado=0";
        $result = mysqli_query($con, $query3);

        // Verificar si la consulta fue exitosa y si hay resultados
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_auditoria = $row['id_auditoria'];

                // Ahora, insertar en la tabla `plan`
                $query4 = "INSERT INTO `plan`(`id_auditoria`) VALUES ('$id_auditoria')";
                if (!mysqli_query($con, $query4)) {
                    echo "Error al insertar en la tabla plan: " . mysqli_error($con);
                }
                // Insertar en la tabla `informe`
                /*$query5 = "INSERT INTO `informe`(`id_auditoria`) VALUES ('$id_auditoria')";
                if (!mysqli_query($con, $query5)) {
                    echo "Error al insertar en la tabla informe: " . mysqli_error($con);
                }*/
            }
            header('Location: ../auditor/menu_principal.php');
            exit(); // Asegúrate de usar exit después de header para evitar que el script continúe ejecutándose
            //$respuesta = array('respuesta' => 'exitoso');
        } else {
            echo "No se encontraron auditorías con estado 0.";
        }
    } else {
        $respuesta = array('respuesta' => 'datos incorrectos');
        die(json_encode($respuesta));
    } 

    
} 
?>

<!-- Redirigir al usuario a la página principal o a otra página -->
<meta http-equiv="refresh" content="2;url=../auditor/menu_principal.php">

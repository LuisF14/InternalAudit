<?php
// Incluir el archivo de conexión a la base de datos
include_once 'connection.php';

// Verifica si el botón "Crear" fue presionado
if (isset($_POST['crear'])) {
    $id_para_auditoria = 1; // o el valor que necesites
    $anio_actual = date("Y");

    // 1. Verifica si existe un registro en `parametro_auditoria` para el año actual
    $query = "SELECT contador FROM parametro_auditoria WHERE id_para_auditoria = ? AND año = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $id_para_auditoria, $anio_actual);
    $stmt->execute();
    $stmt->bind_result($contador);
    $stmt->fetch();
    $stmt->close();

    // Si no existe, crea un registro para el año actual
    if (!isset($contador)) {
        // Definir un contador por defecto (por ejemplo, 2 auditorías por año)
        $contador = 2;
        
        // Inserta el nuevo registro en `parametro_auditoria` para el año actual
        $query = "INSERT INTO parametro_auditoria (id_para_auditoria, nombre, contador, año) VALUES (?, 'Auditoría', ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iii", $id_para_auditoria, $contador, $anio_actual);
        $stmt->execute();
        $stmt->close();
    }

    // 2. Cuenta cuántas auditorías ya se han creado para ese año
    $query = "SELECT COUNT(*) FROM auditorias WHERE id_para_auditoria = ? AND id_para_auditoria IN (
                SELECT id_para_auditoria FROM parametro_auditoria WHERE año = ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $id_para_auditoria, $anio_actual);
    $stmt->execute();
    $stmt->bind_result($num_auditorias);
    $stmt->fetch();
    $stmt->close();

    if ($num_auditorias === NULL) {
        $num_auditorias = 0; // Si no hay auditorías, establecemos el contador en 0
    }

    // 3. Verifica si aún puedes crear más auditorías en el año
    if ($num_auditorias < $contador) {
        $nuevo_num = $num_auditorias + 1;
        $nuevo_nombre = "auditoria " . $anio_actual . "-" . $nuevo_num;

        // 4. Inserta la nueva auditoría en la tabla auditorias
        $query = "INSERT INTO auditorias (id_para_auditoria, id_area, id_grupo_auditor, nombre, estado) VALUES (?, , 1, 2, ?, 'pendiente')";
        $stmt = $con->prepare($query);
        $stmt->bind_param("is", $id_para_auditoria, $nuevo_nombre);
        if ($stmt->execute()) {
            echo "Nueva auditoría creada con éxito: " . $nuevo_nombre;
        } else {
            echo "Error al crear la auditoría: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "No se pueden crear más auditorías para este año.";
    }
}
?>

<!-- Redirigir al usuario a la página principal o a otra página -->
<meta http-equiv="refresh" content="2;url=../auditor/menu_principal.php">

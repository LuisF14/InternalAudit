<?php
require '../vendor/autoload.php'; // Incluir autoload de Composer para Dompdf

use Dompdf\Dompdf;

// Conexión a la base de datos
require_once('connection.php');



// Consulta a la tabla `objetivo` 
$query = "SELECT objetivo.nombre, objetivo.descripcion
          FROM objetivo
          JOIN plan ON objetivo.id_plan = plan.id_plan
          JOIN auditorias ON plan.id_auditoria = auditorias.id_auditoria
          WHERE auditorias.estado = 0";
$result = mysqli_query($con, $query);

// Consulta a la tabla `guia_evaluacion`
$query2 = "SELECT guia_evaluacion.actividad, guia_evaluacion.procedimiento, guia_evaluacion.herramienta, guia_evaluacion.observacion
           FROM guia_evaluacion
           JOIN plan ON guia_evaluacion.id_plan = plan.id_plan
           JOIN auditorias ON plan.id_auditoria = auditorias.id_auditoria
           WHERE auditorias.estado = 0";
$result2 = mysqli_query($con, $query2);

// Consulta a la tabla `elementos`
$query3 = "SELECT elementos.nombre, elementos.descripcion, elementos.cantidad, elementos.fecha_revision, elementos.estado, elementos.observacion
           FROM elementos
           JOIN plan ON elementos.id_plan = plan.id_plan
           JOIN auditorias ON plan.id_auditoria = auditorias.id_auditoria
           WHERE auditorias.estado = 0
           ORDER BY elementos.nombre ASC";
$result3 = mysqli_query($con, $query3);

// Consulta a la tabla `conclusiones`
$query4 = "SELECT conclusiones.descripcion
           FROM conclusiones
           JOIN auditorias ON conclusiones.id_auditoria = auditorias.id_auditoria
           WHERE auditorias.estado = 0";
$result4 = mysqli_query($con, $query4);

// Consulta a la tabla `recomendaciones`
$query5 = "SELECT recomendaciones.descripcion
           FROM recomendaciones
           JOIN auditorias ON recomendaciones.id_auditoria = auditorias.id_auditoria
           WHERE auditorias.estado = 0";
$result5 = mysqli_query($con, $query5);

// Consulta a la tabla `alcances`
$query6 = "SELECT alcances.tipo, alcances.descripcion
           FROM alcances
           JOIN plan ON alcances.id_plan = plan.id_plan
           JOIN auditorias ON plan.id_auditoria = auditorias.id_auditoria
           WHERE auditorias.estado = 0";
$result6 = mysqli_query($con, $query6);

// Consulta a la tabla `alcances`
$query7 = "SELECT cronograma.id_cronograma, cronograma.tipo, cronograma.fecha_inicio, cronograma.fecha_fin
           FROM cronograma
           JOIN plan ON cronograma.id_plan = plan.id_plan
           JOIN auditorias ON plan.id_auditoria = auditorias.id_auditoria
           WHERE auditorias.estado = 0";
$result7 = mysqli_query($con, $query7);

if (!$result || !$result2 || !$result3 || !$result4 || !$result5 || !$result6 || !$result7) {
    die("Error en la consulta: " . mysqli_error($con));
}

// Definir mapeo de estados
$estados = [
    1 => 'BUENO',
    2 => 'REGULAR',
    3 => 'MALO'
];

// Crear un array para mapear los tipos a sus descripciones
$tipos = [
    1 => "Equipos incluidos",
    2 => "Áreas cubiertas",
    3 => "Criterios",
    4 => "Sistemas y aplicaciones",
    5 => "Procesos y procedimientos",
    6 => "Aspectos de seguridad",
    7 => "Cumplimiento normativo",
    8 => "Datos evaluados",
    9 => "Período de auditoría",
    10 => "Exclusiones"
];

// Crear un array para mapear los tipos en cronograma
$tipoCronograma = [
    1 => 'Alcances',
    2 => 'Objetivos',
    3 => 'Criterios',
    4 => 'Equipo auditor',
    5 => 'Guia de evaluacion',
    6 => 'Lista de elementos',
];

// Obtener la fecha actual
$fecha_actual = date("d/m/Y");

// Convierte la imagen a Base64
$imageData = base64_encode(file_get_contents('C:\xampp\htdocs\InternalAudit\img\logo.jpg'));
$src = 'data:image/jpeg;base64,' . $imageData;

// Generar el contenido HTML para el PDF
$html = '

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    .header {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: flex-start; /* Cambiado a flex-start para alinear el logo y la fecha */
        margin-bottom: 10px; /* Ajustado para dar espacio entre la línea y el logo */
        border-bottom: 2px solid #f9a035;
        padding-bottom: 5px; /* Margen adicional entre la línea y el logo */
    }
    .header img {
        width: 100px;
    }

    .header .date {
        text-align: right;
        color: #666;
        margin-bottom: 5px; /* Margen entre la fecha y la línea */

    .header .company-details {
        text-align: right;
    }
    .company-details h3, .company-details p {
        margin: 0;
        color: #f9a035;
    }
    .title {
        font-size: 24px;
        font-weight: bold;
        color: #f9a035;
        text-align: center;
        margin-bottom: 20px;
    }
    .date {
        text-align: right;
        margin-bottom: 10px;
        color: #666;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #f9a035;
        color: white;
    }
    .section-title {
        font-size: 18px;
        font-weight: bold;
        color: #f9a035;
        margin-bottom: 10px;
        text-align: center;
    }
    .footer {
        width: 100%;
        background-color: #f9a035;
        color: white;
        text-align: center;
        line-height: 50px;
        font-size: 12px;
        position: relative; /* Cambiado a relativo */
        margin-top: 20px; /* Margen para separar del contenido anterior */
    }
</style>

<div class="header">
    <img src="' . $src . '" alt="Logo">
    <div class="date">Fecha: ' . $fecha_actual . '</div>
</div>

<div class="title"><br>Informe de Auditoria de equipos informáticos</div>';

// Agregar la tabla (Cronograma)
$html .= '<div class="section-title"><br>Cronograma</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Nombre</th><th>Fecha Inicio</th><th>Fecha Fin</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result7)) {
    $CronoTipo = isset($tipoCronograma[$row['tipo']]) ? $tipoCronograma[$row['tipo']] : 'Sin estado';
    $html .= '<tr>';
    $html .= '<td>' . $CronoTipo . '</td>';
    $html .= '<td>' . $row['fecha_inicio'] . '</td>';
    $html .= '<td>' . $row['fecha_fin'] . '</td>';
    
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Agregar la segunda tabla Alcances
$html .= '<div class="section-title">Alcances</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Tipo</th><th>Descripción</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result6)) {
    $tipoTexto = isset($tipos[$row['tipo']]) ? $tipos[$row['tipo']] : 'Desconocido';
    $html .= '<tr>';
    $html .= '<td>' . $tipoTexto . '</td>';
    $html .= '<td>' . $row['descripcion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Agregar la segunda tabla (Objetivos)
$html .= '<div class="section-title"><br>Objetivos</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Nombre</th><th>Descripción</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['nombre'] . '</td>';
    $html .= '<td>' . $row['descripcion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Agregar la segunda tabla (Guía de Evaluación)
$html .= '<div class="section-title"><br>Guía de Evaluación</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Actividad</th><th>Procedimiento</th><th>Herramienta</th><th>Observación</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result2)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['actividad'] . '</td>';
    $html .= '<td>' . $row['procedimiento'] . '</td>';
    $html .= '<td>' . $row['herramienta'] . '</td>';
    $html .= '<td>' . $row['observacion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Agregar la tercera tabla (Elementos)
$html .= '<div class="section-title"><br>Elementos</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Nombre</th><th>Descripción</th><th>Cantidad</th><th>Fecha de Revisión</th><th>Estado</th><th>Observación</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result3)) {
    $estadoTexto = isset($estados[$row['estado']]) ? $estados[$row['estado']] : 'Sin estado';
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($row['nombre']) . '</td>';
    $html .= '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
    $html .= '<td>' . htmlspecialchars($row['cantidad']) . '</td>';
    $html .= '<td>' . htmlspecialchars($row['fecha_revision']) . '</td>';
    $html .= '<td>' . htmlspecialchars($estadoTexto) . '</td>';
    $html .= '<td>' . htmlspecialchars($row['observacion']) . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';


// Agregar la segunda tabla Conclusiones
$html .= '<div class="section-title"><br>Conclusiones</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Descripcion</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result4)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['descripcion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Agregar la segunda tabla Recomendaciones
$html .= '<div class="section-title">Recomendaciones</div>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr><th>Descripcion</th></tr>';
$html .= '</thead>';
$html .= '<tbody>';

while($row = mysqli_fetch_assoc($result5)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['descripcion'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Añadir pie de página con información de la empresa y número de página
$html .= '<div class="footer">Oben Group - Av. San Pedro Mz. B Lte. 48-A Urb. San Vicente, Lima, Lurin</div>';

// Cerrar la conexión a la base de datos
mysqli_close($con);

// Crear una instancia de Dompdf
$dompdf = new Dompdf();

// Cargar el contenido HTML (incluye las tres tablas concatenadas)
$dompdf->loadHtml($html);

// Obtener la instancia de opciones y establecer las opciones necesarias
$options = $dompdf->getOptions();
$options->set('isHtml5ParserEnabled', true); // Habilitar el parser HTML5

// (Opcional) Configurar el tamaño y la orientación del papel
$dompdf->setPaper('A4', 'portrait');


// Renderizar el PDF
$dompdf->render();

// Agregar numeración de página
$canvas = $dompdf->getCanvas();
$canvas->page_text(520, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

// Enviar el PDF al navegador
$dompdf->stream("Informe de auditoria interna.pdf", array("Attachment" => 0));
?>

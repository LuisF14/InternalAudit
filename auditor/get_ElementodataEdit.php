<?php
if (isset($_POST['editElemento'])) {
    include '../controller/business.php';
    $obj = new Negocio();
    session_start();
    $id = $_POST['editElemento'];
    $emp = $obj->UpdateElemento($id);

    $response = "
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='../css/styles.css'>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script type='text/javascript' src='../lib/bootstrap-datepicker.js'></script>
    <link rel='stylesheet' type='text/css' href='../lib/bootstrap-datepicker.css'>
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>

    <form role='form' method='post' name='updateElemento' id='updateElemento' action='../controller/OperacionElementoAgregar.php'>   
    <input type='hidden' class='form-control' name='idEle' value='$id'>
    <input type='hidden' class='form-control' name='registroElemento' value=''>";

    // Nombre
    foreach ($emp as $k => $d) {
        $var = $d[1];
    }       
    $response .= "
    <div class='form-group' style='margin-left: 25%'>
        <div class='container'>
            <div class='nombreObj' style='margin-top:30px;'>
                <label style='margin-right: 120px'>Nombre de elemento</label>
                <input type='text' style='width:200px;' class='form-control' id='nombreEle' name='nombreEle' value='$var' autocomplete='off'>
            </div>
        </div>
    </div>";

    // Descripción
    foreach ($emp as $k => $d) {
        $var = $d[2];
    }
    $response .= "
    <div class='form-group' style='margin-left: 25%'>
        <div class='container'>
            <div class='descObj' style='margin-top:30px;'>
                <label style='margin-right: 120px'>Descripción del elemento</label>
                <input type='text' style='width:200px;' class='form-control' id='descEle' name='descEle' value='$var' autocomplete='off' required>
            </div>
        </div>
    </div>";

    // Cantidad
    foreach ($emp as $k => $d) {
        $var = $d[3];
    }
    $response .= "
    <div class='form-group' style='margin-left: 25%'>
        <div class='container'>
            <div class='cantEle' style='margin-top:30px;'>
                <label style='margin-right: 120px'>Cantidad</label>
                <input type='number' style='width:200px;' class='form-control' id='cantEle' name='cantEle' value='$var' autocomplete='off' required>
            </div>
        </div>
    </div>";

    // F.Revisión
    foreach ($emp as $k => $d) {
        $var = $d[4];
    }
    $response .= "
    <div class='form-group' style='margin-left: 25%'>
        <div class='container'>
            <div class='dates' style='margin-top:30px;'>
                <label style='margin-right: 120px'>Fecha de revisión</label>
                <input type='hidden' style='width:200px;' class='form-control' id='fecha1' name='fechahoy'  value='$var' autocomplete='off' required>
                <input type='date' style='width:200px;' class='form-control' id='calendario' name='calendario' value='$var' autocomplete='off' required>
            </div>
        </div>
    </div>";

    // Estado
    $response .= "
    <div class='form-group' style='margin-left: 25%'>
        <div class='container'>
            <div class='camposr' style='margin-top:30px;'>
                <label for='estado' style='margin-right: 120px'>Elija estado</label>
                <select name='estado' id='estado' class='camposr' style='margin-right: 120px' required>";

    // Array de estados
    $estados = array(
        1 => "Bueno",
        2 => "Regular",
        3 => "Malo"
    );

    // Obtener el estado actual
    $vec2 = $obj->ListarEstado($id);
    $estadoActual = $vec2[0][0]; // Asumiendo que ListarEstado trae un único valor en $vec2[0][0]

    // Recorrer el array de estados para listar todas las opciones y seleccionar la correspondiente
    $response .= "<option value=''>Seleccione</option>";
    foreach ($estados as $key => $descripcion) {
        $selected = ($key == $estadoActual) ? "selected" : "";
        $response .= "<option value='$key' $selected>$descripcion</option>";
    }

    $response .= "
                </select>
            </div>
        </div>
    </div>";

    // Observación
    foreach ($emp as $k => $d) {
        $var = $d[6];
    }
    $response .= "
    <div class='form-group' style='margin-left: 25%'>
        <div class='container'>
            <div class='obserEle' style='margin-top:30px;'>
                <label style='margin-right: 120px'>Observación</label>
                <input type='text' style='width:200px;' class='form-control' id='obserEle' name='obserEle' value='$var' autocomplete='off'>
            </div>
        </div>
    </div>";

    $response .= "
    <input type='hidden' name='updateElemento' value=''>
    <button style='margin-top:20px' type='submit' class='btn btn-dark'>Guardar</button>
    </form>
    <script src='../js/Principal.js'></script>
    <script src='../lib/sweetalert2.all.js'></script>
    <script src='../lib/sweetalert2.min.js'></script>";

    echo $response;
    exit;
}
?>

<?php

    include '../controller/business.php';
    $obj=new Negocio();
    session_start();
    $idplan=$_GET["add"];  
    
    $response = "   
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='../css/style.css'>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script type='text/javascript' src='../lib/bootstrap-datepicker.js'></script>
    <link rel='stylesheet' type='text/css' href='../lib/bootstrap-datepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>
    
    <form role='form' method='post' name='addelemento' id='addelemento' action='../controller/OperacionElementoAgregar.php'>   
    <input type='hidden' class='form-control' name='idplan' value='$idplan'>
    <input type='hidden' class='form-control' name='registroElemento' value=''>";
  

    ?>
    <?php
    date_default_timezone_set('America/Lima');
    $fecha_hoy = date('Y-m-d'); 
    // echo $fecha_hoy;
    ?>

    <?php

    // Nombre
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='nombreEle' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-right: 120px'>Elemento</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='nombreEle' name='nombreEle'  autocomplete='off'>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";
    
    // Descripción
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='descEle' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-right: 120px'>Descripción</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='descEle' name='descEle'  autocomplete='off' required>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    // Cantidad
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='cantEle' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-right: 120px'>Cantidad</label>";
    $response .= "<input type='number' style='width:200px;' class='form-control' id='cantEle' name='cantEle' autocomplete='off' required>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    // F.Revisión
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='dates' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-right: 120px'>Fecha de revisión</label>";
    $response .= "<input type='hidden' style='width:200px;' class='form-control' id='fecha1' name='fechahoy' value= '$fecha_hoy' autocomplete='off' required >";
    $response .= "<input type='date' style='width:200px;' class='form-control' id='calendario' name='calendario'  autocomplete='off' required>";
         
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    // Estado
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='camposr' style='margin-top:30px;'>";
    $response .= "<label for='estado' style='margin-right: 120px' >Elija estado</label>                           
    <select name='estado' id='estado' class='camposr' style='margin-right: 120px' required>
    <option value=''>Seleccione</option>
    <option value='1'>Bueno</option>
    <option value='2'>Regular</option>
    <option value='3'>Malo</option></select>"; 
    $response .="</div>";
    $response .="</div>";
    $response .="</div>";


    // Observación
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='obserEle' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-right: 120px'>Observación</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='obserEle' name='obserEle' autocomplete='off'>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    $response.="  <input type='hidden' name='addelemento' value=''>
    <button style='margin-top:20px'type='submit' class='btn btn-dark'>Guardar</button>";
    $response.="</form>";
    $response.="
    <script src='../js/Principal.js'></script>
    <script src='../lib/sweetalert2.all.js'></script>
    <script src='../lib/sweetalert2.min.js'></script>";
    echo $response;
    exit;
  
?>

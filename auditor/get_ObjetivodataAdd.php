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
    
    <form role='form' method='post' name='addobjetivo' id='addobjetivo' action='../controller/OperacionObjetivoAgregar.php'>   
    <input type='hidden' class='form-control' name='idplan' value='$idplan'>
    <input type='hidden' class='form-control' name='registroElemento' value=''>
  
    <script>
    $(function() {
    $('.dates #calendario').datepicker({
    'format': 'yyyy-mm-dd',
    'autoclose': true
    });
    });
    </script>";

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
           
    $response .= "<label style='margin-left: 24px'>Objetivo</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='nombreObj' name='nombreObj'  autocomplete='off'>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";
    
    // Descripción
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='descEle' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-left: 10px'>Descripción</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='descObj' name='descObj'  autocomplete='off' required>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    $response.="  <input type='hidden' name='addobjetivo' value=''>
    <button style='margin-left:190px;margin-top:20px'type='submit' class='btn btn-dark'>Guardar</button>";
    $response.="</form>";
    $response.="
    <script src='../js/Principal.js'></script>
    <script src='../lib/sweetalert2.all.js'></script>
    <script src='../lib/sweetalert2.min.js'></script>";
    echo $response;
    exit;
  
?>

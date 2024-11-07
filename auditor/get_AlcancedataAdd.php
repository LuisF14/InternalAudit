<?php

    include '../controller/business.php';
    $obj=new Negocio();
    session_start();
    $tipo=$_GET["add"];
    $idplan=$_GET["add2"];   
    
    $response = "   
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='../css/style.css'>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script type='text/javascript' src='../lib/bootstrap-datepicker.js'></script>
    <link rel='stylesheet' type='text/css' href='../lib/bootstrap-datepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>
    
    <form role='form' method='post' name='addAlcance' id='addAlcance' action='../controller/OperacionAlcanceAgregar.php'>   
    <input type='hidden' class='form-control' name='idplan' value='$idplan'>
    <input type='hidden' class='form-control' name='tipo' value='$tipo'>";
  
    
    // Descripción
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='descEle' style='margin-top:30px;'>";
           
    $response .= "<label style='margin-left: 10px'>Descripción</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='descAlc' name='descAlc'  autocomplete='off' required>";
            
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    $response.="  <input type='hidden' name='addAlcance' value=''>
    <button style='margin-top:20px'type='submit' class='btn btn-dark'>Guardar</button>";
    $response.="</form>";
    $response.="
    <script src='../js/Principal.js'></script>
    <script src='../lib/sweetalert2.all.js'></script>
    <script src='../lib/sweetalert2.min.js'></script>";
    echo $response;
    exit;
  
?>

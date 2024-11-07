<?php
if(isset($_POST['editGuia'])){
    include '../controller/business.php';
    $obj=new Negocio();
    session_start();
    $id = $_POST['editGuia']; 
    $ref=$obj->UpdateGuia($id);
    $response = " 
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='../css/styles.css'>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>

    <form role='form' method='post' name='updateGuia' id='updateGuia' action='../controller/OperacionGuiaInsertar.php'>   
    <input type='hidden' class='form-control' name='idGE' value='$id'>
    <input type='hidden' class='form-control' name='registroGuia' value=''>";
     
    // Actividad que será evaluada
    $response .= "<div class='form-group' style='margin-left: 25%;'>";
    $response .= "<div class='container'>";
    $response .= "<div class='actividadG' style='margin-top:30px;'>";?>   
            <?php
            foreach ($ref as $k=>$d){
                $var=$d[1];
        }       
    $response .= "<label style='margin-left: 1.9px'>Actividad que será evaluada</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='actividadG' name='actividadG'  value='$var' autocomplete='off' required>";
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";
    
    // Procedimiento de auditoría
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='procedimientoG' style='margin-top:30px;'>";?>   
            <?php
            foreach ($ref as $k=>$d){
                $var=$d[2];
        }       
    $response .= "<label style='margin-left: 3.5px;'>Procedimiento de auditoría</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='procedimientoG' name='procedimientoG'  value='$var' autocomplete='off' required>";
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    // Herramientas que serán utilizadas
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='herramientaG' style='margin-top:30px;'>";?>   
            <?php
            foreach ($ref as $k=>$d){
                $var=$d[3];
        }       
    $response .= "<label style='margin-left:-21px'>Herramientas que serán utilizadas</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='herramientaG' name='herramientaG'  value='$var' autocomplete='off' required>";
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    // Observaciones
    $response .= "<div class='form-group' style='margin-left: 25%'>";
    $response .= "<div class='container'>";
    $response .= "<div class='observacionG' style='margin-top:30px;'>";?>   
            <?php
            foreach ($ref as $k=>$d){
                $var=$d[4];
        }       
    $response .= "<label style='margin-left:49px'>Observaciones</label>";
    $response .= "<input type='text' style='width:200px;' class='form-control' id='observacionG' name='observacionG'  value='$var' autocomplete='off'>";
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";

    $response.="  <input type='hidden' name='updateGuia' value=''>
    <button style='margin-left:190px;margin-top:20px'type='submit' class='btn btn-dark'>Guardar</button>";
    
    $response.="</form>";
    $response.="
    <script src='../js/Principal.js'></script>
    <script src='../lib/sweetalert2.all.js'></script>
    <script src='../lib/sweetalert2.min.js'></script>";
    echo $response;
    exit;
  
}
?>

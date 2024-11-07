<?php
if(isset($_POST['editConclusion'])){
    include '../controller/business.php';
    $obj=new Negocio();
    session_start();
    $id = $_POST['editConclusion']; 
    $emp=$obj->UpdateConclusion($id);
    $response = " 
    <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='../css/styles.css'>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>

    <form role='form' method='post' name='updateConclusion' id='updateConclusion' action='../controller/OperacionConclusionInsertar.php'>   
    <input type='hidden' class='form-control' name='idCon' value='$id'>
    <input type='hidden' class='form-control' name='registroConclusion' value=''>";

    // Conclusion
    $response .= "<div class='form-group'>";
    $response .= "<div class='container'>";
    $response .= "<div class='conclusion' style='margin-top:30px;'>";?>   
            <?php
            foreach ($emp as $k=>$d){
                $var=$d[1];
        }       
    $response .= "<label>Conclusion</label>";
    $response .= "<input type='text' style='height: 60px;' class='form-control' id='descripcion' name='descripcion' value='$var'  autocomplete='off'>";
    
    $response .="</div>";
    $response .= "</div>";
    $response .=" </div>";
    
    $response.="  <input type='hidden' name='updateConclusion' value=''>
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

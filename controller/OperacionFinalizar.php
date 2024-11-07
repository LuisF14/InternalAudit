<?php 
                if(isset($_POST['finalizar'])){            
                    session_start();
                    $idaud= $_POST['idAud'];
                    $fecha_cierre = date("Y-m-d");
                    include_once 'connection.php';
                    $query="UPDATE auditorias SET estado=1 , fecha_cierre = '$fecha_cierre' WHERE id_auditoria = $idaud";
                    if(mysqli_query($con,$query)==1){
                        $respuesta=array(
                            'respuesta' => 'exito'                   
                        );
                        header('Location: ../auditor/menu_principal.php');
            exit();
                    } 
                    else{
                        $respuesta=array(
                            'respuesta' => 'datos incorrectos'
                        );
                        }
                    }               
                    die(json_encode($respuesta));
                     
?>
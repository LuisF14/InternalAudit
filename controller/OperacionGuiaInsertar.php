<?php               
                
             
                 //APARTADO DE GUIA DE EVALUACIÓN

                 //AGREGAR 
                if(isset($_POST['addGuia'])){
                    session_start();           
                    $idplan= $_POST['idplan'];
                    $act= $_POST['actividadG'];
                    $proc= $_POST['procedimientoG'];
                    $herra= $_POST['herramientaG'];
                    $obser= $_POST['observacionG'];
                                 
                    include_once 'connection.php';
                    $query="INSERT INTO `guia_evaluacion`(`actividad`, `procedimiento`, `herramienta`, `observacion`, `id_plan`) 
                    VALUES ('$act','$proc','$herra', '$obser','$idplan')";
                    if(mysqli_query($con,$query)==1){
                        $respuesta=array(
                            'respuesta' => 'exitoso'
                        );
                      }
                    else{
                        $respuesta=array(
                            'respuesta' => 'datos incorrectos'
                        );
                    } 
                    die(json_encode($respuesta));
                } 

                // EDITAR
                if(isset($_POST['updateGuia'])){ 
                               
                    session_start();
                    $idguia= $_POST['idGE'];
                    $actividad= $_POST['actividadG'];
                    $procedimiento= $_POST['procedimientoG'];
                    $herramienta= $_POST['herramientaG'];         
                    $observacion= $_POST['observacionG'];  

                    
                    
                    include_once 'connection.php';
                    $query="UPDATE guia_evaluacion SET actividad='$actividad',procedimiento='$procedimiento',herramienta='$herramienta',observacion='$observacion' 
                    WHERE id_guia_evaluacion=".$idguia;
                    if(mysqli_query($con,$query)==1){
                        $respuesta=array(
                            'respuesta' => 'exito'                   
                        );
                    } 
                    else{
                        $respuesta=array(
                            'respuesta' => 'datos incorrectos'
                        );
                        
                    }
                                    
                    die(json_encode($respuesta));
                    } 


                // ELIMINAR
                if($_POST['registroGuia']=='eliminar'){
                    $idguia = $_POST['id'];
                        try{
                    include_once 'connection.php';
                    $query="DELETE FROM `guia_evaluacion` WHERE id_guia_evaluacion=".$idguia;
                   
                if(mysqli_query($con,$query)==1){
                    $respuesta=array(
                        'respuesta' => 'exitoso',
                        'id_borrar' => $idguia
                
                    );
                }
                else{
                    $respuesta=array(
                        'respuesta' => 'eliminación incorrecta'
                    );
                  }
                 
                }catch (Exception $e){
                    echo "Error:".$e->getMessage();
                }
                
                die(json_encode($respuesta));
                }
           

?>
<?php               
                
                //APARTADO DE RECOMENDACIONES

                //AGREGAR 
                if(isset($_POST['addrecomendacion'])){
                    session_start();           
                    $idaud= $_POST['idaud'];
                    $descripcion= $_POST['descripcion'];
                               
                    include_once 'connection.php';
                    $query="INSERT INTO recomendaciones(descripcion, id_auditoria) 
                    VALUES ('$descripcion','$idaud')";
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
                if(isset($_POST['updateRecomendacion'])){            
                    session_start();
                    $idRec= $_POST['idRec'];
                    $descripcion= $_POST['descripcion'];
                    
                    try {        
                    include_once 'connection.php';
                    $query="UPDATE recomendaciones SET descripcion='$descripcion'
                    WHERE id_recomendacion=".$idRec;
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
                    } catch (Exception $e){
                        echo "Error:".$e->getMessage();
                    }                
                    die(json_encode($respuesta));
                    } 
                    
                // ELIMINAR
                if($_POST['registroRecomendacion']=='eliminar'){
                    $idRecomendaciones = $_POST['id'];
                        try{
                    include_once 'connection.php';
                    $query="DELETE FROM `recomendaciones` WHERE id_recomendacion=".$idRecomendaciones;
                   
                if(mysqli_query($con,$query)==1){
                    $respuesta=array(
                        'respuesta' => 'exitoso',
                        'id_borrar' => $idRecomendaciones               
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
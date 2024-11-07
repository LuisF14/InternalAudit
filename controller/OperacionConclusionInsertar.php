<?php               
                
                //APARTADO DE CONCLUSIONES

                //AGREGAR 
                if(isset($_POST['addconclusion'])){
                    session_start();           
                    $idaud= $_POST['idaud'];
                    $descripcion= $_POST['descripcion'];
                                 
                    include_once 'connection.php';
                    $query="INSERT INTO conclusiones(descripcion, id_auditoria) 
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
                if(isset($_POST['updateConclusion'])){            
                    session_start();
                    $idCon= $_POST['idCon'];
                    $descripcion= $_POST['descripcion'];
                    try {        
                    include_once 'connection.php';
                    $query="update conclusiones SET descripcion='$descripcion' 
                    WHERE id_conclusion=".$idCon;
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
                if($_POST['registroConclusion']=='eliminar'){
                    $idCon = $_POST['id'];
                        try{
                    include_once 'connection.php';
                    $query="DELETE FROM `conclusiones` WHERE id_conclusion=".$idCon;
                   
                if(mysqli_query($con,$query)==1){
                    $respuesta=array(
                        'respuesta' => 'exitoso',
                        'id_borrar' => $idCon               
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
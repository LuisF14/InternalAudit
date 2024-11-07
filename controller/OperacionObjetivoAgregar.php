<?php               
                
                //APARTADO DE INGRESO DE OBJETIVOS

                //AGREGAR 
                if(isset($_POST['addobjetivo'])){
                    session_start();           
                    $idplan= $_POST['idplan'];
                    $nombre= $_POST['nombreObj'];
                    $desc= $_POST['descObj'];
                    $cumpli= 0;
                             
                    
                    include_once 'connection.php';
                    $query="INSERT INTO objetivo(nombre, descripcion, cumplimiento, id_plan) 
                    VALUES ('$nombre','$desc','$cumpli','$idplan')";
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
                if(isset($_POST['updateObjetivo'])){            
                    session_start();
                    $idEle= $_POST['idObj'];
                    $nombre= $_POST['nombreObj'];
                    $desc= $_POST['descObj'];
                    
                        
                    include_once 'connection.php';
                    $query="update objetivo SET nombre='$nombre',descripcion='$desc' 
                    WHERE id_objetivo=".$idEle;
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
                if($_POST['registroElemento']=='eliminar'){
                    $idObj = $_POST['id'];
                        try{
                    include_once 'connection.php';
                    $query="DELETE FROM `objetivo` WHERE id_objetivo=".$idObj;
                   
                if(mysqli_query($con,$query)==1){
                    $respuesta=array(
                        'respuesta' => 'exitoso',
                        'id_borrar' => $idObj               
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
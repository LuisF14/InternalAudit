<?php               
                
                //APARTADO DE INGRESO DE ELEMENTOS

                //AGREGAR 
                if(isset($_POST['addelemento'])){
                    session_start();

                    $idplan= $_POST['idplan'];
                    $nombre= $_POST['nombreEle'];
                    $desc= $_POST['descEle'];
                    $cant= $_POST['cantEle'];
                    $date= $_POST['calendario'];
                    $date1= $_POST['fechahoy'];
                    $campo= $_POST['estado'];
                    $obser= $_POST['obserEle'];
                             
                    try{
                        if($date<$date1){
                            $respuesta=array(
                                        'respuesta' => 'Fecha pasada'                   
                                    );                           
                        }
                        else{


                    include_once 'connection.php';
                    $query="INSERT INTO elementos(nombre, descripcion, cantidad, fecha_revision, estado, observacion, id_plan) 
                    VALUES ('$nombre','$desc','$cant','$date',$campo,'$obser','$idplan')";
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
                } 
            }catch (Exception $e){
                echo "Error:".$e->getMessage();
            }
                    die(json_encode($respuesta));
                }

                // EDITAR
                if(isset($_POST['updateElemento'])){            
                    session_start();
                    $idEle= $_POST['idEle'];
                    $nombre= $_POST['nombreEle'];
                    $desc= $_POST['descEle'];
                    $cant= $_POST['cantEle'];
                    $date= $_POST['calendario'];
                    $date1= $_POST['fechahoy'];
                    $campo= $_POST['estado'];
                    $obser= $_POST['obserEle'];
                    try {  
                        if($date<$date1){
                            $respuesta=array(
                                        'respuesta' => 'Fecha pasada'                   
                                    );                           
                        }
                        else{
                        
                    include_once 'connection.php';
                    $query="UPDATE elementos SET nombre='$nombre',descripcion='$desc',cantidad='$cant',fecha_revision='$date',estado='$campo',observacion='$obser' 
                    WHERE id_elemento=".$idEle;
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
                    } }catch (Exception $e){
                        echo "Error:".$e->getMessage();
                    }                
                    die(json_encode($respuesta));
                    } 
                    
                // ELIMINAR
                if($_POST['registroElemento']=='eliminar'){
                    $idele = $_POST['id'];
                        try{
                    include_once 'connection.php';
                    $query="DELETE FROM `elementos` WHERE id_elemento=".$idele;
                   
                if(mysqli_query($con,$query)==1){
                    $respuesta=array(
                        'respuesta' => 'exitoso',
                        'id_borrar' => $idele               
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
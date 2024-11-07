<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Poppins" rel="stylesheet">
    <title>Guia de Evaluación</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/elemento.css">
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>
</head>
<?php
        include '../controller/business.php';
        $idplan=$_REQUEST['cod'];
        $obj=new Negocio();
        //$idaudit=$_SESSION["idAuditor"];    
        $mguia=$obj->Mostrarguia($idplan);
        $contarAudClosed = $obj->ContarAudClosed($idplan);
        $mostrar_botonAudClosed = false;
        /*$contarAud = $obj->ContarAud();
        $mostrar_boton = false;

        if ($contarAud > 0){
          $mostrar_boton = TRUE;
        }else{
          $mostrar_boton = FALSE;
        }*/

        if ($contarAudClosed > 0) {
          $mostrar_botonAudClosed = TRUE;
        } else {
          $mostrar_botonAudClosed = FALSE;
        }
      ?>
      
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="objetivos.php">Objetivos</a></li>
                <li><a href="plan.php">Plan</a></li>
                <li><a href="equipo.php">Equipo</a></li>
                <li><a href="guia.php">Guía de evaluación</a></li>
                <li><a href="informe.php">Informe</a></li>
            </ul>
        </nav>
    </header>
<!-- BOTON NUEVO -->
<main class="elementos">
        <a href="plan.php?cod=<?=$idplan?>" class="btn-back">Atrás</a>
        <h1>Guía de Evaluación</h1>
    <div class="container-btn">
      <div class="row">    
        <div class="col-lg-12" >
        <?php if ($mostrar_botonAudClosed): ?>                    
        <button class="btn btn-success btnAgregarGuia" style="margin-bottom: 3%;" data-id="<?php echo $idplan;?>">Nuevo</button>
        <?php endif; ?> 
      </div>
      </div>
    </div>
            <table id="tguia" class="table table-striped table-bordered" style="width:100%;padding:20px;margin-top: 50px;">
            <thead class="text-center">
                <tr>
                  <th>Actividad a evaluar</th>
                  <th>Procedimiento</th>
                  <th>Herramientas a utilizar</th>
                  <th>Observaciones</th> 
                  <?php if ($mostrar_botonAudClosed): ?> 
                  <th>Editar</th>
                  <th>Eliminar</th>
                  <?php endif; ?>    
                </tr>
            </thead>
            <tbody class="text-center">
            <?php
                    foreach ($mguia as $k=>$d){?>
                    <tr>                 
                      <td><?php echo $d[1]?></td>
                      <td><?php echo $d[2]?></td>
                      <td><?php echo $d[3]?></td>
                      <td><?php echo $d[4]?></td>
                      <?php if ($mostrar_botonAudClosed): ?>
                      <td><button class='btn btn-primary btnGuiaEditar' data-id="<?php echo $d[0]?>">Editar</button>
                      <td><input type="hidden" name="borrar" value=""><button type="submit" data-tipo="Insertar" class='btn btn-danger btnBorrarGuia' data-id=<?php echo $d[0]?>>Eliminar</button></td>
                      <?php endif; ?>
                    </tr>                                                                           
                        <?php }
              ?> 
            </tbody>          
            </table>
            <!-- NUEVO -->
                  <div class="modal fade modal modal-warning fade" id="custModalGuiaAgregar" role="dialog" tabindex="-1" aria-labelledby="custModalAgregarGuia" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Nuevo</h4>
                              <a type="button" href="guia_evaluacion.php?cod=<?=$idplan?>" class="close" data-dismiss="modal">&times;</a>
                              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                            </div>                       
                            <div class="modal-body">
                              
                            </div>
                            <div class="modal-footer">
                                <a type="button"  href="guia_evaluacion.php?cod=<?=$idplan?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            </div>
                        </div>
                    </div>
                  </div>

            <!-- EDITAR -->
                  <div class="modal fade modal modal-warning fade" id="custModalGuiaEditar" role="dialog" tabindex="-1" aria-labelledby="custModalEditarGuia" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Editar</h4>
                              <a type="button" href="guia_evaluacion.php?cod=<?=$idplan?>" class="close" data-dismiss="modal">&times;</a>
                            </div>                       
                            <div class="modal-body1">
                              
                            </div>
                            <div class="modal-footer">
                                <a type="button"  href="guia_evaluacion.php?cod=<?=$idplan?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                            </div>
                        </div>
                    </div>
                  </div>              
</body>
  
<!-- Datatable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="../lib/bootstrap.min.css">
<script type="text/javascript" src="../js/Principal.js"></script>
<script src="../lib/sweetalert2.all.js"></script>
<script src="../lib/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function(){
    $("#tguia").DataTable({
       "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      }
    });
  });
  </script>
      
</html>
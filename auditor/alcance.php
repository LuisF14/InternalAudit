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
    <title>Alcance</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/alcance.css">
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../lib/bootstrap.min.css">
</head>

<?php
include '../controller/business.php';
$idplan = $_REQUEST['cod'];
$obj = new Negocio();
$m_alcances = $obj->MostrarAlcances($idplan);
$contarAudClosed = $obj->ContarAudClosed($idplan);
$mostrar_botonAudClosed = false;
/*$contarAud = $obj->ContarAud();
$mostrar_boton = false;

if ($contarAud > 0) {
    $mostrar_boton = TRUE;
} else {
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
                <li><a href="menu_principal.php">Inicio</a></li>
                <li><a href="plan.php">Plan</a></li>
                <li><a href="informe.php">Informe</a></li>
            </ul>
        </nav>
    </header>

    <main class="alcance">
        <a href="plan.php?cod=<?= $idplan ?>" class="btn-back">Atrás</a>
        <h1>Alcance</h1>
        <table id="talcances" class="table table-striped table-bordered" style="width:100%;padding:20px;margin-top: 50px;">
            <thead class="text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <?php if ($mostrar_botonAudClosed): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $tipoArray = [
                    1 => 'Equipos incluidos',
                    2 => 'Areas cubiertas',
                    3 => 'Criterios',
                    4 => 'Sistemas y aplicaciones',
                    5 => 'Procesos y procedimientos',
                    6 => 'Aspectos de seguridad',
                    7 => 'Cumplimiento normativo',
                    8 => 'Datos evaluados',
                    9 => 'Periodo de auditoría',
                    10 => 'Exclusiones'
                ];
                foreach ($tipoArray as $key => $value) {
                    $mostrar_botonNuevo = true;
                    $mostrar_botonDetalle = false;
                    $datosAlcance = null;

                    foreach ($m_alcances as $a => $d) {
                        if ($d[2] == $key) {
                            $contador = $obj->ContarAlcance($d[2]);
                            if ($contador > 0) {
                                $mostrar_botonNuevo = false;
                                $mostrar_botonDetalle = true;
                            }
                            $datosAlcance = $d;
                            break;
                        }
                    }

                ?>
                    <tr>
                        <td><?php echo isset($value) ? $value : 'SIN VALOR'; ?></td>
                        <td><?php echo isset($datosAlcance) ? $datosAlcance[3] : ''; ?></td>
                        <?php if ($mostrar_botonAudClosed): ?>
                            <?php if ($mostrar_botonNuevo): ?>
                                <td><button class="btn btn-success btnAgregarAlcance" data-id="<?php echo $key ?>" data-id2="<?php echo $idplan ?>">Nuevo</button></td>
                            <?php endif; ?>
                            <?php if ($mostrar_botonDetalle): ?>
                                <td><button class='btn btn-primary btnEditarAlcance' data-id="<?php echo $d[0] ?>">Editar</button>
                                    <input type="hidden" name="borrar" value=""><button type="submit" data-tipo="Agregar" class='btn btn-danger btnBorrarAlcance' data-id=<?php echo $d[0] ?>>Eliminar</button>
                                    <button class='btn btn-info btnVerAlcance' data-id="<?php echo $d[0] ?>">Ver</button>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- AGREGAR -->
        <div class="modal fade modal modal-warning fade" id="custModalAlcanceAgregar" role="dialog" tabindex="-1" aria-labelledby="custModalAgregarGuia" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nuevo</h4>
                        <a type="button" href="alcance.php?cod=<?= $idplan ?>" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    <div class="modal-bodyAdd">

                    </div>
                    <div class="modal-footer">
                        <a type="button" href="alcance.php?cod=<?= $idplan ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDITAR -->
        <div class="modal fade modal modal-warning fade" id="custModalAlcanceEditar" role="dialog" tabindex="-1" aria-labelledby="custModalAgregarGuia" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar</h4>
                        <a type="button" href="alcance.php?cod=<?= $idplan ?>" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <a type="button" href="alcance.php?cod=<?= $idplan ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Datatable -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../lib/bootstrap.min.css">
    <script type="text/javascript" src="../js/principal.js"></script>
    <script src="../lib/sweetalert2.all.js"></script>
    <script src="../lib/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $("#talcances").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>

</html>
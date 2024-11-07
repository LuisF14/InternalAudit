<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Menu</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='../lib/sweetalert2.min.css'>
</head>
<?php
include "../template/header.php";
include '../controller/business.php';
/*$idem=$_REQUEST['cod'];*/
$obj = new Negocio();
$anio = date("Y");
$mAud = $obj->verAuditorias($anio);

$fecha_hoy = date("Y-m-d");
$codaud = $obj->ConsultarAuditoriaCod();
$dias = $obj->ContarDias();
$contarAud = $obj->ContarAud();
$fechaIni = $obj->devolverFechaAuditVig();

// Inicializamos variables para controlar los botones
$mostrar_boton_crear = false;
$mostrar_boton_finalizar = false;
$idplan = null; // Para evitar errores en el caso de que $contarAud <= 0

// Lógica para mostrar los botones
if ($codaud != null) {
    $idplan = $obj->ConsultarPlanCod($codaud);
}
if ($contarAud > 0) {
    $fecha = new DateTime($fechaIni);
    $fecha->modify('+3 months');
    $FechaVig = $fecha->format('Y-m-d');
    if ($fecha_hoy >= $FechaVig) {
        $mostrar_boton_finalizar = true;
    } else {
        $mostrar_boton_finalizar = false;
    }
} else {
    $mostrar_boton_crear = true;
}

?>

<body class="body_menu_principal">
    <!-- ENCABEZADO -->
    <header class="header_menu_principal">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Plan</a></li>
                <li><a href="#">Informe</a></li>
                <li style="padding: 10px 5px; display: block; text-align: center; margin-top: 15px; font-size: 19px;">
                    <a href="logout.php">CERRAR SESION</a>
                </li>

            </ul>
        </nav>
    </header>
    <!-- FIN DE ENCABEZADO -->

    <!-- MAIN -->
    <main class="main_menu_principal">
        <section class="hero">
            <h1>Proceso de Auditoría</h1>
            <h2>Equipos Informáticos</h2>
            <div class="buttons">
                <!--<a href="ver.php" class="btn-ver">Ver</a>-->
                <p style="text-align: center;"><a href="javascript:void(0);" style="text-decoration: none;color: #424242;" data-bs-toggle="modal" data-bs-target="#verModal">Ver</a></p>
                <?php if ($mostrar_boton_crear): ?>
                    <form action="../controller/crearAuditoria.php" method="POST" style="display: inline;">
                        <button type="submit" name="crear" class="btn-crear">Crear</button>
                    </form>
                <?php endif; ?>

                <?php if ($mostrar_boton_finalizar): ?>
                    <form action="../controller/OperacionFinalizar.php" method="POST" style="display: inline;">
                        <button type="submit" name="finalizar" class="btn-crear">Finalizar</button>
                        <input type='hidden' class='form-control' name='idAud' value="<?= $codaud ?>">
                    </form>
                <?php endif; ?>
            </div>

            <!-- Modal para ver auditoria -->
            <div class="modal fade modal modal-warning fade" id="verModal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verModalLabel">Ver auditorias</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de ver auditorias -->
                            <form id="verAuditoriasForm" action="menu_principalVer.php?codVer=<?php echo $d[0] ?>" method="POST">
                                <table id="telementos" class="table table-striped table-bordered" style="width:100%;padding:20px;margin-top: 50px;">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Periodo</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        foreach ($mAud as $k => $d) { ?>
                                            <tr>
                                                <td><?php echo $d[1] ?></td>
                                                <input type='hidden' class='form-control' name='idAud' value=<?= $codaud ?>>
                                                <td>
                                                    <a class="btn btn-primary" href="menu_principalVer.php?codVer=<?php echo $d[0] ?>">Ver</a>
                                                </td>


                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <!--<button type="submit" name="verAuditorias" class="btn btn-primary">Enviar código</button>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </section>
        <section class="plan">
            <h3>Plan</h3>
            <p>Establecer el plan a llevar a cabo</p>
            <a href="plan.php?cod=<?= $idplan !== null ? $idplan : 0 ?>" cod class="btn-ir">Ir</a>
        </section>
        <section class="informe">
            <h3>Informe</h3>
            <p>Informe final</p>
            <a href="informe.php?cod=<?= $codaud ?>" class="btn-ir">Ir</a>
        </section>
    </main>

    <!-- PIE DE PAGINA -->
    <?php include '../template/footer.php'; ?>
    <!-- FIN DE PIE DE PAGINA -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/lightbox.js"></script>
    <script src="../js/slider.js"></script>
    <script src="../js/tabs.js"></script>
    <script src="../js/bgParallax.js"></script>
    <script src="../js/scroll.js"></script>
    <script src="../js/menuMovil.js"></script>
    <script>
        document.getElementById("crearButton").addEventListener("click", function() {
            this.disabled = true; // Deshabilita el botón después de hacer clic
        });
    </script>
</body>

</html>
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

$obj = new Negocio();
$codaud=$_REQUEST['codVer'];
$anio = date("Y");
$mAud = $obj->verAuditorias($anio);
$nomAud = $obj->verNombreAuditorias($codaud);

$fecha_hoy = date("Y-m-d");
//$codaud = $obj->ConsultarAuditoriaCod();
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
            <h2><?php echo $nomAud; ?></h2>
        </section>
        <section class="plan">
            <h3>Plan</h3>
            <p>Establecer el plan a llevar a cabo</p>
            <a href="plan.php?cod=<?= $idplan ?>" cod class="btn-ir">Ir</a>
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
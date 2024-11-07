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
</head>
<?php
include "../template/header.php";
include '../controller/business.php';
/*$idem=$_REQUEST['cod'];*/
$obj = new Negocio();


$codaud = $obj->ConsultarAuditoriaCod();
$dias = $obj->ContarDias();
$contarAud = $obj->ContarAud();

$idplan = null; // Para evitar errores en el caso de que $contarAud <= 0

?>

<body class="body_menu_principal">
    <!-- ENCABEZADO -->
    <header class="header_menu_principal">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Informe</a></li>
                <li style="padding: 10px 5px; display: block; text-align: center; margin-top: 15px; font-size: 19px;">
                    <a href="logoutTI.php">CERRAR SESION</a>
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
                <a href="ver.php" class="btn-ver">Ver</a>
            </div>
        </section>
        <section class="informe">
            <h3>Informe</h3>
            <p>Informe final</p>
            <a href="informeTI.php?cod=<?= $codaud ?>" class="btn-ir">Ir</a>
        </section>
    </main>

    <!-- PIE DE PAGINA -->
    <?php include '../template/footer.php'; ?>
    <!-- FIN DE PIE DE PAGINA -->
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
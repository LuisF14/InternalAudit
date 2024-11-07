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
    <title>Equipo</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/equipo_auditoria.css">
</head>
    <?php
        include '../controller/business.php';
        $idplan=$_REQUEST['cod'];
        $obj=new Negocio();
        $mequi=$obj->MostrarequipoAuditoria();  
    ?>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="objetivos.php">Objetivos</a></li>
                <li><a href="plan.php">Plan</a></li>
                <li><a href="equipo.php" class="active">Equipo</a></li>
                <li><a href="guia.php">Guía de evaluación</a></li>
                <li><a href="informe.php">Informe</a></li>
            </ul>
        </nav>
    </header>

    <main class="equipo">
    <a href="plan.php?cod=<?=$idplan?>" class="btn-back">Atrás</a>
    <h1>Equipo</h1>
    <div class="equipo-grid">             
        <?php foreach ($mequi as $k => $d) { ?>
            <div class="miembro">
                <div class="imagen">
                    <img src="../img/<?php echo $d[1] . '_' . $d[2]; ?>.png" alt="<?php echo $d[1] . ' ' . $d[2]; ?>">
                </div>
                <!--<div class="puesto">PUESTO</div>-->
                <div class="nombre"><?php echo $d[1]; ?></div>
            </div>
        <?php } ?>
    </div>
</main>

    <?php include '../template/footer.php'; ?>
    <!-- FIN DE PIE DE PAGINA -->
	<script src="../js/lightbox.js"></script>
	<script src="../js/slider.js"></script>
	<script src="../js/tabs.js"></script>
	<script src="../js/bgParallax.js"></script>
	<script src="../js/scroll.js"></script>
	<script src="../js/menuMovil.js"></script>
</body>
</html>

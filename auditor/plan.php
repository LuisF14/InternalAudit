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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,maximum-scale=1.0,minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Poppins" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/plan.css">
    <title>Planificación</title>
</head>
    <?php
        include '../controller/business.php';
        $idplan=$_REQUEST['cod'];
        //echo $idplan;
        $obj=new Negocio();
        $codaud = $obj->ConsultarAuditoriaCod();
        $contarAud = $obj->ContarAud();
        $mostrar_boton = false;

        if ($contarAud > 0){
            $mostrar_boton = TRUE;
          }else{
            $mostrar_boton = FALSE;
          }       

    ?>	
<body>
    <header>
        <nav>
            <ul>
                <li><a href="menu_principal.php?cod=<?= $codaud !== null ? $codaud : 0 ?>">Inicio</a></li>                
                <li><a href="plan.php?cod=<?= $idplan !== null ? $idplan : 0 ?>">Plan</a></li>
                <li><a href="informe.php">Informe</a></li>
            </ul>
        </nav>
    </header>

    <main class="planificacion">
    <?php if ($mostrar_boton): ?> 
        <a href="menu_principal.php" class="btn-back">Atrás</a>
        <?php endif; ?> 
        <h1>Plan</h1>
        <div class="plan-items">
            <div class="plan-item">
                <p>Objetivos</p>
                <a href="objetivo.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
            <div class="plan-item">
                <p>Alcance</p>
                <a href="alcance.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
            <div class="plan-item">
                <p>Criterios</p>
                <a href="criterios.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
            <div class="plan-item">
                <p>Equipo auditor</p>
                <a href="equipo_auditoria.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
            <div class="plan-item">
                <p>Lista de elementos</p>
                <a href="elemento.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
            <div class="plan-item">
                <p>Guía de evaluación</p>
                <a href="guia_evaluacion.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
            <div class="plan-item">
                <p>Cronograma de reuniones</p>
                <a href="cronograma.php?cod=<?=$idplan?>" class="btn-definir">Definir</a>
            </div>
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

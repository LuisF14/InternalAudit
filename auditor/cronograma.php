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
    <title>Cronograma de actividades</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/cronograma.css">
</head>
<?php
include '../controller/business.php';
$idplan = $_REQUEST['cod'];
$obj = new Negocio();
$mobj = $obj->Mostrarcronograma($idplan);

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

    <main class="cronograma">
        <a href="plan.php?cod=<?= $idplan ?>" class="btn-back">Atrás</a>
        <form role='form' method='post' name='addcronograma' id='addcronograma' action="../controller/OperacionCronogramaAgregar.php">
            <input type='hidden' class='form-control' name='idplan' value='<?php echo $idplan; ?>'>
            <h1>Cronograma de actividades</h1>
            <div class="actividades">
                <?php

                $tipoArray = [
                    1 => 'Alcances',
                    2 => 'Objetivos',
                    3 => 'Criterios',
                    4 => 'Equipo auditor',
                    5 => 'Guia de evaluacion',
                    6 => 'Lista de elementos'
                ];

                foreach ($tipoArray as $key => $value) {
                    $mostrar_botonNuevo = true;
                    $mostrar_botonDetalle = false;
                    $datosCronograma = null;

                    foreach ($mobj as $a => $d) {
                        if ($d[1] == $key) {
                            $contador = $obj->ContarCronograma($d[0]);
                            if ($contador > 0) {
                                $mostrar_botonNuevo = false;
                                $mostrar_botonDetalle = true;
                            }
                            $datosCronograma = $d;
                            break;
                        }
                    }
                ?>
                    <div class="actividad">
                        <span><?php echo isset($value) ? $value : 'SIN VALOR'; ?></span>
                        <input type='hidden' class='form-control' name='idTipo[]' value='<?php echo $key ?>'>
                        <input type="date" value="<?php echo isset($datosCronograma) ? $datosCronograma[2] : ''; ?>" class="fecha-inicio" id='fecha1' name='fecha1[]'>
                        <span>—</span>
                        <input type="date" value="<?php echo isset($datosCronograma) ? $datosCronograma[3] : ''; ?>" class="fecha-fin" id='fecha2' name='fecha2[]'>
                    </div>

                <?php } ?>
            </div>

            <input type='hidden' name='addcronograma' value=''>
            <?php if ($mostrar_botonAudClosed): ?>
            <button style='margin-left:190px;margin-top:20px' type='submit' class='btn btn-dark'>Grabar</button>
            <?php endif; ?>
        </form>
    </main>

    <?php include '../template/footer.php'; ?>
    <!-- FIN DE PIE DE PAGINA -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/lightbox.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../lib/bootstrap.min.css">
    <script type="text/javascript" src="../js/principal.js"></script>
    <script src="../lib/sweetalert2.all.js"></script>
    <script src="../lib/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
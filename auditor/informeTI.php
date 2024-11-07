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
    <title>Informe final</title>
    <!--<link rel="stylesheet" href="../css/style.css">-->
    <link rel="stylesheet" href="../css/informe.css">
</head>
<?php
include '../controller/business.php';
$idaud = $_REQUEST['cod'];
//$idinforme=$_REQUEST['informe'];
//echo $idplan;
$obj = new Negocio();
//$idaudit=$_SESSION["idAuditor"];    
//$emp=$obj->Insertarbu($idaudit);  
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

    <main>
        <a href="menu_principalTI.php" class="btn-back">Atrás</a>
        <h1>Informe final</h1>

        <div class="btn-group">
            <form action="../controller/exportar.php" method="post" target="_blank">
                <button class="btn" type="submit" name="exportar">Exportar PDF</button>
            </form>
        </div>

        <table class="table-informe">
            <tbody>
                <tr>
                    <th>Nº</th>
                    <th colspan="2">Informe Final</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Cronograma</td>
                    <td id="data_objetivos"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Alcances</td>
                    <td id="data_alcance"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Objetivos</td>
                    <td id="data_equipo"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Guía de evaluación</td>
                    <td id="data_lista"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Lista de elementos</td>
                    <td id="data_guia"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Conclusiones</td>
                    <td id="data_conclusiones"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Recomendaciones</td>
                    <td id="data_recomendaciones"></td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>
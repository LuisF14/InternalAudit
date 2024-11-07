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
    <title>Criterios</title>
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/criterio.css">
</head>
<?php
    include '../controller/business.php';
    $idplan=$_REQUEST['cod'];
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

    <main class="criterios">
        <a href="plan.php?cod=<?=$idplan?>" class="btn-back">Atrás</a>
        <h1>Criterios</h1>
        <h2>Normas globales de auditoría interna</h2>
        <h3>Dominios</h3>
        <div class="dominios">
            <div class="dominio">
                <span>Propósito de la auditoría interna</span>
                <button class="btn-ver" onclick="openModal('modal1')">Ver</button>
            </div>
            <div class="dominio">
                <span>Ética y profesionalismo</span>
                <button class="btn-ver" onclick="openModal('modal2')">Ver</button>
            </div>
            <div class="dominio">
                <span>Gobernanza de la función de auditoría interna</span>
                <button class="btn-ver" onclick="openModal('modal3')">Ver</button>
            </div>
            <div class="dominio">
                <span>Gestión de la función de auditoría interna</span>
                <button class="btn-ver" onclick="openModal('modal4')">Ver</button>
            </div>
            <div class="dominio">
                <span>Realización de servicios de auditoría interna</span>
                <button class="btn-ver" onclick="openModal('modal5')">Ver</button>
            </div>
        </div>

        <!-- Modales -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modal1')">&times;</span>
                <h2>Propósito de la auditoría interna</h2>
                <p>La auditoría interna fortalece la capacidad de la organización para crear, proteger y mantener su valor. Los auditores deben proporcionar aseguramiento y asesoramiento independiente, enfocados en la evaluación de riesgos y el cumplimiento de los objetivos organizacionales. Es crucial que el auditor evalúe los sistemas clave que apoyan las operaciones y el flujo de información, asegurando la eficiencia y confiabilidad de los mismos.</p>
            </div>
        </div>

        <div id="modal2" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modal2')">&times;</span>
                <h2>Ética y profesionalismo</h2>
                <p>El auditor interno debe adherirse a altos estándares éticos, manteniendo la integridad, objetividad, competencia y confidencialidad. Es esencial proteger la información sensible, aplicando estándares rigurosos en su manejo, y evitar cualquier tipo de conflicto de interés. La transparencia y precisión en la evaluación de procesos y sistemas son fundamentales para asegurar decisiones informadas.</p>
            </div>
        </div>

        <div id="modal3" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modal3')">&times;</span>
                <h2>Gobernanza de la función de auditoría interna</h2>
                <p>El gobierno adecuado de la auditoría interna asegura que esta funcione de manera independiente, con el respaldo del Consejo y la alta dirección. Es importante que los auditores tengan acceso completo a los sistemas y procesos que impactan en la organización, garantizando la evaluación de los riesgos operacionales y estratégicos.</p>
            </div>
        </div>

        <div id="modal4" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modal4')">&times;</span>
                <h2>Gestión de la función de auditoría interna</h2>
                <p>Una gestión eficaz de la auditoría interna implica la planificación estratégica y el uso eficiente de los recursos disponibles, tanto humanos como tecnológicos. Es esencial que los auditores internos estén bien capacitados y que utilicen herramientas adecuadas para el análisis y la evaluación de los datos críticos para el desempeño organizacional.</p>
            </div>
        </div>

        <div id="modal5" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('modal5')">&times;</span>
                <h2>Realización de servicios de auditoría interna</h2>
                <p>Este dominio se centra en la ejecución eficaz de los servicios de auditoría, desde la planificación hasta la comunicación de resultados. Los auditores deben adoptar un enfoque sistemático que permita identificar riesgos y evaluar la efectividad de los sistemas y controles, asegurando que las recomendaciones sean prácticas y accionables para la mejora continua.</p>
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
    
    <!-- Script para abrir y cerrar los modales -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Cierra el modal si el usuario hace clic fuera de la ventana modal
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>

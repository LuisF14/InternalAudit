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
	<title>APARTADO DE CONCLUSIONES</title>
	<link rel="stylesheet" href="../css/all.css">
	<link rel="stylesheet" href="../css/conyrec.css">
</head>

<?php
include "../template/header.php";
include '../controller/business.php';
$idaud = $_REQUEST['cod'];
$obj = new Negocio();
$mcon = $obj->MostrarCon($idaud);
$mrec = $obj->MostrarRec($idaud);

$contarAudClosed = $obj->ContarAudClosedbyAud($idaud);
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
	<section class="main">
		<section id="ConyRec" class="ConyRec">
			<div class="container">
				<div class="titulo-seccion">
					<a href="informe.php?cod=<?= $idaud ?>" class="btn-back">Atrás</a>
					<h2>CONCLUSIONES Y RECOMENDACIONES</h2>
				</div>
				<div class="contenedor-ConyRec">
					<ul id="encabezado_ConyRec" class="encabezado">
						<li><a href="#Conclusiones">Conclusiones</a></li>
						<li><a href="#Recomendaciones">Recomendaciones</a></li>
					</ul>
					<div class="contenido" id="contenido_ConyRec">
						<!-- MENU CONCLUSIONES -->
						<div id="Conclusiones">
							<div class="item">
								<div class="col izq">
									<div class="container-btn">
										<div class="row">
											<div class="col-lg-12" style="margin-left: 45%;margin-bottom: 3%;">
											<?php if ($mostrar_botonAudClosed): ?>
												<button class="btn btn-success btnAgregarConclusiones" data-id="<?php echo $idaud; ?>">Nuevo</button>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<table id="tconclusion" class="table table-striped table-bordered" style="width:100%;padding:20px;margin-top: 50px;">
										<thead class="text-center">
											<tr>
												<th>N°</th>
												<th>Conclusión</th>
												<?php if ($mostrar_botonAudClosed): ?>
												<th>Editar</th>
												<th>Eliminar</th>
												<?php endif; ?>
											</tr>
										</thead>
										<tbody class="text-center">
											<?php
											foreach ($mcon as $k => $d) { ?>
												<tr>
													<td><?php echo $d[0] ?></td>
													<td><?php echo $d[1] ?></td>
													<?php if ($mostrar_botonAudClosed): ?>
													<td><button class='btn btn-primary btnEditarConclusiones' data-id=<?php echo $d[0] ?>>Editar</button>
													<td><input type="hidden" name="borrar" value=""><button type="submit" data-tipo="Insertar" class='btn btn-danger btnBorrarConclusiones' data-id=<?php echo $d[0] ?>>Eliminar</button></td>
													<?php endif; ?>
												</tr>
											<?php }
											?>
										</tbody>
									</table>

									<!-- NUEVO -->
									<div class="modal fade modal modal-warning fade" id="custModalConclusionAgregar" role="dialog" tabindex="-1" aria-labelledby="custModalAgregarConclusion" aria-hidden="true">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Nuevo</h4>
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="close" data-dismiss="modal">&times;</a>
												</div>
												<div class="modal-body">

												</div>
												<div class="modal-footer">
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
												</div>
											</div>
										</div>
									</div>

									<!-- EDITAR -->
									<div class="modal fade modal modal-warning fade" id="custModalConclusionEditar" role="dialog" tabindex="-1" aria-labelledby="custModalEditarConclusion" aria-hidden="true">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Editar</h4>
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="close" data-dismiss="modal">&times;</a>
												</div>
												<div class="modal-body1">

												</div>
												<div class="modal-footer">
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- FIN CONCLUSIONES -->

						<!-- RECOMENDACIONES -->

						<div id="Recomendaciones">
							<div class="item">
								<div class="col izq">
									<div class="container-btn">
										<div class="row">
											<div class="col-lg-12" style="margin-left: 45%;margin-bottom: 3%;">
											<?php if ($mostrar_botonAudClosed): ?>
												<button class="btn btn-success btnAgregarRecomendaciones" data-id="<?php echo $idaud; ?>">Nuevo</button>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<table id="trecomendacion" class="table table-striped table-bordered" style="width:100%;padding:20px;margin-top: 50px;">
										<thead class="text-center">
											<tr>
												<th>N°</th>
												<th>Recomendación</th>
												<?php if ($mostrar_botonAudClosed): ?>
												<th>Editar</th>
												<th>Eliminar</th>
												<?php endif; ?>
											</tr>
										</thead>
										<tbody class="text-center">
											<?php
											foreach ($mrec as $k => $d) { ?>
												<tr>
													<td><?php echo $d[0] ?></td>
													<td><?php echo $d[1] ?></td>
													<?php if ($mostrar_botonAudClosed): ?>
													<td><button class='btn btn-primary btnEditarRecomendaciones' data-id=<?php echo $d[0] ?>>Editar</button>
													<td><input type="hidden" name="borrar" value=""><button type="submit" data-tipo="Insertar" class='btn btn-danger btnBorrarRecomendaciones' data-id=<?php echo $d[0] ?>>Eliminar</button></td>
													<?php endif; ?>
												</tr>
											<?php }
											?>
										</tbody>
									</table>

									<!-- NUEVO -->
									<div class="modal fade modal modal-warning fade" id="custModalRecomendacionAgregar" role="dialog" tabindex="-1" aria-labelledby="custModalAgregarRecomendacion" aria-hidden="true">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Nuevo</h4>
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="close" data-dismiss="modal">&times;</a>
												</div>
												<div class="modal-body2">

												</div>
												<div class="modal-footer">
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
												</div>
											</div>
										</div>
									</div>

									<!-- EDITAR -->
									<div class="modal fade modal modal-warning fade" id="custModalRecomendacionEditar" role="dialog" tabindex="-1" aria-labelledby="custModalEditarRecomendacion" aria-hidden="true">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Editar</h4>
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="close" data-dismiss="modal">&times;</a>
												</div>
												<div class="modal-body3">

												</div>
												<div class="modal-footer">
													<a type="button" href="ConyRec.php?cod=<?= $idaud ?>" class="btn btn-default" data-dismiss="modal">Cancelar</a>
												</div>
											</div>
										</div>
									</div>
									<!-- FIN EDITAR  -->
								</div>
							</div>
						</div>
						<!-- FIN RECOMENDACIONES -->
					</div>
				</div>
			</div>
		</section>
		<!-- FIN  CONYREC  -->
	</section>
	<!-- FIN MAIN -->
</body>


<!-- ChartJS -->
<script src="../lib/chart.js/Chart.min.js"></script>

<script src="../js/tabs1.js"></script>

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
		$("#tconclusion").DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			},
			"columnDefs": [
        {
            "targets": 0, // Apunta a la primera columna, la de "N°"
            "render": function (data, type, row, meta) {
                return meta.row + 1; // Incrementa el índice para cada fila
            }
        }
    ]
		});
	});
</script>
<script>
	$(document).ready(function() {
		$("#trecomendacion").DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			},
			"columnDefs": [
        {
            "targets": 0, // Apunta a la primera columna, la de "N°"
            "render": function (data, type, row, meta) {
                return meta.row + 1; // Incrementa el índice para cada fila
            }
        }
    ]
		});
	});
</script>


</html>
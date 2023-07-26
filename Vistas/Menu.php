<?php
if (!isset($_SESSION['validarIngreso'])) {

	echo '<script>window.location="login.php";</script>';
	return;
} elseif($id != 80) {
	echo '<script>window.location="listaMesas";</script>';

}else {
	if ($_SESSION['validarIngreso'] != "ok") {

		echo '<script>window.location="login.php";</script>';
		return;
	}
}
?>
<div class="container-fluid">
	<h5 class="text-center mt-0">SISTEMA ELECCIONES 2021</h5>
	<div class="row mt-1">
		<?php if ($usuario=='Administrador') { ?>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2">
					<a href="listaUsuarioContrasenia" class="alert d-flex align-items-center linkOpcionMenu py-5" type="button">
						<i class="fad fa-users-cog icoMenuTramite"></i>
						<div class="w-100">
							<h6 class="text-center fw-bold m-0">LISTA DE USUARIOS</h6>
						</div>
					</a>
				</div>
		<?php		}  ?>
		
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2">
			<a href="listaMesas" class="alert d-flex align-items-center linkOpcionMenu py-5" type="button">
				<i class="fad fa-money-check-edit icoMenuTramite"></i>
				<div class="w-100">
					<h6 class="text-center fw-bold m-0">FORMULARIO DE CARGA</h6>
				</div>
			</a>
		</div>

		<!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2">
			<a href="listaFormularios" class="alert d-flex align-items-center linkOpcionMenu py-5" type="button">
				<i class="fal fa-clipboard-list-check icoMenuTramite"></i>
				<div class="w-100">
					<h6 class="text-center fw-bold m-0 px-2">LISTADO DE FORMULARIOS CARGADOS</h6>
				</div>
			</a>
		</div> -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2">
			<a href="resultados" class="alert d-flex align-items-center linkOpcionMenu py-5" type="button">
				<!-- <i class="fal fa-clipboard-list-check"></i> -->
				<i class="fad fa-chart-bar icoMenuTramite"></i>
				<div class="w-100">
					<h6 class="text-center fw-bold m-0 px-2">RESULTADOS EN TIEMPO REAL</h6>
				</div>
			</a>
		</div>
	</div><br><br>
</div>

<div class="row ConteinerPreloader mb-5">
	<div class="col-12 ConteinerSpinner text-center" style="padding: 15px 20px !important;">
		<div class="px-3 py-3" style="margin-top: 60% !important; border-radius: 5px">
			<center>
				<img class="imgSpinner" src="Librerias/img/vc-logo.png" width="70px" height="70px">
				<div class="spinner mb-4"></div>
			</center>
			<h5 class="fw-bold text-white" style="font-weight: bold !important;">Cargando...</h5>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(window).load(function() {
		$(".ConteinerPreloader").fadeOut("slow");
	});
</script>
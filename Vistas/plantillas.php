<?php session_start() ?>
<?php
if (!isset($_SESSION['validarIngreso'])) {

	echo '<script>window.location="login.php";</script>';
	return;
} else {
	if ($_SESSION['validarIngreso'] != "ok") {

		echo '<script>window.location="login.php";</script>';
		return;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" type="image/png" href="Librerias/img/vc-logo2.png" />
		<title>Sistema Carga Elecciones 2021</title>
		<?php include_once "header.php"; ?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="Librerias/css/Estilos/style.css">
		<link rel="stylesheet" href="Librerias/css/Estilos/Generales.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="Librerias/css/jcrop/css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="Librerias/alertifyjs/css/alertify.css">
		<script src="Librerias/alertifyjs/alertify.js"></script>
	</head>

	<body>
		<?php include_once "nav.php"; ?>
		<div class="container-fluid">
			<?php
				if (isset($_GET['pagina'])) {
					if ($_GET['pagina'] == "areas") {
						include_once "paginas/" . $_GET['pagina'] . ".php";
					} else if (
						$_GET['pagina'] == "Formulario1" ||
						$_GET['pagina'] == "Formulario2" ||
						$_GET['pagina'] == "Formulario3" ||
						$_GET['pagina'] == "listaUsuarioContrasenia" ||
						$_GET['pagina'] == "listaMesas" ||
						$_GET['pagina'] == "listaFormularios" ||
						$_GET['pagina'] == "FormularioV1" ||
						$_GET['pagina'] == "FormularioV2" ||
						$_GET['pagina'] == "FormularioV3" ||
						$_GET['pagina'] == "resultados"
					// 	$_GET['pagina'] == "SolicitudesHabilitacion" ||
					// 	$_GET['pagina'] == "Formularios"  ||
					// 	$_GET['pagina'] == "MisSolicitudes" ||
					// 	$_GET['pagina'] == "SolicitudHabilitacion1" ||
					// 	$_GET['pagina'] == "SolicitudHabilitacion2" ||
					// 	$_GET['pagina'] == "SolicitudHabilitacion3" ||
					// 	$_GET['pagina'] == "Comprobante"
					) {
						
						include_once "Vistas/paginas/" . $_GET['pagina'] . ".php";
						
					} elseif ($_GET['pagina'] == "login") {
						include_once "login.php";
					} else {
						include_once "Vistas/Error404.php";
					}
				} else {
					include_once "Menu.php";
				}
			?>
			<div class="col-md-12 Botonera text-center bg-primary text-white" style="background-image: url('Librerias/img/fondoazultransp.png') !important;">
				<span style="font-size: 10px; width:80%; text-align: center; padding-button:5px" class="text-center">
						Agrupación Valores Ciudadanos 
					<br> República Argentina
					<br> Todos los Derechos Reservados © 2021
				</span>
			</div>
		</div>
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
			<script src="Librerias/js/Script_Aut/script.js"></script>
			<script src="Librerias/js/Script_Aut/sweetalert.2.10.js" type="text/javascript"></script>
			<script src="Librerias/css/jcrop/js/jquery.Jcrop.js"></script>
			
	</body>

</html>
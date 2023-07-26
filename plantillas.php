<?php session_start() ?>
	<?php 
    if(!isset($_SESSION['validarIngreso'])){

      echo '<script>window.location="login.php";</script>';
      return;

    }else{
    if($_SESSION['validarIngreso']!= "ok"){

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
	<link rel="icon" type="image/png" href="Librerias/img/favicon.png"/>
	<title>Tu Ciudad Digital - Sistema de Trámites en Línea</title>
	<?php include_once"header.php"; ?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="Librerias/css/Estilos/style.css">
	<link rel="stylesheet" href="Librerias/css/Estilos/HabilitacionesComerciales.css">
	<link rel="stylesheet" href="Librerias/css/Estilos/Generales.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="Librerias/css/jcrop/css/jquery.Jcrop.css" type="text/css" />

</head>
<body class="contenedor">
		<?php include_once "nav.php"; ?>
		<div class="container-fluid">
				<?php 
					if (isset($_GET['pagina'])) {
						if ($_GET['pagina'] == "areas"){
							include_once"Areas/".$_GET['pagina'].".php";
						}else if ($_GET['pagina'] == "listaObjetos" ||
								  $_GET['pagina'] == "gestionTramites" ||
								  $_GET['pagina'] == "ConfirmacionTramites" ||
								  $_GET['pagina'] == "AltaImagen" ||
								  $_GET['pagina'] == "EdicionImagen" ||
								  $_GET['pagina'] == "ConfirmacionMensaje" ||
								  $_GET['pagina'] == "form") {
							include_once"Vistas/Areas/Automotores/".$_GET['pagina'].".php";
						}elseif ($_GET['pagina'] == "listaTramites") {
							include_once"Vistas/ListasTramites/".$_GET['pagina'].".php";
						}elseif ($_GET['pagina'] == "indexRequerimientos" || 
								 $_GET['pagina'] == "listaRequerimientosTramites") {
							include_once"Vistas/Requerimientos/".$_GET['pagina'].".php";
						}elseif ($_GET['pagina'] == "Error404") {
							include_once"Vistas/".$_GET['pagina'].".php";

						}elseif ($_GET['pagina'] == "SolicitudLibreDeudaImpresion" || 
								 $_GET['pagina'] == "SolicitudLibreDeudaReimpresion" || 
					 			 $_GET['pagina'] == "SolicitudBajaImpresion" ||
					 			 $_GET['pagina'] == "SolicitudBajaReimpresion" ){
							include_once"Vistas/VistasSolicitudes/".$_GET['pagina'].".php";
						}elseif ($_GET['pagina'] == "noLogueado"){
							include_once $_GET['pagina'].".php";

						}elseif ($_GET['pagina'] == "SolicitudesHabilitacion" || 
								 $_GET['pagina'] == "Formularios"  ||
								 $_GET['pagina'] == "MisSolicitudes" ||
								 $_GET['pagina'] == "SolicitudHabilitacion1" ||
								 $_GET['pagina'] == "SolicitudHabilitacion2" ||
								 $_GET['pagina'] == "SolicitudHabilitacion3" ||
								 $_GET['pagina'] == "Comprobante"
								){
							include_once"Vistas/Areas/Comercios/".$_GET['pagina'].".php";
						}elseif ($_GET['pagina'] == "login"){
								include_once"login.php";
						}else{
							include_once"Vistas/Error404.php";
						}
					}else{
							include_once"MenuTramites.php";
					}
				?>
		</div>
	<?php
		
		require_once "footer.php"; 
		require_once "Vistas/Areas/Modales/ModalAltaImagen.php";
		require_once "Vistas/Areas/Modales/ModalVerImagen.php";
		require_once "Vistas/Areas/Modales/ModalRespuesta.php";
		// require_once "Vistas/Areas/Modales/SolicitudRechazada.php";
		// require_once "Vistas/Areas/Modales/SolicitudAprobada.php";
	?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" ></script>
<script src="Librerias/js/Script_Aut/script.js"></script>
<script src="Librerias/js/Script_Aut/sweetalert.2.10.js" type="text/javascript"></script>
<script src="Librerias/css/jcrop/js/jquery.Jcrop.js"></script>

<script text="javascript">
		history.forward();
    var cuenta=0;
    function enviado() {
        if (cuenta == 0) {
            cuenta++;
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>
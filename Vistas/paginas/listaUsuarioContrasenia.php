<div class="container w-100">
	<center>
		<div class="table mb-5 w-100">
			<script type="text/javascript">
				$(document).ready(function(){
				$('#tabla').load('vistas/paginas/tabla.php');
				});
			</script>
			<div id="tabla"></div>
		</div>
		<form action="./" method="POST">
			<button type="submit" class="btn btn-flotante btn-flotante-left mb-1 text-primary" ><i class="fas fa-reply"></i> Volver</button>
		</form>
	</center>
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




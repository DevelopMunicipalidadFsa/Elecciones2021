<?php
	// Llamamos a la funcion que nos va a enlistar las mesas y los datos que le corresponden a cada usuario
	$ListaMesasUsuario=ControladorElecciones::ctrListaMesasUsuario($id,null);
	// print_r($ListaMesasUsuario);
	// Llamamos a la funcion que nos va a enlistar los lemas y sublemas para la tabla de valores ciudadanos con id 1
	$ListaLemaSublemas=ControladorElecciones::ctrListaLemaSublemas(2);
	// print_r($ListaLemaSublemas);

 ?>
<script type="text/javascript">
	function myFunction() {
	  // Declare variables 
	  var input, filter, table, tr, td, i, j, visible;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");

	  	// Loop through all table rows, and hide those who don't match the search query
	  	for (i = 0; i < tr.length; i++) {
		    visible = false;
		    /* Obtenemos todas las celdas de la fila, no sólo la primera */
		    td = tr[i].getElementsByTagName("td");
		    for (j = 0; j < td.length; j++) {
		      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
		        visible = true;
		      }
		    }
		    if (visible === true) {
		      tr[i].style.display = "";
		    } else {
		      tr[i].style.display = "none";
		    }
	 	}
	}
</script>

<div class="container mt-1">	
	<div class="table mb-5">
		
		<?php if ($usuario=='Administrador') { ?>
			<form class="form-floating">
			  <input type="text" class="form-control mt-2 mb-2" id="myInput" onkeyup="myFunction()">
			  <label for="floatingInputInvalid">Buscar Mesa</label>
			</form>
		<?php } ?>
		
		<table class="table text-center" id="myTable">
			<thead class="text-white text-center" style=" background: #31328c !important;">
				<tr>
					<th colspan="2">LISTA MESAS</th>
				</tr>
				<tr>
					<th>NÚMERO</th>
					<th>CARGAR</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach($ListaMesasUsuario as $Mesas){ ?>
					<tr>
						
							<td class="w-75 align-middle">
								<img src="https://cdn-icons-png.flaticon.com/512/5966/5966316.png" class="mr-2" width="15%">
								MESA <?php echo $Mesas[1]; ?>
							</td>
							<td class="w-25">
								<form action="Formulario1" method="POST" id="carga<?php echo $Mesas[1]; ?>">
									<input type="hidden" name="Mesa" value="<?php echo $Mesas[1]; ?>" >
							<?php 
							//Verifica si la mesa esta cargada si no lo esta habilita el formulario
							if($Mesas[3] != 1){?>		
								<button class="btn text-white" style=" background: #31328c !important;" type="button" onclick="pregunta(<?php echo $Mesas[1];?>)">
									<i class="fad fa-box-ballot"></i>
								</button>
								<?php }else{ 
									//Pregunta si la mesa esta verificada
									if ($Mesas[4] != 1){
									?>
										<button class="btn btn-outline-success" type="button" onclick="verificar()">
											<i class="fas fa-check"></i>
										</button> 
									<?php }else{ ?>
										<button class="btn btn-success" type="button" onclick="verificada()">
											<i class="fas fa-check-double"></i>
										</button>
									<?php } //end if ($Mesas[4] != 1)else PREGUNTA SI ESTA VERIFICADA O NO
								 } // end if($Mesas[3] != 1)else PREGUNTA SI ESTA CARGADA?>
								</form>
							</td>
						
					</tr>
				<?php $i ++; } ?>
			</tbody>
		</table>
	</div>
	<form action="./" method="POST">
		<button type="submit" class="btn btn-flotante btn-flotante-left mb-1 color" ><i class="fas fa-reply"></i> <b>Volver</b></button>
	</form>
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
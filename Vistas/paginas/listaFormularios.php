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
			  <input type="number" class="form-control mt-2 mb-2" id="myInput" onkeyup="myFunction()">
			  <label for="floatingInputInvalid">Buscar Mesa</label>
			</form>
		<?php } ?>
		
		<table class="table text-center" id="myTable">
			<thead class="bg-primary text-white text-center">
				<tr>
					<th colspan="3">LISTA FORMULARIO</th>
				</tr>
				<tr>
					<th>#</th>
					<th>NÚMERO</th>
					<th>VERIFICAR</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach($ListaMesasUsuario as $Mesas){ ?>
					<tr>
							<td class="w-25 align-middle">FORMULARIO <?php echo $i; ?></td>
							<td class="w-50 align-middle">
								<img src="https://cdn-icons-png.flaticon.com/512/5966/5966316.png" class="mr-1" width="10%">
								MESA <?php echo $Mesas[1]; ?>
							</td>
							<td class="w-25">
								<form action="FormularioV1" method="POST" id="carga<?php echo $Mesas[1]; ?>">
									<input type="hidden" name="Mesa" value="<?php echo $Mesas[1]; ?>" >
								
								
								
									<?php	if ($Mesas[4] != 1){ ?>
										<button class="btn btn-primary" type="button" onclick="preguntaV(<?php echo $Mesas[1];?>)">
											
											<i class="fas fa-box-open"></i>
										</button>
									<?php  }else{ ?>
										<button class="btn btn-success" type="button" onclick="verificada()">
											<i class="fad fa-box-check"></i>
										</button>
									 <?php } //end if ($Mesas[4] != 1)else PREGUNTA SI ESTA VERIFICADA O NO ?>
								</form>
							</td>
						
					</tr>
				<?php $i ++; } ?>
			</tbody>
		</table>
	</div>
	<form action="./" method="POST">
		<button type="submit" class="btn btn-flotante btn-flotante-left mb-1 text-primary" ><i class="fas fa-reply"></i> Volver</button>
	</form>
</div>
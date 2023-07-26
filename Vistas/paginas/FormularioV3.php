<?php
	if(!isset($_SESSION['validarIngreso'])){

	    echo '<script>window.location="login.php";</script>';
	    return;

	  }elseif($_SESSION['validarIngreso']!= "ok"){

	      echo '<script>window.location="login.php";</script>';
	      return;

	    }elseif(empty($_POST['Mesa'])){
       echo '<script>window.location="listaMesas";</script>';
        return;
    }
	// Llamamos a la funcion que nos va a enlistar las mesas y los datos que le corresponden a cada usuario
	$ListaMesasUsuario=ControladorElecciones::ctrListaMesasUsuario($id,NULL);
	// print_r($ListaMesasUsuario);
	// Llamamos a la funcion que nos va a enlistar los lemas y sublemas para la tabla de valores ciudadanos con id 1
	$ListaPartidos=ControladorElecciones::ctrListaPartidos();
	// print_r($ListaPartidos);
	$altaForm=ControladorElecciones::ctrAltaForm();
	if ($altaForm == 'OK'){ 
		echo '<script>
				alertify.success("Formulario de Frente de Todos Cargado");
			  </script>';
	}elseif($altaForm == 'OK_Actualizacion'){
		echo '<script>
				alertify.success("Formulario de Frente de Todos Actualizado");
			</script>';
	}elseif($altaForm == 'error'){
		echo '<script>
				alertify.error("Error al Cargar Formulario");
			  </script>';
	}
	$altaFormPartido=ControladorElecciones::ctrAltaFormPartidos();
	print_r($altaFormPartido);
 ?>
<div class="container mt-3">
	<div class="align-middle mt-1">
		<div class="text-center mb-1 w-100">
			<?php if ($usuario=='Administrador') { ?>
				<h6>Administrador <b class="color ml-3">MESA <?php echo $_POST['Mesa']; ?></b>  </b>ELECTORES: <b class="color ml-2"><?php echo $ListaMesasUsuario[0][5]; ?></b></h6>  
			<?php }else{ ?>
				<h6 class="d-flex justify-content-center"><?php echo $ListaMesasUsuario[0][0] ?><b class="color ml-2 mr-2"> MESA <?php echo $_POST['Mesa']; ?> </b>ELECTORES: <b class="color ml-2"><?php echo $ListaMesasUsuario[0][5]; ?></b></h6>  
			<?php } ?> 
		</div>
	</div>
	
		<div class="table mb-5">
			<table class="table text-center">
				<thead class="bg-primary text-white text-center">
					<tr>
						<th colspan="2">TOTALES POR PARTIDOS</th>
					</tr>
					<tr>
						<th>PARTIDO</th>
						<th>CONCEJALES</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; foreach($ListaPartidos as $Partido){ //print_r($Partido)?>
					<form action="Formulario3" method="POST" id="carga3">
						<tr>
							<td class="w-75 align-middle">TOTAL <?php echo $Partido[1] ?></td>
							<td class="w-25">
								<?php 	$ConsultaCarga=ControladorElecciones::ctrConsultaCargaPartidos($_POST['Mesa'],$Partido[0]);
										if (empty($ConsultaCarga)){  ?>
											<input type="number" name="valorPartidoCarga[]" onClick="this.select();" class="form-control form-control-sm cantidad" value=0 required autofocus>
								<?php }else{ ?>
											<input type="number" name="valorPartidoActualizar[]" onClick="this.select();" class="form-control form-control-sm cantidad" value="<?php echo $ConsultaCarga[0][3] ?>" required>
								<?php } ?>
									<input type="hidden" name="idPartido[]" value="<?php echo $Partido[0];?>">
							</td>
						</tr>
					<?php $i++; } ?>
						<button class="btn btn-white btn-flotante mb-1 text-primary" form="carga3" type="submit" id="seleccionar">
						    <i class="fad fa-thumbs-up"></i><br> Finalizar
						</button>
						<input type="hidden" name="cantidadReg" value="<?php echo $i;?>">
						<input type="hidden" name="Mesa" value="<?php echo $_POST['Mesa']; ?>">
					</form>
				</tbody>
			</table>
		</div>
	
	<form action="Formulario2" method="POST">
		<input type="hidden" name="Mesa" value="<?php echo $_POST['Mesa']; ?>">
		<button type="submit" class="btn btn-flotante btn-flotante-left mb-1 text-primary" ><i class="fas fa-reply"></i> Volver</button>
	</form>

</div>
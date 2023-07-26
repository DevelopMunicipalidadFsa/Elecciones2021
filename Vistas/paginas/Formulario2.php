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
	$ListaMesasUsuario=ControladorElecciones::ctrListaMesasUsuario($id,null);
	// print_r($ListaMesasUsuario);
	// Llamamos a la funcion que nos va a enlistar los lemas y sublemas para la tabla de Frente de Todos con id 1
	$ListaLemaSublemas=ControladorElecciones::ctrListaLemaSublemas(2);
	// print_r($ListaLemaSublemas);
	$altaForm=ControladorElecciones::ctrAltaForm();
	if ($altaForm == 'OK'){ 
		echo '<script>
				alertify.success("Formulario de Valores Cargado");
				
			  </script>';
	}elseif($altaForm == 'OK_Actualizacion'){
		echo '<script>
				alertify.success("Formulario de Valores Actualizado");
				
			  </script>';
	}elseif($altaForm == 'error'){
		echo '<script>
				alertify.error("Error al Cargar Formulario");
				
			  </script>';
	}
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
				<thead class="text-white text-center" style=" background: #31328c !important;">
					<tr>
						<th colspan="2"><?php echo $ListaLemaSublemas[0][1];?></th>
					</tr>
					<tr>
						<th>SUBLEMAS</th>
						<th>CONCEJALES</th>
					</tr>
					
				</thead>
				<tbody>
					
					<?php $i=0; foreach($ListaLemaSublemas as $Sublemas){ ?>
					<form action="Formulario3" method="POST" id="carga2">
						<tr>
							<td class="w-75 align-middle"><?php echo $Sublemas[3]; ?></td>
							<td class="w-25">
								<?php $ConsultaCarga=ControladorElecciones::ctrConsultaCarga($_POST['Mesa'],$Sublemas[2]);
										if (empty($ConsultaCarga)){  ?>
											<input type="number" name="valor[]" onClick="this.select();" class="form-control form-control-sm cantidad" required autofocus>
								<?php }else{ ?>
											<input type="number" name="valorActualizar[]" onClick="this.select();" class="form-control form-control-sm cantidad" value="<?php echo $ConsultaCarga[0][3] ?>" required>
								<?php } ?>
											<input type="hidden" name="idSublema[]" value="<?php echo $Sublemas[2];?>">
							</td>
						</tr>
					
					<?php $i ++; } ?>
						<tr class="text-white" style=" background: #31328c !important;">
							<td class="w-75 align-middle">TOTAL</td>
							<td class="w-25"><input type="number" name="totalFrenteTodos" id="total" value=0 class="form-control form-control-sm" readonly></td>
						</tr>
						<button class="btn btn-white btn-flotante mb-1 color" form="carga2" type="submit" id="seleccionar">
						    <i class="fas fa-share"></i><br> Continuar
						</button>
						<input type="hidden" name="cantidadReg" value="<?php echo $i;?>">
						<input type="hidden" name="Mesa" value="<?php echo $_POST['Mesa']; ?>">
					</form>
				</tbody>
			</table>
		</div><br>
	<form action="Formulario1" method="POST">
		<input type="hidden" name="idSublema" value="<?php echo $_POST['idSublema'];?>">
		<input type="hidden" name="Mesa" value="<?php echo $_POST['Mesa']; ?>">
		<button type="submit" class="btn btn-flotante btn-flotante-left mb-1 color" ><i class="fas fa-reply"></i> Volver</button>
	</form>
</div>
<script type="text/javascript">
	    $(document).on('keyup', '.cantidad', function(){
    	var resultado = 0;
    	
          // sumas todos los inputs
    	$(".cantidad").each(function() {      
    		resultado += parseInt($(this).val());
    	});
    	// pasas el resultado      
    	$("#total").val(resultado);	
      
    });
</script>
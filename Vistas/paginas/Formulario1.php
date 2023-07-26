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
	$ListaLemaSublemas=ControladorElecciones::ctrListaLemaSublemas(1);

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
						<th>SUBLEMA</th>
						<th>CONCEJALES</th>
					</tr>
					
				</thead>
				<tbody>
					<?php $i=0; foreach($ListaLemaSublemas as $Sublemas){ ?>	
					<form action="Formulario2" method="POST" name="formulario1">
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
							<td class="w-25"><input type="number" name="totalValores" id="total" class="form-control form-control-sm" readonly></td>
						</tr>
						<button class="btn btn-white btn-flotante mb-1 color"  type="submit" id="seleccionar" onclick="dimePropiedades(event)">
							<i class="fas fa-share"></i><br> Continuar
						</button>
						<input type="hidden" name="cantidadReg" value="<?php echo $i;?>">
						<input type="hidden" name="Mesa" value="<?php echo $_POST['Mesa']; ?>">
					</form>
				</tbody>
			</table>
		</div><br>
	
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
	function dimePropiedades(e){ 
	   	var texto
	   	var Seleccionar='Seleccionar'
	   	// texto = "El numero de opciones del select: " + document.formulario1.Mesa.length 
	   	var indice = document.formulario1.Mesa.selectedIndex 
	   	// texto += "nIndice de la opcion escogida: " + indice 
	   	// var valor = document.formulario1.Mesa.options[indice].value 
	   	// texto += "nValor de la opcion escogida: " + valor 
	   	var textoEscogido = document.formulario1.Mesa.options[indice].text 
	   	// texto += "nTexto de la opcion escogida: " + textoEscogido 
	   	if (indice <= 0) {
	   		alertify.error("Debe seleccionar una Mesa");
	   		e.preventDefault() ;
            returnToPreviousPage();
	   	}
	   	// alert(indice)
    }
</script>
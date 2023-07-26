<?php 
	include_once('../../Controladores/AutomotoresControladores.php');
	include_once('../../Modelos/AutomotoresModelo.php');
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
<div class="table">
	<form class="form-floating">
		<input type="text" class="form-control" id="myInput" onkeyup="myFunction()">
		<label for="floatingInputInvalid">Buscar Usuario</label>
	</form>
	<table class="table table-responsive text-center mt-3" id="myTable">
		<thead class="text-white text-center" style=" background: #31328c !important;">
			<tr>
				<th colspan="4">LISTA USUARIOS</th>
			</tr>
			<tr>
				<th>ID</th>
				<th>NOMBRES</th>
				<th>CONTRASEÑAS</th>
				<th>ACCIÓN</th>
			</tr>
		</thead>
		<tbody>
			<?php $ListaUsuarios=ControladorElecciones::ctrListaUsuarios(); 
			// print_r($ListaUsuarios); ?>
			<?php foreach($ListaUsuarios as $Usuario){ 
				$i=1;
				$agregar=$Usuario[0]."||".
				$Usuario[6];
				$Actualizar=$Usuario[0]."||".
				$Usuario[6]."||".
				$Usuario[7];
			?>
			<tr>
				<td><?php echo $Usuario[0]; ?></td>
				<td><?php echo $Usuario[6]; ?></td>
				<td>
					<?php if($Usuario[7] == NULL){ ?>
					<input type="text" name="agregar<?php echo $i;?>" onClick="this.select();" class="form-control form-control-sm cantidad" readonly>
				
					<?php }else{ ?>
					<input type="text" name="actualizar" class="form-control form-control-sm cantidad" value="<?php echo $Usuario[7]; ?>" readonly>
					<?php } ?>
				</td>
				<td>
					<?php if($Usuario[7] == NULL){ ?>
					<button type="submit"  class="btn btn-success" onclick="agregaform('<?php echo $agregar ?>')" data-toggle="modal" data-target="#modalNuevo"><i class="far fa-key-skeleton"></i></button>
					<?php }else{ ?>
					<button type="submit"  class="btn btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="actualizaform('<?php echo $Actualizar ?>')"><i class="far fa-pencil"></i></button>
					<?php } ?>
				</td>
			</tr>

				<?php $i++; } ?>
				<!-- <button class="btn btn-white btn-flotante mb-1 text-primary" form="carga" type="submit" id="seleccionar">
					<i class="fas fa-share"></i><br> Continuar
				</button> -->
		</tbody>
	</table>
</div>

	    <script>
	    function agregaform(agregar){

			d=agregar.split('||');

			$('#nroUsu').val(d[0]);
			$('#nomUsu').val(d[1]);
			
		}
		function actualizaform(actualizar){

			c=actualizar.split('||');

			$('#nroUsuActu').val(c[0]);
			$('#nomUsuActu').val(c[1]);
			$('#passUsuActu').val(c[2]);
			
		}
		
        $('#guardarnuevo').click(function(){
          nroUsu=$('#nroUsu').val();
          passUsu=$('#passUsu').val();
            agregardatos(nroUsu,passUsu);
        });
        $('#actualizadatos').click(function(){
          nroUsu=$('#nroUsuActu').val();
          passUsu=$('#passUsuActu').val();
            agregardatos(nroUsu,passUsu);
        });

    function agregardatos(nroUsu,passUsu){

				cadena="nroUsuAgre=" + nroUsu + 
						"&passUsuAgre=" + passUsu;
				console.log(cadena);
				
				$.ajax({
					type:"POST",
					url:"vistas/paginas/altaUsuario.php",
					data:cadena,
					success:function(r){
						if(r== 1){
							window.location.reload();
							alertify.success("agregado con exito :)");

						}else{
							alertify.error("Fallo el servidor :(");
						}
					}
				});
		}
</script>
<!-- Modal para registros nuevos -->


<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Asignar Contraseña</h4>
      </div>
      <div class="modal-body">
        	<label>Usuario</label>
        	<input type="text" name="" id="nroUsu" class="form-control input-sm" readonly>
        	<label>Nombre</label>
        	<input type="text" name="" id="nomUsu" class="form-control input-sm" readonly>
        	<label>Contraseña</label>
        	<input type="text" name="" id="passUsu" class="form-control input-sm">
      </div>
      <div class="modal-footer d-flex justify-content-center">
      	<button type="button" class="btn btn-danger float-left" data-dismiss="modal" aria-label="Close">Cerrar</button>
        <button type="button" class="btn btn-primary float-right" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>
<!-- Modal para edicion de datos -->

<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
      </div>
      <div class="modal-body">
      		<label>Usuario</label>
        	<input type="text" name="" id="nroUsuActu" class="form-control input-sm" readonly>
        	<label>Nombre</label>
        	<input type="text" name="" id="nomUsuActu" class="form-control input-sm" readonly>
        	<label>Contraseña</label>
        	<input type="text" name="" id="passUsuActu" class="form-control input-sm">
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger float-left" data-dismiss="modal" aria-label="Close">Cerrar</button>
        <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
        
      </div>
    </div>
  </div>
</div>

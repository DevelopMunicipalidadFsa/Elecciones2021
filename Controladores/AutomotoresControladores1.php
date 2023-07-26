<?php 
/* pasa el parametro $idContribuyente al MODELO AutomotoresModelos::mdlConsultaContribu() */
// session_start();
class AutomotoresControlador {

	 /*=============================================
	 =            OBTENER OBJETOS          =
	 =============================================*/
	 
	
	public function ctrObtenerObjetos($IdRubro,$idContribuyente){

		/* pasa los parametros $IdRubro, $idContribuyente al MODELO AutomotoresModelos::mdlObtenerObjetos() */
		
		$rta=AutomotoresModelos::mdlObtenerObjetos($IdRubro,$idContribuyente);

		return $rta;
	}

	/*=============================================
	 =            OBTENER fecha          =
	 =============================================*/
	 
	
	public function ctrFecha(){

		/* pasa los parametros $IdRubro, $idContribuyente al MODELO AutomotoresModelos::mdlObtenerObjetos() */
		
		$rta=AutomotoresModelos::mdlFecha();
		$fecha=$rta[0][0];
		$FechaFormateada=date('m/d/Y',strtotime($fecha));

		return $FechaFormateada;
	}
		/*=============================================
	 =            OBTENER fecha   deuda       =
	 =============================================*/
	 
	
	public function ctrFechaDeuda(){

		/* pasa los parametros $IdRubro, $idContribuyente al MODELO AutomotoresModelos::mdlObtenerObjetos() */
		
		$rta=AutomotoresModelos::mdlFecha();

		return $rta;
	}
	/*=============================================
	 =            OBTENER fecha  larga        =
	 =============================================*/
	 
	
	public function ctrFechaLarga($fecha){

		/* pasa los parametros $IdRubro, $idContribuyente al MODELO AutomotoresModelos::mdlObtenerObjetos() */
		
		$rta=AutomotoresModelos::mdlFechaLarga($fecha);

		return $rta;
	}


	/*====================================
	=  VER MULTA TRIBUNAL DE FALTAS      =
	====================================*/
	
	public function ctrMultaContribuTF(){

		if (isset($_POST['CodObjeto'])) {
			$CodObjeto=$_POST['CodObjeto'];
			// $CodObjeto='KZN846';
			$rta=AutomotoresModelos::mdlMultaContribuTF("$CodObjeto");
			return $rta;
		}
	}
	/*====================================
	=            VER LA DEUDA            =
	====================================*/
	
	public function ctrDeudaContribu(){

		if (isset($_POST['Identidad'])) {
			$Identidad=$_POST['Identidad'];
			$IdRubro=$_POST['IdRubro'];
			$Fecha=$_POST['fecha'];
			$rta=AutomotoresModelos::mdlDeudaContribu($Identidad,$IdRubro,$Fecha);
			return $rta;
		}
	}
	/*====================================
	=     VER PERIODO DE  LA DEUDA      =
	====================================*/
	
	public function ctrDeudaPeriodo($Identidad,$IdRubro,$Fecha){

			$rta=AutomotoresModelos::mdlDeudaPeriodo($Identidad,$IdRubro,$Fecha);
			return $rta;	

	}
	/*====================================
	= Datos del objeto contribuyente    =
	====================================*/
	
	public function ctrObjetoContibu(){

		if (isset($_POST['Identidad'])) {
			$Identidad=$_POST['Identidad'];
			$IdRubro=$_POST['IdRubro'];
			$idContribuyente=$_POST['idContribuyente'];

			$rta=AutomotoresModelos::mdlObjetoContibu($Identidad,$IdRubro,$idContribuyente);
			
			return $rta;
		}
	}
	/*======================================
	= Datos del tramites de contribuyentes =
	========================================*/
	
	public function ctrListaTramitesContibu($IdRubro,$idContribuyente,$valor){

			$rta=AutomotoresModelos::mdlListaTramitesContibu($IdRubro,$idContribuyente,$valor);
			
			return $rta;
	}
	/*=====================================
	=  Actualizar Datos del contribuyente =
	====================================*/
	
	public function ctrConsutlaUpdateContibuDatos($idContribuyente){

		$idContribuyente=$_POST['idContribuyente'];
		 
		/*se llama al modelo para traer datos de ultima actualizacion de telefono y correo del contribuyente*/
		$rta=AutomotoresModelos::mdlConsultaUpdateContibuDatos($idContribuyente);
		/* Se llama al modelo para traer la fecha actual del servidor*/
		$fecha=AutomotoresModelos::mdlFecha();

		if(empty($rta)){
			return "Actualizar";
		}else{

			//defino fecha de actualizacion de los datos
			$ano1 = date('Y',strtotime($rta[4]));
			$mes1 = date('m',strtotime($rta[4]));
			$dia1 = date('d',strtotime($rta[4]));

			//defino fecha actual
			$ano2 = date('Y',strtotime($fecha[0][0]));
			$mes2 = date('m',strtotime($fecha[0][0]));
			$dia2 = date('d',strtotime($fecha[0][0]));

			//calculo timestam de las dos fechas
			$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
			$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);

			//resto a una fecha la otra
			$segundos_diferencia = $timestamp1 - $timestamp2;
			// echo $segundos_diferencia;

			//convierto segundos en días
			$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

			//obtengo el valor absoulto de los días (quito el posible signo negativo)
			$dias_diferencia = abs($dias_diferencia);

			//quito los decimales a los días de diferencia
			$dias_diferencia = floor($dias_diferencia);

			// pregunta si la diferencia de las fechas es mayor al año y devuelve el resultado
			if ($dias_diferencia >= 365){
				return "Actualizar";
			}else{
				return "Acualizado";
			}
		}
			
	}
	/*=====================================
	=  Actualizar Datos del contribuyente =
	====================================*/
	
	public function ctrUpdateContibuDatos(){

	
		if (isset($_POST['telefono'])) {

			$telefono=$_POST['telefono'];
			$email=$_POST['email'];
			$idContribuyente=$_POST['idContribuyente'];

			$rta=AutomotoresModelos::mdlUpdateContibuDatos("$telefono","$email",$idContribuyente);
			
			return $rta;
		}
	}
	/*====================================
	=      Datos del contribuyente       =
	====================================*/
	
	public function ctrContibuDatos(){

		if (isset($_POST['idContribuyente'])) {

			$idContribuyente=$_POST['idContribuyente'];

			$rta=AutomotoresModelos::mdlContibuDatos($idContribuyente);
			
			return $rta;
		}
	}
	/*====================================
	=  LISTA DE TRAMITES  y detalles     =
	====================================*/
	
	public function ctrTramitesLista($variable){

			$IdRubro=$variable;
			$rta=AutomotoresModelos::mdlTramitesLista($IdRubro);
			return $rta;
	}
	/*===================================================*/
	public function ctrTramitesListaDetalle($IdTramite){

			$rta=AutomotoresModelos::mdlTramitesListaDetalles($IdTramite);
			return $rta;
	}
	/*====================================
	=   Nombre del tramite a Realizar    =
	====================================*/
	
	public function ctrTramitesNombre($idTramites){
	
			$rta=AutomotoresModelos::mdlTramiteNombre($idTramites);
			return $rta;

	}
	/*=======================================
	= REIMPRIMIR SOLICITUD DE TRAMITE =
	=======================================*/
	
	public function ctrTramitesSolicitudReimprimir($idTramites,$idSolicitud){

		$rta=AutomotoresModelos::mdlTramitesSolicitudReimprimir($idTramites,$idSolicitud);
		return $rta;
		
	}
	/*======================================
	= Datos Usuario Solicitud =
	========================================*/
	
	public function ctrUsuarioSolicitud($idSolicitud,$estadoTramite){

			$rta=AutomotoresModelos::mdlUsuarioSolicitud($idSolicitud,$estadoTramite);
			
			return $rta;
			
	}
	/*====================================
	=      Tipo de Tramites de  baja    =
	====================================*/
	
	public function ctrTipoBaja(){
		
			$rta=AutomotoresModelos::mdlTipoBaja();
			return $rta;
	}
	/*====================================
	= Tipo de Tramites de  baja seleccionado para la solicitud   =
	====================================*/
	
	public function ctrTipoBajaSolicitud($IdTipoBaja){
			$IdTipoBaja2=base64_decode($IdTipoBaja);
			$rta=AutomotoresModelos::mdlTipoBajaSolicitud($IdTipoBaja2);
			return $rta;
	}
	/*=======================================
	= REQUISITOS TRAMITES POR CONTRIBUYENTE =
	=======================================*/
	
	public function ctrRequisitosTramitesContribuyentes($idTramites,$IdTipoBaja){

		
			$Identidad=$_POST['Identidad'];
			$IdRubro=$_POST['IdRubro'];
			$idContribuyente=$_POST['idContribuyente'];
			$rta=AutomotoresModelos:: mdlRequisitosTramitesContribuyentes($idTramites,$IdTipoBaja,$IdRubro,$idContribuyente,$Identidad);
			return $rta;
		
	}
	/*=======================================
	= REQUISITOS TRAMITES POR CONTRIBUYENTE =
	=======================================*/
	
	public function ctrRequisitosLista($idTramites){

		$rta=AutomotoresModelos:: mdlRequisitosLista($idTramites);
		return $rta;
		
	}
	/*=======================================
	= REQUISITOS TRAMITES POR CONTRIBUYENTE =
	=======================================*/
	
	// public function ctrquitarImagen(){

	// 	if (isset($_POST['img'])){
	// 		$img=$_POST['img'];
	// 		unlink($img);
	// 		return $img;
	// 	}
		
		
	// }
	/*====================================
	=     Dar de alta Imagenes        =
	====================================*/
	
	public function ctrAltaImg(){
			
			
		if (isset($_POST['titulo'])) {
			 $titulo=$_POST['titulo'];
			 $idTramites=$_POST['idTramites'];
			 $Identidad=$_POST['Identidad'];
			 $IdRubro=$_POST['IdRubro'];
			 $idContribuyente=$_POST['idContribuyente'];
			 $idRequisitosTramites=$_POST['idRequisitosTramites2'];
			 $fecha = $_POST['fecha'];
			 $img = $_FILES['archivo'];
			 $imagenNombre = $_FILES['archivo']['name'];
			 $extension = $_FILES['archivo']['type'];
			 $CodObjeto = $_POST['CodObjeto'];
			 $fecha = $_POST['fecha'];
			 if (isset($_POST['idSolicitud'])){
			 	$idSolicitud = $_POST['idSolicitud'];
				}

			//verificamos si hay un requisito cargado anteriormente
			$rta=AutomotoresModelos::mdlConsultaRequisitosDig($idContribuyente,$idRequisitosTramites);

			// si el resultado de la respuesta es == 'Dar Alta' es porque no hay requisito cargado para ese contribuyente por lo que se procede a cargar la imagen
			if (empty($rta)) {

			 	 file_put_contents("$imagenNombre", "$imagenNombre");
				 $hashFile = hash_file('md5', "$imagenNombre");
			
				$imgBase64=AutomotoresModelos::mdlRedimensionarImg($_FILES['archivo']);

				$rta=AutomotoresModelos::mdlAltaImg($idContribuyente,$idRequisitosTramites,"$titulo",$Identidad,"$imagenNombre","$extension","$hashFile","$imgBase64",NULL,NULL);
				// print_r($rta);
				if ($rta=='OK') { 
					//Se elimina el archivo del fichero temporal creado
					unlink("imgTemp/".$_FILES['archivo']['name']);
					?>

						<form method="POST" action="gestionTramites" name="formulario1">
							<?php if(isset($_POST['idTipoBaja'])){
								$idTipoBaja = $_POST['idTipoBaja'];?>
								<input type="hidden" id="idTipoBaja" name="idTipoBaja" value="<?php echo $_POST['idTipoBaja']; ?>">
							<?php } ?>	
							<input type="hidden" name="idContribuyente" value="<?php echo $idContribuyente; ?>" required/>
							<input type="hidden" name="idTramites" value="<?php echo $idTramites; ?>" required/>
							<input type="hidden" name="Identidad" value="<?php echo $Identidad; ?>" required/>
							<input type="hidden" name="IdRubro" value="<?php echo $IdRubro; ?>" required/>
							<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" required/>
							<input type="hidden" name="CodObjeto" value="<?php echo $CodObjeto; ?>" required/>
							
						</form>
						<?php  
							
						echo "<script>	
								jQuery(function(){
									Swal.fire({
										icon: 'success',
										title: '¡Muy bien!',
										text: 'El documento se digitalizó correctamente',
										showConfirmButton: true
										}).then((result) => {
											document.formulario1.submit();
									})
								});
						   </script>";
				} else {
					echo "<script>	
								jQuery(function(){
									Swal.fire({
										icon: 'error',
										title: '¡Algo no anda bien!',
										text: 'No se pudo digitalizar el documento',
										showConfirmButton: true
										}).then((result) => {
											document.formulario1.submit();
									})
								});
						   </script>";
				}
			// En el caso de que esto devuelva un valor distinto al de Dar Alta se mustra en este caso seria el nombre del requisito que quiere dar de alta
			 } elseif(isset($rta)){ 
			 	?>

				<script>
					var resp =  '<?php echo $rta[0][3];?>';	
					jQuery(function(){
						Swal.fire({
							icon: 'warning',
							title: '¡Atención!',
							text: 'El requisito '+ resp + ' ya se encuentra digitalizado! Desde el <?php echo date('d-m-Y',strtotime($rta[0][8]));?>',
							showConfirmButton: true
							})
					});
			   </script>
				<?php }
		}else if(isset($_POST['FotocopiaTítuloAutomotor']) != null || isset($_POST['FotocopiaDNIFrente']) != null || isset($_POST['FotocopiaDNIDorso']) != null || isset($_POST['Formulario04RegAut']) != null){

				 	$idTramites=$_POST['idTramites'];
				 	$Identidad=$_POST['Identidad'];
				  	$IdRubro=$_POST['IdRubro'];
				  	$idContribuyente=$_POST['idContribuyente'];
				  	$fecha = $_POST['fecha'];
				 	$CodObjeto = $_POST['CodObjeto'];
				 	$idSolicitud = $_POST['idSolicitud'];
				
				if($_FILES['Fotocopia_del_Título_del_Automotor']['size'] != 0 && $_POST['FotocopiaTítuloAutomotor'] != null && isset($_POST['titulo1'])){
					 
					 	
						 $titulo=$_POST['titulo1'];
					 	 $idRequisitosTramites = $_POST['FotocopiaTítuloAutomotor'];
					 	
					 	//verificamos si hay un requisito cargado anteriormente
						$rta=AutomotoresModelos::mdlConsultaRequisitosDig($idContribuyente,$idRequisitosTramites);

						if (empty($rta)) {
								$imagenNombre = $_FILES['Fotocopia_del_Título_del_Automotor']['name'];
			 					$extension = $_FILES['Fotocopia_del_Título_del_Automotor']['type'];

							 	file_put_contents("$imagenNombre", "$imagenNombre");

								$hashFile = hash_file('md5', "$imagenNombre");
								echo $imgBase64 = base64_encode(file_get_contents($_FILES['Fotocopia_del_Título_del_Automotor']['tmp_name']));
				
								$rta=AutomotoresModelos::mdlAltaImg($idContribuyente,$idRequisitosTramites,"$titulo",$Identidad,"$imagenNombre","$extension","$hashFile","$imgBase64","Devolucion", $idSolicitud);
								if ($rta=='OK') { ?>
									<form method="POST" action="listaTramites" name="formulario2">
										<?php if(isset($_POST['idTipoBaja'])){
											$idTipoBaja = $_POST['idTipoBaja'];?>
											<input type="hidden" name="idTipoBaja" value="<?php echo $_POST['idTipoBaja']; ?>">
										<?php } ?>	
										<input type="hidden" name="idContribuyente" value="<?php echo $idContribuyente; ?>" required/>
										<input type="hidden" name="idTramites" value="<?php echo $idTramites; ?>" required/>
										<input type="hidden" name="Identidad" value="<?php echo $Identidad; ?>" required/>
										<input type="hidden" name="IdRubro" value="<?php echo $IdRubro; ?>" required/>
										<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" required/>
										<input type="hidden" name="CodObjeto" value="<?php echo $CodObjeto; ?>" required/>
									</form>
									<?php  
										
									echo "<script>	
											jQuery(function(){
												Swal.fire({
													icon: 'success',
													title: '¡Muy bien!',
													text: 'El documento se digitalizó correctamente el Titulo del Automotor',
													showConfirmButton: true
													}).then((result) => {
														document.formulario2.submit();
												})
											});
									   </script>";
								} else {
									echo "<script>	
												jQuery(function(){
													Swal.fire({
														icon: 'error',
														title: '¡Algo no anda bien!',
														text: 'No se pudo digitalizar el Titulo del Automotor',
														showConfirmButton: true
													})
												});
										   </script>";
								}
								
							// En el caso de que esto devuelva un valor distinto al de Dar Alta se mustra en este caso seria el nombre del requisito que quiere dar de alta
							 } else{ ?>
								<script>
									var resp =  '<?php echo $rta[0][3];?>';	
									jQuery(function(){
										Swal.fire({
											icon: 'warning',
											title: '¡Atención!',
											text: 'El requisito '+ resp + ' se encuentra digitalizado! Desde el <?php echo date('d-m-Y',strtotime($rta[0][8]));?>',
											showConfirmButton: true
											})
									});
							   </script>
								<?php }

				}
				if($_FILES['Fotocopia_del_DNI_Frente']['size'] != 0 && $_POST['FotocopiaDNIFrente'] != null && isset($_POST['titulo2'])){

						$idRequisitosTramites = $_POST['FotocopiaDNIFrente'];
						$titulo=$_POST['titulo2'];

					 	//verificamos si hay un requisito cargado anteriormente
						$rta=AutomotoresModelos::mdlConsultaRequisitosDig($idContribuyente,$idRequisitosTramites);

						if (empty($rta)) {

								$imagenNombre = $_FILES['Fotocopia_del_DNI_Frente']['name'];
			 					$extension = $_FILES['Fotocopia_del_DNI_Frente']['type'];

							 	file_put_contents("$imagenNombre", "$imagenNombre");

								$hashFile = hash_file('md5', "$imagenNombre");
								$imgBase64 = base64_encode(file_get_contents($_FILES['Fotocopia_del_DNI_Frente']['tmp_name']));

								$rta=AutomotoresModelos::mdlAltaImg($idContribuyente,$idRequisitosTramites,"$titulo",$Identidad,"$imagenNombre","$extension","$hashFile","$imgBase64","Devolucion", $idSolicitud);
									if ($rta=='OK') { ?>
									<form method="POST" action="listaTramites" name="formulario3">
										<?php if(isset($_POST['idTipoBaja'])){
											$idTipoBaja = $_POST['idTipoBaja'];?>
											<input type="hidden" name="idTipoBaja" value="<?php echo $_POST['idTipoBaja']; ?>">
										<?php } ?>	
										<input type="hidden" name="idContribuyente" value="<?php echo $idContribuyente; ?>" required/>
										<input type="hidden" name="idTramites" value="<?php echo $idTramites; ?>" required/>
										<input type="hidden" name="Identidad" value="<?php echo $Identidad; ?>" required/>
										<input type="hidden" name="IdRubro" value="<?php echo $IdRubro; ?>" required/>
										<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" required/>
										<input type="hidden" name="CodObjeto" value="<?php echo $CodObjeto; ?>" required/>
									</form>
									<?php  
										
									echo "<script>	
											jQuery(function(){
												Swal.fire({
													icon: 'success',
													title: '¡Muy bien!',
													text: 'El documento se digitalizó correctamente el DNI Frente',
													showConfirmButton: true
													}).then((result) => {
														document.formulario3.submit();
												})
											});
									   </script>";
								} else {
									echo "<script>	
												jQuery(function(){
													Swal.fire({
														icon: 'error',
														title: '¡Algo no anda bien!',
														text: 'No se pudo digitalizar el DNI Frente',
														showConfirmButton: true
													})
												});
										   </script>";
								}
								
							// En el caso de que esto devuelva un valor distinto al de Dar Alta se mustra en este caso seria el nombre del requisito que quiere dar de alta
							 } else{ 

							 ?><script>
									var resp =  '<?php echo $rta[0][3];?>';	
									jQuery(function(){
										Swal.fire({
											icon: 'warning',
											title: '¡Atención!',
											text: 'El requisito '+ resp + ' se encuentra digitalizado! Desde el <?php echo date('d-m-Y',strtotime($rta[0][8]));?>',
											showConfirmButton: true
											})
									});
							   </script><?php
							}

				}
				if($_FILES['Fotocopia_del_DNI_Dorso']['size'] != 0 && $_POST['FotocopiaDNIDorso'] != null && isset($_POST['titulo3'])){

						$idRequisitosTramites = $_POST['FotocopiaDNIDorso'];
						$titulo=$_POST['titulo3'];

					 	//verificamos si hay un requisito cargado anteriormente
						$rta=AutomotoresModelos::mdlConsultaRequisitosDig($idContribuyente,$idRequisitosTramites);

						if (empty($rta)) {
					  		$imagenNombre = $_FILES['Fotocopia_del_DNI_Dorso']['name'];
			 				$extension = $_FILES['Fotocopia_del_DNI_Dorso']['type'];
							file_put_contents("$imagenNombre", "$imagenNombre");

							$hashFile = hash_file('md5', "$imagenNombre");
							$imgBase64 = base64_encode(file_get_contents($_FILES['Fotocopia_del_DNI_Dorso']['tmp_name']));

							$rta=AutomotoresModelos::mdlAltaImg($idContribuyente,$idRequisitosTramites,"$titulo",$Identidad,"$imagenNombre","$extension","$hashFile","$imgBase64","Devolucion", $idSolicitud);
								
								if ($rta=='OK') { ?>
									<form method="POST" action="listaTramites" name="formulario4">
										<?php if(isset($_POST['idTipoBaja'])){
											$idTipoBaja = $_POST['idTipoBaja'];?>
											<input type="hidden" name="idTipoBaja" value="<?php echo $_POST['idTipoBaja']; ?>">
										<?php } ?>	
										<input type="hidden" name="idContribuyente" value="<?php echo $idContribuyente; ?>" required/>
										<input type="hidden" name="idTramites" value="<?php echo $idTramites; ?>" required/>
										<input type="hidden" name="Identidad" value="<?php echo $Identidad; ?>" required/>
										<input type="hidden" name="IdRubro" value="<?php echo $IdRubro; ?>" required/>
										<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" required/>
										<input type="hidden" name="CodObjeto" value="<?php echo $CodObjeto; ?>" required/>
									</form>
									<?php  
										
									echo "<script>	
											jQuery(function(){
												Swal.fire({
													icon: 'success',
													title: '¡Muy bien!',
													text: 'El documento se digitalizó correctamente el DNI Dorso',
													showConfirmButton: true
													}).then((result) => {
														document.formulario4.submit();
												})
											});
									   </script>";
								} else {
									echo "<script>	
												jQuery(function(){
													Swal.fire({
														icon: 'error',
														title: '¡Algo no anda bien!',
														text: 'No se pudo digitalizar el DNI Dorso',
														showConfirmButton: true
													})
												});
										   </script>";
								}

						// En el caso de que esto devuelva un valor distinto al de Dar Alta se mustra en este caso seria el nombre del requisito que quiere dar de alta
							 } else{ 
							 //	return $rta;
						 	 	?>
								<script>
									var resp =  '<?php echo $rta[0][3];?>';	
									jQuery(function(){
										Swal.fire({
											icon: 'warning',
											title: '¡Atención!',
											text: 'El requisito '+ resp + ' se encuentra digitalizado! Desde el <?php echo date('d-m-Y',strtotime($rta[0][8]));?>',
											showConfirmButton: true
											})
									});
							   </script><?php 
							}

				}
				if($_FILES['Formulario_04_emitido_por_el_Registro_del_Automotor']['size'] != 0 && $_POST['Formulario04RegAut'] != null && isset($_POST['titulo4'])){

						$titulo=$_POST['titulo4'];
						$idRequisitosTramites = $_POST['Formulario04RegAut'];
						
					 	//verificamos si hay un requisito cargado anteriormente
						$rta=AutomotoresModelos::mdlConsultaRequisitosDig($idContribuyente,$idRequisitosTramites);

						if (empty($rta)) {
							$imagenNombre = $_FILES['Formulario_04_emitido_por_el_Registro_del_Automotor']['name'];
			 				$extension = $_FILES['Formulario_04_emitido_por_el_Registro_del_Automotor']['type'];
							
							file_put_contents("$imagenNombre", "$imagenNombre");

							$hashFile = hash_file('md5', "$imagenNombre");
							$imgBase64 = base64_encode(file_get_contents($_FILES['Formulario_04_emitido_por_el_Registro_del_Automotor']['tmp_name']));

							$rta=AutomotoresModelos::mdlAltaImg($idContribuyente,$idRequisitosTramites,"$titulo",$Identidad,"$imagenNombre","$extension","$hashFile","$imgBase64","Devolucion", $idSolicitud);
								
								if ($rta=='OK') { ?>
									<form method="POST" action="listaTramites" name="formulario5">
										<?php if(isset($_POST['idTipoBaja'])){
											$idTipoBaja = $_POST['idTipoBaja'];?>
											<input type="hidden" name="idTipoBaja" value="<?php echo $_POST['idTipoBaja']; ?>">
										<?php } ?>	
										<input type="hidden" name="idContribuyente" value="<?php echo $idContribuyente; ?>" required/>
										<input type="hidden" name="idTramites" value="<?php echo $idTramites; ?>" required/>
										<input type="hidden" name="Identidad" value="<?php echo $Identidad; ?>" required/>
										<input type="hidden" name="IdRubro" value="<?php echo $IdRubro; ?>" required/>
										<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" required/>
										<input type="hidden" name="CodObjeto" value="<?php echo $CodObjeto; ?>" required/>
									</form>
									<?php  
										
									echo "<script>	
											jQuery(function(){
												Swal.fire({
													icon: 'success',
													title: '¡Muy bien!',
													text: 'El documento se digitalizó correctamente el Formulario 04 emitido por el Registro del Automotor',
													showConfirmButton: true
													}).then((result) => {
														document.formulario5.submit();
												})
											});
									   </script>";
								} else {
									echo "<script>	
												jQuery(function(){
													Swal.fire({
														icon: 'error',
														title: '¡Algo no anda bien!',
														text: 'No se pudo digitalizar el Formulario 04 emitido por el Registro del Automotor',
														showConfirmButton: true
													})
												});
										   </script>";
								}	
								// En el caso de que esto devuelva un valor distinto al de Dar Alta se mustra en este caso seria el nombre del requisito que quiere dar de alta
							} else{ 
							 	// return $rta;
							 	?>
								<script>
									var resp =  '<?php echo $rta[0][3];?>';	
									jQuery(function(){
										Swal.fire({
											icon: 'warning',
											title: '¡Atención!',
											text: 'El requisito '+ resp + ' se encuentra digitalizado! Desde el <?php echo date('d-m-Y',strtotime($rta[0][8]));?>',
											showConfirmButton: true
											})
									});
							   </script><?php 
							}
				}

 		}
	}
	/*====================================
	=     Dar de baja Imagenes        =
	====================================*/
	
	public function ctrBajaImg(){
		if (isset($_POST['idDD'])) {
		
			if(isset($_POST['idTipoBaja'])){
				$idTipoBaja = $_POST['idTipoBaja'];
			}

			$idDD = $_POST['idDD'];
			$Identidad = $_POST['Identidad'];
			$CodObjeto = $_POST['CodObjeto'];
			$IdRubro = $_POST['IdRubro'];
			$fecha = $_POST['fecha'];
			$idContribuyente = $_POST['idContribuyente'];
			$idTramites = $_POST['idTramites'];

			$rta=AutomotoresModelos::mdlBajaImg($idDD);

			if ($rta=='OK') {
				echo "<script>
				Swal.fire({
					icon: 'success',
					title: '¡Se eliminó correctamente!',
					text: '',
					showConfirmButton: true, 
					confirmButtonText: 'Ok'
					})
					</script>";
			} else{
				echo "<script>	
						jQuery(function(){
							Swal.fire({
								icon: 'error',
								title: '¡Algo no anda bien!',
								text: 'No se pudo eliminar el documento',
								showConfirmButton: true
								}).then((result) => {
								/* Read more about isConfirmed, isDenied below */
								window.location.href = window.location.href;
							})
						});
					</script>";
			}
		}

	}
	/*====================================
	=   Nombre del tramite a Realizar    =
	====================================*/
	
	public function ctrTramitesImporte(){

			$rta=AutomotoresModelos::mdlTramitesImporte();

			return $rta;
	}
		/*====================================
	=      REQUISITOS TRAMITES          =
	====================================*/
	
	public function ctrConfirmacionSolicitud(){

		if (isset($_POST['idTramitesSol'])) {

			$idTramites=$_POST['idTramitesSol'];
			//Si tramite es igual a 1 es libre de deuda
			$ConsultaExisteTramitesPendientes=AutomotoresModelos::mdlConsultaExisteTramitesPendientes($_POST['idContribuyente'],$_POST['Dominio'],$_POST['idTramitesSol']);
			
			// ECHO $_POST['idContribuyente'];
			// ECHO $_POST['Dominio'];
			// ECHO $_POST['idTramitesSol'];
		 // 	print_r($ConsultaExisteTramitesPendientes);
		   if($ConsultaExisteTramitesPendientes <> NULL){ 
		    $EstadoTramite = $ConsultaExisteTramitesPendientes[0][13];
		   	$Tramite= $ConsultaExisteTramitesPendientes[0][15];
		   	$FechaInicio = date('d-m-Y',strtotime($ConsultaExisteTramitesPendientes[0][12]));
		   	$SolicitudNro = $ConsultaExisteTramitesPendientes[0][7];
		   	$Objeto = $ConsultaExisteTramitesPendientes[0][4];
		    $i="fa fa-thumbs-up";
		    $h1="alert-heading text-center text-danger  alert";?>
			<script type='text/javascript'>
			   	var resp =  '<?php echo $Tramite;?>';
			   	var est =  '<?php echo $EstadoTramite;?>';
			   	var feI =  '<?php echo $FechaInicio;?>';
			   	var nro =  '<?php echo $SolicitudNro;?>';
			   	var obj =  '<?php echo $Objeto;?>';

				Swal.fire({
				    title: '<h1 class="alert-heading text-center text-danger  alert">¡Atención!</h1>',
				    icon: 'warning',
				    html:
				  		'<h3 class="alert-heading text-center mb-0">Tiene una '+ resp + "</h3>"+
				  		'<h5 class="alert-heading text-center text-warning  alert">'+ est + "</h5>"+
						'<ul class="text-justify border-0 m-2  alerta list-unstyled">'+ 
							'<li><b>FECHA DE INICIO: </b>'+ feI +'</li><br>'+
							'<li><b>SOLICITUD N°: </b>'+ nro +'</li><br>'+
							'<li><b>DOMINIO: </b>'+ obj +'</li><br>'+
						'</ul>',
					showCloseButton: true,
					showDenyButton: true,
					denyButtonText: `Cancelar <i class="fas fa-times"></i>`,
					confirmButtonText: 'Ver Lista <i class="fas fa-clipboard-list"></i>'
				}).then((result) => {
					  /* Read more about isConfirmed, isDenied below */
					  if (result.isConfirmed) {
					   	window.location.href = 'listaTramites';
					  } else if (result.isDenied) {
					   	window.location.href = window.location.href;
					  } else {
					  	window.location.href = window.location.href;
					  }
				})
			</script>
		 <?php  }elseif(empty($ConsultaExisteTramitesPendientes)){ 
				if ($idTramites == 1) {
					
					$IdRubro=$_POST['IdRubro'];
					$idContribuyente=$_POST['idContribuyente'];
					$idpat=$_POST['idpat'];
					$Dominio=$_POST['Dominio'];
					$cuim=$_POST['cuim'];
					$NroDni=$_POST['NroDni'];
					$Contribuyente=$_POST['Contribuyente'];
					$Domicilio=$_POST['Domicilio'];
					$Marca=$_POST['Marca'];
					$Tipo=$_POST['Tipo'];
					$Modelo=$_POST['Modelo'];
					$ModeloY2K=$_POST['ModeloY2K'];
					$newDate1=$_POST['FechaAlta'];
					$FechaAlta=date('d/m/Y', strtotime($newDate1));
					$Identidad=$_POST['Identidad'];
					$IdTipoBaja=NULL;
					$FechaBaja=NULL;
					$out=NULL;
					$NroTipo = 1;
					$Documentacion = '1,2';
					$Observaciones = NULL;
					$Prefijo = 'A1-';
					$Postfijo = '/21';
					$ConAutorizacion = 1;
					$NroMotor = NULL;
					$OrigenEmp =NULL;
					$Codigo =NULL;
					$Anulado = 0;
					$FechaAnula = NULL;
					$Usu_Anula = NULL;
					$Usu_A = 2;
					$Firmado = 0;
					$FechaFirma = NULL;
					$UsuFirma = NULL;
					$NroCaso = 1;
					$DetalleCaso ="SOLICITUD LIBRE DE DEUDA DE AUTOMOTOR WEB";
					$tabla='LibreDeudaAutomotor';

					$rta=AutomotoresModelos::mdlConfirmacionSolicitud($IdRubro,$idContribuyente,$idpat,$Dominio,$cuim,$NroDni,$Contribuyente,$Domicilio,$Marca,$Tipo,$Modelo,$ModeloY2K,$FechaAlta,$Identidad,$IdTipoBaja,$FechaBaja,$out,$NroTipo,$Documentacion,$Observaciones,$Prefijo,$Postfijo,$ConAutorizacion,$NroMotor,$OrigenEmp,$Codigo,$Anulado,$FechaAnula,$Usu_Anula,$Usu_A,$Firmado,$FechaFirma,$UsuFirma,$NroCaso,$DetalleCaso,$tabla,$idTramites);

					return $rta;

				} elseif ($idTramites == 2) {
					
					$IdRubro=$_POST['IdRubro'];
					$idContribuyente=$_POST['idContribuyente'];
					$idpat=$_POST['idpat'];
					$Dominio=$_POST['Dominio'];
					$cuim=$_POST['cuim'];
					$NroDni=$_POST['NroDni'];
					$Contribuyente=$_POST['Contribuyente'];
					$Domicilio=$_POST['Domicilio'];
					$Marca=$_POST['Marca'];
					$Tipo=$_POST['Tipo'];
					$Modelo=$_POST['Modelo'];
					$ModeloY2K=$_POST['ModeloY2K'];
					$newDate1=$_POST['FechaAlta'];
					$FechaAlta=date('d/m/Y', strtotime($newDate1));
					$Identidad=$_POST['Identidad'];
					$IdTipoBaja=$_POST['IdTipoBaja'];
					$newDate =$_POST['FechaBaja'];
					$FechaBaja = date('d/m/Y', strtotime($newDate));
					$out=NULL;
					$NroTipo = 1;
					$Documentacion = '5,6,7';
					$Observaciones = NULL;
					$Prefijo = 'A3-';
					$Postfijo = '/21';
					$ConAutorizacion = 1;
					$NroMotor = NULL;
					$OrigenEmp =NULL;
					$Codigo =NULL;
					$Anulado = 0;
					$FechaAnula = NULL;
					$Usu_Anula = NULL;
					$Usu_A = 2;
					$Firmado = 0;
					$FechaFirma = NULL;
					$UsuFirma = NULL;
					$NroCaso = 1;
					$DetalleCaso ="SOLICITUD BAJA AUTOMOTOR WEB";
					$tabla='BajaAutomotor';

					$rta=AutomotoresModelos::mdlConfirmacionSolicitud($IdRubro,$idContribuyente,$idpat,$Dominio,$cuim,$NroDni,$Contribuyente,$Domicilio,$Marca,$Tipo,$Modelo,$ModeloY2K,$FechaAlta,$Identidad,$IdTipoBaja,$FechaBaja,$out,$NroTipo,$Documentacion,$Observaciones,$Prefijo,$Postfijo,$ConAutorizacion,$NroMotor,$OrigenEmp,$Codigo,$Anulado,$FechaAnula,$Usu_Anula,$Usu_A,$Firmado,$FechaFirma,$UsuFirma,$NroCaso,$DetalleCaso,$tabla,$idTramites);
					
				return $rta; 
				} // end elseif ($idTramites == 2)
			} //end else if(!empty($ConsultaExisteTramitesPendientes))
		} //end if (isset($_POST['idTramites']))
	} //end function ctrConfirmacionSolicitud()
	
}
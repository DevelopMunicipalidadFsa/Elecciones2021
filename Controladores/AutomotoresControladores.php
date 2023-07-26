<?php 
/* pasa el parametro $idContribuyente al MODELO AutomotoresModelos::mdlConsultaContribu() */
// session_start();
class ControladorElecciones {
 	/*=============================================
	 =            LISTA USUARIOS          		=
	 =============================================*/ 
	
	public function ctrListaUsuarios(){

		/* pasa el parametro $tabla al modelo ModelosElecciones::mdlListaUsuarios($tabla)*/
		$tabla='Responsables2021';
		$rta=ModelosElecciones::mdlListaUsuarios($tabla);

		return $rta;
	}
	/*=============================================
	 = lista de escuela mesas por responsable   =
	 =============================================*/ 
	
	public function ctrListaMesasUsuario($id,$idMesa){

		$rta=ModelosElecciones::mdlListaMesasUsuario($id,$idMesa);

		return $rta;
	}
		/*=============================================
	 		= lista de Lemas por sublemas   =
	 =============================================*/ 
	
	public function ctrListaLemaSublemas($id){

		$rta=ModelosElecciones::mdlListaLemaSublemas($id);

		return $rta;
	}
	/*=============================================
	 		= lista de Partidos   =
	=============================================*/ 
	
	public function ctrListaPartidos(){

		$rta=ModelosElecciones::mdlListaPartidos();

		return $rta;
	}
	/*=============================================
	= 	Consultar carga de los Sublemas por mesa  =
	=============================================*/ 
	
	public function ctrConsultaCarga($idMesa,$idSublema){
		
		$cons=ModelosElecciones::mdlConsultaMesa($idMesa,$idSublema);
			
		return $cons;
			
	}
	/*=============================================
	= 	Consultar carga de los Partidos por mesa  =
	=============================================*/ 
	
	public function ctrConsultaCargaPartidos($idMesa,$idPartidos){
		
		$cons=ModelosElecciones::mdlConsultaCargaPartidos($idMesa,$idPartidos);
			
		return $cons;
			
	}
	/*=============================================
	 		= Alta Formulario Sublemas   =
	=============================================*/ 
	
	public function ctrAltaForm(){

		if (isset($_POST['valor'])) {
			
			$cantidadReg= $_POST['cantidadReg'];
			$idSublema= $_POST['idSublema'];
			$idMesa= $_POST['Mesa'];
			$valor= $_POST['valor'];
			$i=0;
			foreach($valor as $cantidad){

				$rta=ModelosElecciones::mdlAltaForm($idMesa,$idSublema[$i],$cantidad);
				
				$i++;
			}

			return $rta;

		}elseif (isset($_POST['valorActualizar'])) {


			$cantidadReg= $_POST['cantidadReg'];
			$idSublema= $_POST['idSublema'];
			// print_r($idSublema);
			$idMesa= $_POST['Mesa'];
			$valor= $_POST['valorActualizar'];
			// print_r($valor);

			$i=0;
			foreach($valor as $cantidad){

				$rta=ModelosElecciones::mdlActualizarForm($idMesa,$idSublema[$i],$cantidad);
	
				$i++;
			}
			return $rta;
		}
	}
	/*=============================================
	 		= Alta Formulario Partidos   =
	=============================================*/ 
	
	public function ctrAltaFormPartidos(){

		if (isset($_POST['valorPartidoCarga'])) {
			
			$cantidadReg= $_POST['cantidadReg'];
			$idPartido= $_POST['idPartido'];
			// print_r($idPartido);
			$idMesa= $_POST['Mesa'];
			$valor= $_POST['valorPartidoCarga'];
			// print_r($valor);
		
			$i=0;
			foreach($valor as $cantidad){
				 $ConsultaCarga=ModelosElecciones::mdlConsultaCargaPartidos($idMesa,$idPartido[$i]);

				if($ConsultaCarga != 'error'){
				 		
				 		$rta=ModelosElecciones::mdlAltaFormPartidos($idMesa,$idPartido[$i],$cantidad);
							
					if($rta == "OK"){
						echo "<script>
								Swal.fire({
								  icon: 'success',
								  title: 'Carga Finalizada con éxito',
								  text: 'Por favor aguarde un momento',
								  showConfirmButton:false,
								  AllowOutsideClick:false,
								})
								function refresh() {
 
								 window.location.href='listaMesas';
								 
								}
								 
								setTimeout(refresh,2000);
								

						</script>";
					}else{
						echo "<script>
								Swal.fire({
								  icon: 'error',
								  title: 'Hubo un error al finalizar la carga comunicarse con el Administrador',
								  text: ''
								})
								function refresh() {
 
								 window.location.href='listaMesas';
								 
								}
								 
								setTimeout(refresh,2000);
						</script>";
					}
				}
			$i++;
				
			}
			
					

		}elseif (isset($_POST['valorPartidoActualizar'])) {

				$cantidadReg= $_POST['cantidadReg'];
				$idPartido= $_POST['idPartido'];
				// // print_r($idPartido);
				$idMesa= $_POST['Mesa'];
				$valor= $_POST['valorPartidoActualizar'];
				// print_r($valor);
				$i=0;
				foreach($valor as $cantidad){

					$rta=ModelosElecciones::mdlActualizarForm($idMesa,$idPartido[$i],$cantidad);
		
					$i++;
				}

					if($rta == "OK"){
						echo "<script>
								Swal.fire({
								  icon: 'success',
								  title: 'Mesa verificada con éxito',
								  text: '',
								  showConfirmButton:false,
								  AllowOutsideClick:false,
								})
								function refresh() {

								 window.location.href='listaFormularios';
								 
								}
								 
								setTimeout(refresh,2000);
							</script>";
					}else{
						echo "<script>
								Swal.fire({
								  icon: 'error',
								  title: 'Hubo un error al Verificar Mesa comunicarse con el Administrador',
								  text: ''
								})
								
							</script>";
					}
		}
	}
	/*=============================================
	= 	Consultar total Lemas  =
	=============================================*/ 
	
	public function ctrTotalLemas(){
		
		$cons=ModelosElecciones::mdlTotalLemas();
			
		return $cons;
			
	}
	/*=============================================
	= 	Consultar total Lemas  =
	=============================================*/ 
	
	public function ctrTotalCandidato(){
		
		$cons=ModelosElecciones::mdlTotalCandidatos();
			
		return $cons;
			
	}
	/*=============================================
	= 	Consultar total Partidos  =
	=============================================*/ 
	
	public function ctrTotalPartidos(){
		
		$cons=ModelosElecciones::mdlTotalPartidos();
			
		return $cons;
			
	}

}	 
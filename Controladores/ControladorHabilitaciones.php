<?php
class ControladorHabilitaciones
{
	static public function CtrlMostrarComercios()
	{
		$arreglo = array();
		$respuesta = ModeloHabilitaciones::ListarComercios();

		foreach ($respuesta as $agencias) {
			$arreglo[] = $agencias;
		}
		return $respuesta;
	}

	static public function CtrlMostrarDimensiones()
	{
		$arreglo = array();
		$respuesta = ModeloHabilitaciones::ListarDimensiones();

		foreach ($respuesta as $agencias) {
			$arreglo[] = $agencias;
		}
		return $respuesta;
	}

	static public function CtrlValidarPartida($nro_partida)
	{
		$respuesta = ModeloHabilitaciones::MdlValidarPartida($nro_partida);

		return $respuesta;
	}

	static public function CtrlFiltrarMzCasa($manzana, $casa)
	{
		$respuesta = ModeloHabilitaciones::MdlFiltrarMzCasa($manzana, $casa);

		return $respuesta;
	}

	static public function CtrlFiltrarCalleAltura($calle, $modificador, $altura)
	{
		$respuesta = ModeloHabilitaciones::MdlFiltrarCalleAltura($calle, $modificador, $altura);

		return $respuesta;
	}


	static public function CtrlBuscarBarrio($id_barrio)
	{
		$respuesta = ModeloHabilitaciones::MdlBuscarBarrio($id_barrio);

		if (empty($respuesta)) {
			return "sin barrio";
		} else {
			return $respuesta;
		}
	}

	static public function CtrlBuscarCalle($cod_calle)
	{
		$respuesta = ModeloHabilitaciones::MdlBuscarCalle($cod_calle);

		if (empty($respuesta)) {
			return "sin calle";
		} else {
			return $respuesta;
		}
	}

	static public function CtrlValidarRequisito($id_contribuyente, $id_requisito)
	{
		$respuesta = ModeloHabilitaciones::MdlValidarRequisito($id_contribuyente, $id_requisito);

		if (empty($respuesta)) {
			return "sin registros";
		} else {
			return $respuesta;
		}
	}

	static public function ctrMostrarCalles()
	{

		$respuesta = ModeloHabilitaciones::mdlMostrarCalles();
		return $respuesta;
	}

	static public function CtrlMostrarMisSolicitudes($IdContribuyente)
	{
		$arreglo = array();
		$respuesta = ModeloHabilitaciones::MdlMostrarMisSolicitudes($IdContribuyente);

		if (empty($respuesta)) {
			return "sin resultados";
		} else {
			foreach ($respuesta as $solicitudes) {
				$arreglo[] = $solicitudes;
			}

			return $arreglo;
		}
	}

	static public function CtrlVisualizarRequisito($id_requisito)
	{
		$respuesta = ModeloHabilitaciones::MdlVisualizarRequisito($id_requisito);

		if (empty($respuesta)) {
			return "sin registros";
		} else {
			return $respuesta;
		}
	}

	static public function CtrlNotificacionHabilitacion($idTramiteContribuyente)
	{
		$respuesta = ModeloHabilitaciones::MdlNotificacionHabilitacion($idTramiteContribuyente);

		if (empty($respuesta)) {
			return "sin registros";
		} else {
			return $respuesta;
		}
	}

	static public function CtrlMostrarDatosContribuyentes($id_contribuyente)
	{
		$respuesta = ModeloHabilitaciones::MdlostrarDatosContribuyentes($id_contribuyente);

		if (empty($respuesta)) {
			return "sin registros";
		} else {
			return $respuesta;
		}
	}

	static public function CtrlRespuestaSolicitud($id_solicitud)
	{
		$respuesta = ModeloHabilitaciones::MdlMostrarRespuestaSolicitud($id_solicitud);
		if (empty($respuesta)) {
			return "sin registros";
		} else {
			return $respuesta;
		}
	}

	static public function CtrlGuardarSolicitud()
	{
		if (isset($_POST['F1'])) {
			$nro_partida = trim($_POST['nro_partida']);
			$IdContribuyente = $_POST['id_contribuyente'];

			$id_complejidad = $_POST['complejidad'];
			$id_tipo_comercio = $_POST['id_tipo_comercio'];
			$id_ocupacion = $_POST['car_ocupacion'];
			$ape_nom_rs = $_POST['ape_nom_rs'];
			$dni = $_POST['dni'];
			$cuil = $_POST['cuil'];
			$mail = $_POST['mail'];
			$telefono = $_POST['telefono'];
			$dom_comercial = $_POST['dom_comercial'];
			$nom_fantasia = $_POST['nom_fantasia'];
			$superficie = $_POST['superficie'];
			$id_dimensiones = $_POST['dimensiones'];
			$idTramite = 10;
			$idRubro = 11107;

			$DetalleComercio = $nom_fantasia . "_" . $nro_partida;

			if (!empty($_POST['dom_fiscal'])) {
				$dom_fiscal = $_POST['dom_fiscal'];
			} else {
				$dom_fiscal = NULL;
			}

			if (!empty($_POST['dom_real'])) {
				$dom_real = $_POST['dom_real'];
			} else {
				$dom_real = NULL;
			}

			$SPA_SolicitudComercial = ModeloHabilitaciones::SPA_SolcitudComercial("$nro_partida", $id_ocupacion, "$ape_nom_rs", "$dni", $IdContribuyente, "$cuil", "$mail", "$telefono", "$dom_comercial", "$dom_fiscal", "$dom_real", "$nom_fantasia", "$superficie", $id_dimensiones, $id_complejidad, $id_tipo_comercio);

			if ($SPA_SolicitudComercial == "Solicitud Enviada") {

				if ($_FILES['contrato_locacion']['size'] != 0) {
					$nro_partida;
					$IdContribuyente;
					$idRequisito = "37";
					$contrato_locacion = $_FILES['contrato_locacion']['name'];
					$Tipo = $_FILES['contrato_locacion']['type'];
					$rutaTemp = $_FILES['contrato_locacion']['tmp_name'];
					$explode2 = explode(".", $contrato_locacion);
					$Titulo = "Contrato de Locacion";
					$Desctripcion = "Contrato de Locacion" . "_" . $dni . "." . end($explode2);

					file_put_contents("$Desctripcion", "$Desctripcion");
					$hashFile = hash_file('md5', "$Desctripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['contrato_locacion']['tmp_name']));

					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Desctripcion", $nro_partida, "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error contrato locacion <br>";
					}
				}


				if ($_FILES['plano_l_comercial']['size'] != 0) {
					$nro_partida;
					$IdContribuyente;
					$idRequisito = "38";
					$plano_l_comercial = $_FILES['plano_l_comercial']['name'];
					$Tipo = $_FILES['plano_l_comercial']['type'];
					$rutaTemp = $_FILES['plano_l_comercial']['tmp_name'];
					$explode3 = explode(".", $plano_l_comercial);
					$Titulo = "Plano Local Comercial";
					$Desctripcion = "Plano Local Comercial" . "_" . $dni . "." . end($explode3);

					file_put_contents("$Desctripcion", "$Desctripcion");
					$hashFile = hash_file('md5', "$Desctripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['plano_l_comercial']['tmp_name']));

					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Desctripcion", "$nro_partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error plano local <br>";
					}
				}


				if ($_FILES['plano_planta_gral']['size'] != 0) {
					$nro_partida;
					$IdContribuyente;
					$idRequisito = "39";
					$plano_planta_gral = $_FILES['plano_planta_gral']['name'];
					$Tipo = $_FILES['plano_planta_gral']['type'];
					$rutaTemp = $_FILES['plano_planta_gral']['tmp_name'];
					$explode4 = explode(".", $plano_planta_gral);
					$Titulo = "Plano Planta General";
					$Descripcion = "Plano Planta General" . "_" . $dni . "." . end($explode4);

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['plano_planta_gral']['tmp_name']));


					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Descripcion", "$nro_partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error plano planta <br>";
					}
				}


				if ($_FILES['frente_dni']['size'] != 0) {
					$nro_partida;
					$IdContribuyente;
					$idRequisito = "2";
					$frente_dni = $_FILES['frente_dni']['name'];
					$Tipo = $_FILES['frente_dni']['type'];
					$rutaTemp = $_FILES['frente_dni']['tmp_name'];
					$explode5 = explode(".", $frente_dni);
					$Titulo = "Frente DNI";
					$Descripcion = "Frente Dni" . "_" . $dni . "." . end($explode5);

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['frente_dni']['tmp_name']));


					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Descripcion", "$nro_partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error frente dni <br>";
					}
				}

				if ($_FILES['dorso_dni']['size'] != 0) {
					$nro_partida;
					$IdContribuyente;
					$idRequisito = "7";
					$dorso_dni = $_FILES['dorso_dni']['name'];
					$Tipo = $_FILES['dorso_dni']['type'];
					$rutaTemp = $_FILES['dorso_dni']['tmp_name'];
					$explode5 = explode(".", $dorso_dni);
					$Titulo = "Dorso Dni";
					$Descripcion = "Dorso DNI" . "_" . $dni . "." . end($explode5);

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['dorso_dni']['tmp_name']));


					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Descripcion", "$nro_partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error Dorso dni <br>";
					}
				}


				if ($_FILES['constancia_afip']['size'] != 0) {
					$nro_partida;
					$IdContribuyente;
					$idRequisito = "40";
					$constancia_afip = $_FILES['constancia_afip']['name'];
					$Tipo = $_FILES['constancia_afip']['type'];
					$rutaTemp = $_FILES['constancia_afip']['tmp_name'];
					$explode7 = explode(".", $constancia_afip);
					$Titulo = "Constancia Inscripción AFIP";
					$Descripcion = "Constancia Inscripción AFIP" . "_" . $dni . "." . end($explode7);

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['constancia_afip']['tmp_name']));


					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Descripcion", "$nro_partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error Constancia AFIP <br>";
					}
				}


				if ($_FILES['constancia_dgr']['size'] != 0) {
					$nro_partida;
					$IdContribuyente = $_POST['id_contribuyente'];
					$idRequisito = "42";
					$constancia_dgr = $_FILES['constancia_dgr']['name'];
					$Tipo = $_FILES['constancia_dgr']['type'];
					$rutaTemp = $_FILES['constancia_dgr']['tmp_name'];
					$explode8 = explode(".", $constancia_dgr);
					$Titulo = "Constancia Inscripción D.G.R";
					$Descripcion = "Constancia Inscripción D.G.R" . "_" . $dni . "." . end($explode8);

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['constancia_dgr']['tmp_name']));

					$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($IdContribuyente, $idRequisito, "$Descripcion", "$nro_partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

					if ($AltaArchivo == "error archivos") {
						echo "error Constancia DGR <br>";
					} else { ?>
						<form action="index.php?pagina=SolicitudesHabilitacion" method="post" name="F1">
							<input type="hidden" name="nro_partida" value="<?php echo $nro_partida ?>">
						</form>
						<form action="index.php?pagina=SolicitudesHabilitacion" method="post" name="dirback">
							<input type="hidden" name="dirBack" value="<?php echo $_POST['dirBack'] ?>">
							<input type="hidden" name="nro_partida" value="<?php echo $nro_partida ?>">
						</form>
						<form action="index.php?pagina=listaTramites" method="post" name="ListaSolicitudes">
							<!-- <input type="hidden" name="nro_partida" value="<?php echo $nro_partida ?>"> -->
						</form>

<?php //-----------------REMPLAZAR--------------------------
						// $F1 = "F1"; $RETURN = "dirback";
						// 						$Listado = "ListaSolicitudes";
						// 						echo "<script>	
						// 									jQuery(function(){
						// 										Swal.fire({
						// 											icon: 'success',
						// 											title: '¡Muy bien!',
						// 											text: '" . $SPA_SolicitudComercial . "',
						// 											showDenyButton: true,
						// 											showConfirmButton: true,
						// 											denyButtonText: `Mis Solicitudes`,
						//                 							denyButtonColor: '#555',
						// 											}).then((result) => {
						// 												if (result.isConfirmed) {
						// 													document.$RETURN.submit();
						// 												} else if (result.isDenied) {
						// 													window.location.href = 'listaTramites';
						// 												}   
						// 										})
						// 									});
						// 							</script>";
						// 					}
						// 				}
						// 			} else {
						// 				$F1 = "F1";
						// 				echo "<script>	
						// 						jQuery(function(){
						// 							Swal.fire({
						// 								icon: 'error',
						// 								title: '¡Algo no anda bien!',
						// 								text: '" . $SPA_SolicitudComercial . "',
						// 								showConfirmButton: true
						// 								}).then((result) => {
						// 									document.$F1.submit();
						// 							})
						// 						});
						// 				</script>";
						// 			}
						// 		}
						// 	}	

						$F1 = "F1";
						$RETURN = "dirback";

						require_once "Vistas/Areas/Comercios/Mails/MailSolicitudEnviada.php";
						$Listado = "ListaSolicitudes";
						if (mail($mail, $asunto, $cuerpo, $headers)) {
							echo "<script>	
									jQuery(function(){
										Swal.fire({
											icon: 'success',
											title: '¡Muy bien!',
											text: '" . $SPA_SolicitudComercial . "',
											showDenyButton: true,
											showConfirmButton: true,
											denyButtonText: `Mis Solicitudes`,
                							denyButtonColor: '#555',
											}).then((result) => {
												if (result.isConfirmed) {
													document.$RETURN.submit();
												} else if (result.isDenied) {
													window.location.href = 'listaTramites';
												}   
										})
									});
						</script>";
						} else {
							echo "<script>	
									jQuery(function(){
										Swal.fire({
											icon: 'success',
											title: '¡Muy bien!',
											text: '" . $SPA_SolicitudComercial . "',
											showDenyButton: true,
											showConfirmButton: true,
											denyButtonText: `Mis Solicitudes`,
                							denyButtonColor: '#555',
											}).then((result) => {
												if (result.isConfirmed) {
													document.$RETURN.submit();
												} else if (result.isDenied) {
													window.location.href = 'listaTramites';
												}   
										})
									});
							</script>";
						}
					}
				}
			} else {
				$F1 = "F1";
				echo "<script>	
						jQuery(function(){
							Swal.fire({
								icon: 'error',
								title: '¡Algo no anda bien!',
								text: '" . $SPA_SolicitudComercial . "',
								showConfirmButton: true
								}).then((result) => {
									document.$F1.submit();
							})
						});
				</script>";
			}
		}
	}

	//------------------REEMPLAZAR---------------------------

	static public function CtrlReenviarSolicitud()
	{
		if (isset($_POST['reenviar'])) {
			$id_solicitud = $_POST['id_solicitud'];
			$id_contribuyente = $_POST['id_contribuyente'];
			$idSolicitudContribuyente = $_POST['idSolicitudContribuyente'];
			$partida = $_POST['partida'];
			$DetalleComercio = $_POST['DetalleComercio'];
			$idTramite = 10;
			$idRubro = 11107;
			$dni = $_POST['dni'];

			$ActualizarEstado = ModeloHabilitaciones::MdlActualizarSolicitud($idSolicitudContribuyente);
			if ($ActualizarEstado == "Solicitud Reenviada") {
				if ($_FILES['frenteDni']['size'] != 0) {
					$idRequisito = "2";

					$IDs = ModeloHabilitaciones::MdlValidarRequisito($id_contribuyente, $idRequisito);
					if (empty($IDs)) {
						$partida;
						$id_contribuyente;
						$dorso_dni = $_FILES['dorsoDni']['name'];
						$Tipo = $_FILES['dorsoDni']['type'];
						$rutaTemp = $_FILES['dorsoDni']['tmp_name'];
						$explode5 = explode(".", $dorso_dni);
						$Titulo = "Dorso DNI";
						$Descripcion = "Dorso DNI" . "_" . $dni . "." . end($explode5);

						file_put_contents("$Descripcion", "$Descripcion");
						$hashFile = hash_file('md5', "$Descripcion");
						$imgBase64 = base64_encode(file_get_contents($_FILES['dorsoDni']['tmp_name']));


						$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($id_contribuyente, $idRequisito, "$Descripcion", "$partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

						if ($AltaArchivo == "error archivos") {
							echo "error Dorso dni <br>";
						}
					} else {
						foreach ($IDs as $data) {
							$idDD = $data['idDocumentoDigitalizado'];
							$idDE = $data['idDocumentoEncriptado'];
						}

						$frenteDni = $_FILES['frenteDni']['name'];
						$Tipo = $_FILES['frenteDni']['type'];
						$rutaTemp = $_FILES['frenteDni']['tmp_name'];
						$Descripcion = "Fotocopia del DNI Frente";

						file_put_contents("$Descripcion", "$Descripcion");
						$hashFile = hash_file('md5', "$Descripcion");
						$imgBase64 = base64_encode(file_get_contents($_FILES['frenteDni']['tmp_name']));

						$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
						if ($ActualizarRequisitos == "error") {
							echo "no se actualizo dni frente";
						}
					}
				}

				if ($_FILES['dorsoDni']['size'] != 0) {
					$idRequisito = "7";
					$dni = $_POST['dni'];

					$IDs = ModeloHabilitaciones::MdlValidarRequisito($id_contribuyente, $idRequisito);
					if (empty($IDs)) {
						$partida;
						$id_contribuyente;
						$dorso_dni = $_FILES['dorsoDni']['name'];
						$Tipo = $_FILES['dorsoDni']['type'];
						$rutaTemp = $_FILES['dorsoDni']['tmp_name'];
						$explode5 = explode(".", $dorso_dni);
						$Titulo = "Dorso DNI";
						$Descripcion = "Dorso DNI" . "_" . $dni . "." . end($explode5);

						file_put_contents("$Descripcion", "$Descripcion");
						$hashFile = hash_file('md5', "$Descripcion");
						$imgBase64 = base64_encode(file_get_contents($_FILES['dorsoDni']['tmp_name']));


						$AltaArchivo = ModeloHabilitaciones::mdlAltaArchivo($id_contribuyente, $idRequisito, "$Descripcion", "$partida", "$Tipo", "$hashFile", "$imgBase64", $idTramite, $idRubro, "$Titulo", "$DetalleComercio");

						if ($AltaArchivo == "error archivos") {
							echo "error Dorso dni <br>";
						}
					} else {
						foreach ($IDs as $data) {
							$idDD = $data['idDocumentoDigitalizado'];
							$idDE = $data['idDocumentoEncriptado'];
						}

						$frenteDni = $_FILES['dorsoDni']['name'];
						$Tipo = $_FILES['dorsoDni']['type'];
						$rutaTemp = $_FILES['dorsoDni']['tmp_name'];
						$Descripcion = "Fotocopia del DNI Frente";

						file_put_contents("$Descripcion", "$Descripcion");
						$hashFile = hash_file('md5', "$Descripcion");
						$imgBase64 = base64_encode(file_get_contents($_FILES['dorsoDni']['tmp_name']));

						$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
						if ($ActualizarRequisitos == "error") {
							echo "no se actualizo dni dorso";
						}
					}
				}

				if ($_FILES['ContratoLocacion']['size'] != 0) {
					$idRequisito = "37";

					$IDs = ModeloHabilitaciones::MdlExtraerInfoRequisito($id_contribuyente, $idRequisito, $partida, $DetalleComercio);
					foreach ($IDs as $data) {
						$idDD = $data['IDdigitalizado'];
						$idDE = $data['IDencriptado'];
					}

					$ContratoLocacion = $_FILES['ContratoLocacion']['name'];
					$Tipo = $_FILES['ContratoLocacion']['type'];
					$rutaTemp = $_FILES['ContratoLocacion']['tmp_name'];

					$Descripcion = "Contrato de Locación";

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['ContratoLocacion']['tmp_name']));

					$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
					if ($ActualizarRequisitos == "error") {
						echo "no se actualizo contrato de locación";
					}
				}

				if ($_FILES['planoLcomercial']['size'] != 0) {
					$idRequisito = "38";

					$IDs = ModeloHabilitaciones::MdlExtraerInfoRequisito($id_contribuyente, $idRequisito, $partida, $DetalleComercio);
					foreach ($IDs as $data) {
						$idDD = $data['IDdigitalizado'];
						$idDE = $data['IDencriptado'];
					}

					$planoLcomercial = $_FILES['planoLcomercial']['name'];
					$Tipo = $_FILES['planoLcomercial']['type'];
					$rutaTemp = $_FILES['planoLcomercial']['tmp_name'];

					$Descripcion = "Plano del Local Comercial";

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['planoLcomercial']['tmp_name']));

					$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
					if ($ActualizarRequisitos == "error") {
						echo "no se actualizo Plano Local Comercial";
					}
				}

				if ($_FILES['planoPlantaGral']['size'] != 0) {
					$idRequisito = "39";

					$IDs = ModeloHabilitaciones::MdlExtraerInfoRequisito($id_contribuyente, $idRequisito, $partida, $DetalleComercio);
					foreach ($IDs as $data) {
						$idDD = $data['IDdigitalizado'];
						$idDE = $data['IDencriptado'];
					}

					$planoPlantaGral = $_FILES['planoPlantaGral']['name'];
					$Tipo = $_FILES['planoPlantaGral']['type'];
					$rutaTemp = $_FILES['planoPlantaGral']['tmp_name'];

					$Descripcion = "Plano de Planta General";

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['planoPlantaGral']['tmp_name']));

					$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
					if ($ActualizarRequisitos == "error") {
						echo "no se actualizo Plano Planta General";
					}
				}

				if ($_FILES['afip']['size'] != 0) {
					$idRequisito = "40";

					$IDs = ModeloHabilitaciones::MdlExtraerInfoRequisito($id_contribuyente, $idRequisito, $partida, $DetalleComercio);
					foreach ($IDs as $data) {
						$idDD = $data['IDdigitalizado'];
						$idDE = $data['IDencriptado'];
					}

					$afip = $_FILES['afip']['name'];
					$Tipo = $_FILES['afip']['type'];
					$rutaTemp = $_FILES['afip']['tmp_name'];

					$Descripcion = "Constancia de Inscripción AFIP";

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['afip']['tmp_name']));

					$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
					if ($ActualizarRequisitos == "error") {
						echo "no se actualizo Constancia de inscripción AFIP";
					}
				}

				if ($_FILES['dgr']['size'] != 0) {
					$idRequisito = "42";

					$IDs = ModeloHabilitaciones::MdlExtraerInfoRequisito($id_contribuyente, $idRequisito, $partida, $DetalleComercio);
					foreach ($IDs as $data) {
						$idDD = $data['IDdigitalizado'];
						$idDE = $data['IDencriptado'];
					}

					$dgr = $_FILES['dgr']['name'];
					$Tipo = $_FILES['dgr']['type'];
					$rutaTemp = $_FILES['dgr']['tmp_name'];

					$Descripcion = "Constancia de Inscripción DGR";

					file_put_contents("$Descripcion", "$Descripcion");
					$hashFile = hash_file('md5', "$Descripcion");
					$imgBase64 = base64_encode(file_get_contents($_FILES['dgr']['tmp_name']));

					$ActualizarRequisitos = ModeloHabilitaciones::MdlActualizarRequisito($idDD, $idDE, $Tipo, $hashFile, $imgBase64, "$Descripcion");
					if ($ActualizarRequisitos == "error") {
						echo "no se actualizo Constancia de inscripción DGR";
					}
				}

				echo "<script>	
					jQuery(function(){
						Swal.fire({
							icon: 'success',
							title: '¡Muy bien!',
							text: 'Solicitud Reenviada Correctamente',
							showConfirmButton: true
							}).then((result) => {
								window.location.href = 'listaTramites';
						})
					});
				</script>";
			} else {
				echo "<script>	
						jQuery(function(){
							Swal.fire({
								icon: 'error',
								title: '¡Algo no anda bien!',
								text: '" . $ActualizarEstado . "',
								showConfirmButton: true
								}).then((result) => {
									window.location.href = 'listaTramites';
							})
						});
				</script>";
			}
		}
	}
}

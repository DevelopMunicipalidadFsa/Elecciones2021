<?php 
include 'conexiones.php';
// Desactivar toda notificación de error
// error_reporting(0);
class AutomotoresModelos {
	
	public function mdlIngresoUsu($tabla, $item, $valor){
			
		$stmt = Conexiones::conSW()->prepare("SELECT Id, Contribuyente, FechaNacimiento, Sexo, Cuit, IdTipoPersona, Mail, IdEstadoCivil, Telefono, Fallecido, FechaAlta, Origen, NroDni, Procesado, AvisoVencimiento, Masiva, IdNacionalidad, PuntoV FROM $tabla WHERE $item = $valor");
		
		$stmt->execute();

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null; 
	}

	public function mdlFecha(){
		//SP fecha extraida del servidor municipal
		$consultaFecha= Conexiones::conM()->prepare("EXEC [municipio].[dbo].[Fecha]");
		$consultaFecha->execute();

		return $consultaFecha->fetchAll();

		$consultaFecha ->close();
	}

	public function mdlFechaLarga($fecha){
	  
	  $numeroDia = date('d', strtotime($fecha));
	  $dia = date('l', strtotime($fecha));
	  $mes = date('F', strtotime($fecha));
	  $anio = date('Y', strtotime($fecha));
	  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
	  $meses_ES = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
	  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	  return $numeroDia." DE ".$nombreMes." DE ".$anio;
	}

	public function mdlObtenerObjetos($IdRubro,$idContribuyente){
		$objetoContibuWEB= Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[objetoContribuyenteWEB] (
		   $idContribuyente
		  ,$IdRubro
		  ,NULL);");

		$objetoContibuWEB->execute();

		return $objetoContibuWEB->fetchAll();

		$objetoContibuWEB ->close();
	}

	public function mdlDeudaContribu($Identidad,$IdRubro,$Fecha){
		
		//CONSULTA ESTADO DE CUENTA DEL DOMINIO SELECCIONADO ANTERIORMENTE
		
		$deudaContribu=Conexiones::conM()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[consultaDeuda] (
		$Identidad
		,$IdRubro
		,'$Fecha')");

		$deudaContribu->execute();

		return $deudaContribu->fetchAll();
	}


	public function mdlMultaContribuTF($CodObjeto){
		
		//CONSULTA ESTADO DE CUENTA DEL DOMINIO SELECCIONADO ANTERIORMENTE
		
		$multaContribu=Conexiones::conIF()->prepare('SELECT * FROM ConsultaLibreDeuda (?)');

		$multaContribu->bindParam(1, $CodObjeto,PDO::PARAM_STR);
		
		$multaContribu->execute();

		return $multaContribu->fetchAll();
	}

	public function mdlDeudaPeriodo($Identidad,$IdRubro,$Fecha){
		
		//CONSULTA el periodo del ESTADO DE CUENTA DEL DOMINIO SELECCIONADO ANTERIORMENTE

		$consultaDeudaPeriodo=Conexiones::conM()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[CunsultarPeriodoDeuda] (
		$Identidad
		,$IdRubro
		,'$Fecha')");

		$consultaDeudaPeriodo->execute();
		return $consultaDeudaPeriodo->fetch();
	}
	public function mdlObjetoContibu($Identidad,$IdRubro,$idContribuyente){

		$ContibuObjetos = Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[objetoContribuyenteWEB] (
		   $idContribuyente
		  ,$IdRubro
		  ,$Identidad)");

		$ContibuObjetos->execute();

		return $ContibuObjetos->fetchAll();

		$ContibuObjetos ->close();

	}
	/*============================================================
	=            lista de tramites por contribuyentes            =
	============================================================*/
	
	public function mdlListaTramitesContibu($IdRubro,$valor,$tipo){

		$listaTramiteContribu = Conexiones::conM105()->prepare("SELECT * FROM ListaTramitesContribu (?,?,?)");
		$listaTramiteContribu->bindParam(1, $IdRubro, PDO::PARAM_INT);
		$listaTramiteContribu->bindParam(2, $valor, PDO::PARAM_INT);
		$listaTramiteContribu->bindParam(3, $tipo, PDO::PARAM_STR);

		$listaTramiteContribu->execute();
		return $listaTramiteContribu->fetchAll();
		
		

		

		$listaTramiteContribu ->close();

	}
	
	/*=====  End of lista de tramites por contribuyentes  ======*/
	

	public function mdlContibuDatos($idContribuyente){

	
		$ContibuDatos = Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[ContribuyentesDatos] (
		$idContribuyente);");

		$ContibuDatos->execute();

		return $ContibuDatos->fetchAll();

		$ContibuDatos ->close();

	}
	public function mdlConsultaUpdateContibuDatos($idContribuyente){

		$ConsultaUpdateContibuDatos = Conexiones::conDD()->prepare("SELECT Id, idContribuyente, telefono, mail, fechaActualizacion,activo
															FROM         AuditoriaActualizacionDatosContribu
															WHERE     (idContribuyente = $idContribuyente) AND (activo = 'True')");
		$ConsultaUpdateContibuDatos->execute();

		return $ConsultaUpdateContibuDatos->fetch();
		
		$ConsultaUpdateContibuDatos ->close();

	}
	public function mdlUpdateContibuDatos($telefono,$email,$idContribuyente){

		$UpdateContibuDatos = Conexiones::conDD()->prepare("EXEC ContribuDatosActualizar ?,?,?");

		$UpdateContibuDatos->bindParam(1, $telefono, PDO::PARAM_STR);
		$UpdateContibuDatos->bindParam(2, $email, PDO::PARAM_STR);
		$UpdateContibuDatos->bindParam(3, $idContribuyente, PDO::PARAM_INT);

		$UpdateContibuDatos->execute();
		return $UpdateContibuDatos->fetchAll();
		$UpdateContibuDatos ->close();

	}
	public function mdlTipoBaja(){
	
		$TipoBaja=Conexiones::conM()->prepare("SELECT idtipobaja,descripcion FROM dbo.tuvp_tiposbajas  where EsBaja = 1 and idtipobaja in (6,7,8,29)");
		$TipoBaja->execute();
		return $TipoBaja->fetchAll();
		$TipoBaja ->close();

	}
	public function mdlTipoBajaSolicitud($IdTipoBaja){
		$TipoBaja = Conexiones::conM()->prepare("SELECT idtipobaja,descripcion FROM dbo.tuvp_tiposbajas  where EsBaja = 1 and idtipobaja in (6,7,8,29) and idtipobaja= $IdTipoBaja");
		$TipoBaja->execute();
		return $TipoBaja->fetchAll();			
	}
	public function mdlTramitesLista($IdRubro){

		$id=$IdRubro;
		
		$listaTramites=Conexiones::conDD()->prepare("SELECT idTramites,TramitesNombre FROM Tramites
			WHERE
			idRubro=$id AND
			Activo = 1 ");	

		$listaTramites->execute();
		return $listaTramites->fetchAll();

		$listaTramites ->close();

	}
	public function mdlTramitesListaDetalles($IdTramite){

		
			$listaTramitesDetalles=Conexiones::conM105()->prepare("SELECT idTramites,TramitesNombre,TramitesDescripcion FROM Tramites
			WHERE
			idTramites=$IdTramite");
		
		

		$listaTramitesDetalles->execute();
		return $listaTramitesDetalles->fetchAll();

		$listaTramitesDetalles ->close();

	}

	public function mdlTramiteNombre($idTramites){
		$id=$idTramites;
		$tramitesNombre=Conexiones::conDD()->prepare("SELECT idTramites,TramitesNombre FROM Tramites
			WHERE
			idTramites=$id");
		$tramitesNombre->execute();

		return $tramitesNombre->fetch();
		$tramitesNombre ->close();

	}
	/*============================================================
	=           REIMPRIMIR SOLICITUD DE TRAMITE           =
	============================================================*/
	
	public function mdlTramitesSolicitudReimprimir($idTramites,$idSolicitud){

		$TramitesSolicitudReimprimir = Conexiones::conM105()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[ReimpresionSolicitud] ($idTramites,$idSolicitud)");

		$TramitesSolicitudReimprimir->execute();

		return $TramitesSolicitudReimprimir->fetchAll();

		$TramitesSolicitudReimprimir ->close();

	}
	
	/*=====  End of lista de tramites por contribuyentes  ======*/

	

	public function mdlRequisitosLista($idTramites){

		$RequisitosLista=Conexiones::conDD()->prepare("SELECT * FROM Tramites as T JOIN
		Tramites_por_RequisitosTramites as TxR ON T.idTramites=TxR.idTramites INNER JOIN
		TramitesRequisitos as R ON TxR.idRequisitosTramites=R.idTramitesRequisitos
		WHERE
		T.idTramites=$idTramites");

		$RequisitosLista->execute();

		return $RequisitosLista->fetchAll();
	}

	public function mdlRequisitosTramitesContribuyentes($idTramites,$IdTipoBaja,$IdRubro,$idContribuyente,$Identidad){
			
		$tramitesRequisitos=Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[FN_RequisitosTramitesContribuyentes] (
				$idTramites
				,$IdTipoBaja
				,$IdRubro 
				,$idContribuyente
				,'$Identidad')");

		$tramitesRequisitos->execute();

		return $tramitesRequisitos->fetchAll();
	}
	public function mdlUsuarioSolicitud($idSolicitud,$estadoTramite){

		if($estadoTramite == "PAUSADO"){
		$UsuarioSolicitud=Conexiones::conM105()->prepare("SELECT dbo.Tramites_por_Contribuyentes.idTamites_por_Contribuyentes,dbo.Tramites_por_Contribuyentes.idSolicitud
			  ,dbo.Tramites_por_Contribuyentes.TramiteFechaInicio 
			  ,dbo.Tramites_por_Contribuyentes.TramiteObjeto
			  ,dbo.TramitesContribuyentes_por_Estados.idEstados, dbo.TramitesContribuyentes_por_Estados.Activo
			  ,dbo.TramitesContribuyentes_por_Estados.Fecha, dbo.TramitesContribuyentes_por_Estados.Usuario 
			  ,dbo.TramitesContribuyentes_por_Estados.UsuarioNombre,dbo.TramitesDevolución.[fechaHoraCreacion] as fechaDevolucion
		      ,dbo.TramitesDevolución.[Visto],dbo.TramitesDevolución.[fechaVisto],dbo.TramitesDevolución.[mensaje]
		      ,dbo.TramitesDevolución.[tituloAutomotor],dbo.TramitesDevolución.[dniFrente]
		      ,dbo.TramitesDevolución.[dniDorso],dbo.TramitesDevolución.[formulario04RegAut]
			FROM  dbo.Tramites_por_Contribuyentes 
				  JOIN dbo.TramitesContribuyentes_por_Estados ON dbo.Tramites_por_Contribuyentes.idTamites_por_Contribuyentes = dbo.TramitesContribuyentes_por_Estados.idTamites_por_Contribuyentes
				  JOIN dbo.TramitesDevolución ON dbo.Tramites_por_Contribuyentes.idTamites_por_Contribuyentes=dbo.TramitesDevolución.idTamites_por_Contribuyentes
				  JOIN	municipio.dbo.Tuvp_Movimientos  ON dbo.Tramites_por_Contribuyentes.idSolicitud=municipio.dbo.Tuvp_Movimientos.Id
			WHERE (dbo.Tramites_por_Contribuyentes.idSolicitud = $idSolicitud) AND (dbo.TramitesContribuyentes_por_Estados.Activo = 1) AND (dbo.TramitesDevolución.Activo = 1)");

		 	$UsuarioSolicitud->execute();

			return $UsuarioSolicitud->fetchAll();

		}		
		
	}
	/*============================================================
	=           consultar id de requisito           =
	============================================================*/
	
	public function mdlConsultaidRequisito($titulo){

		$ConsultaidRequisito = Conexiones::conDD()->prepare('SELECT idTramitesRequisitos FROM TramitesRequisitos WHERE (TramitesRequisitosDetalles = "$titulo")');

		$ConsultaidRequisito->execute();

		return $ConsultaidRequisito->fetch();

		$ConsultaidRequisito ->close();

	}

	public function mdlConsultaRequisitosDig($idContribuyente,$idRequisitosTramites){

		//	verificamos si existe el requisito digitalizado antes de guardarlo
		 $ConsultaRequisitosDig=Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[HabilitacionesC_ValidaRequisito] (
														   $idContribuyente
														  ,$idRequisitosTramites)");
		 // se ejecuta y se recorre el set de datos
		 $ConsultaRequisitosDig->execute();

		 return $ConsultaRequisitosDig ->fetchAll();
		  

	}
	/*============================================================
	=           Redimencionar Imagenes a un % menor          =
	============================================================*/
	
	public function mdlRedimensionarImg($rtOriginal){
		
						//Imagen original
						$rtOriginal= $_FILES['archivo']['tmp_name'];
						//Se verifica el tipo de imagen generar la imagen en el formato que corresponda
						$type = exif_imagetype($rtOriginal);
						//Crear variable de imagen original en los tres formatos siguientes
						switch ($type) {
						    case 1 :
						        $original = imageCreateFromGif($rtOriginal);
						    break;
						    case 2 :
						        $original = imageCreateFromJpeg($rtOriginal);
						    break;
						    case 3 :
						        $original = imageCreateFromPng($rtOriginal);
						    break;
						}   

						//Se le asigna un valor a la variable de porcentaje de reducción $percent_resizing dependiendo del tamaño de la imagen
						switch ($_FILES['archivo']['size']) {
						    case $_FILES['archivo']['size'] >= 25000000 :
						       $percent_resizing = 50;
						    break;
						    case $_FILES['archivo']['size'] >= 15000000 && $_FILES['archivo']['size'] <= 25000000:
						        $percent_resizing = 55;
						    break;
						    case $_FILES['archivo']['size'] >= 10000000 && $_FILES['archivo']['size'] <= 15000000:
						        $percent_resizing = 60;
						    break;
						    case $_FILES['archivo']['size'] >= 5000000 && $_FILES['archivo']['size'] <= 10000000:
						        $percent_resizing = 65;
						    break;
						    case $_FILES['archivo']['size'] >= 900000 && $_FILES['archivo']['size'] <= 5000000:
						        $percent_resizing = 70;
						    break;
						    case $_FILES['archivo']['size'] >= 500000 && $_FILES['archivo']['size'] <= 900000:
						        $percent_resizing = 80;
						    break;
						    default:
      							$percent_resizing = 90;
						}

						//Medir la imagen
						$lis=list($ancho,$alto)=getimagesize($rtOriginal);
				
						//Ancho y alto máximo
						$new_ancho = round((($percent_resizing/100)*$ancho));
						$new_alto = round((($percent_resizing/100)*$alto));
						//Ratio
						$x_ratio = $new_ancho / $ancho;
						$y_ratio = $new_alto / $alto;

						//Proporciones
						if(($ancho <= $new_ancho) && ($alto <= $new_alto) ){
						    $ancho_final = $ancho;
						    $alto_final = $alto;
						}
						else if(($x_ratio * $alto) < $new_alto){
						    $alto_final = ceil($x_ratio * $alto);
						    $ancho_final = $new_ancho;
						}
						else {
						    $ancho_final = ceil($y_ratio * $ancho);
						    $alto_final = $new_alto;
						}

						//Crear un lienzo
						$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

						//Copiar original en lienzo
						imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
						 
						//Destruir la original
						imagedestroy($original);

						//Crear la imagen y guardar en directorio upload/
						imagejpeg($lienzo,"imgTemp/".$_FILES['archivo']['name']);

						$img="imgTemp/".$_FILES['archivo']['name'];
						return $imgBase64=base64_encode(file_get_contents("imgTemp/".$_FILES['archivo']['name']));
						
			}
	
	/*=====  End of Redimencionar Imagenes a un % menor ======*/

	/*=====  End of consultar id de requisito  ======*/
	public function mdlAltaImg($idContribuyente,$idRequisitosTramites,$titulo,$Identidad,$imgN,$imgType,$hashFile,$datos,$devolucion,$idSolicitud){
		if($devolucion == NULL){
			$insertDocumentosEncriptados=Conexiones::conDD()->prepare("EXEC InsertRequerimientosDigitales ?,?,?,?,?,?,?,?");

			$insertDocumentosEncriptados->bindParam(1, $idContribuyente);
			$insertDocumentosEncriptados->bindParam(2, $idRequisitosTramites);
			$insertDocumentosEncriptados->bindParam(3, $titulo);
			$insertDocumentosEncriptados->bindParam(4, $Identidad);
			$insertDocumentosEncriptados->bindParam(5, $imgN);
			$insertDocumentosEncriptados->bindParam(6, $imgType);
			$insertDocumentosEncriptados->bindParam(7, $hashFile);
			$insertDocumentosEncriptados->bindParam(8, $datos);


			if($insertDocumentosEncriptados->execute()){

				if(unlink($imgN)){
					return "OK";
				}

				
			}else{
				return die( print_r( sqlsrv_errors(), true) );
			}
		}else if($devolucion == "Devolucion"){
			$insertDocumentosEncriptados=Conexiones::conDD()->prepare("EXEC InsertRequerimientosDigitales ?,?,?,?,?,?,?,?");

			$insertDocumentosEncriptados->bindParam(1, $idContribuyente);
			$insertDocumentosEncriptados->bindParam(2, $idRequisitosTramites);
			$insertDocumentosEncriptados->bindParam(3, $titulo);
			$insertDocumentosEncriptados->bindParam(4, $Identidad);
			$insertDocumentosEncriptados->bindParam(5, $imgN);
			$insertDocumentosEncriptados->bindParam(6, $imgType);
			$insertDocumentosEncriptados->bindParam(7, $hashFile);
			$insertDocumentosEncriptados->bindParam(8, $datos);


			if($insertDocumentosEncriptados->execute()){
				$ActualizarVistoDevolucion=Conexiones::conM105()->prepare("EXEC ActualizarVistoDevolucion $idSolicitud");

				if($ActualizarVistoDevolucion->execute()){
					if(unlink($imgN)){
						return "OK";
					}
				}else{
					return die( print_r( sqlsrv_errors(), true) );
				}
				
				
			}else{
				return die( print_r( sqlsrv_errors(), true) );
			}
		}else{
			return die( print_r( sqlsrv_errors(), true) );
		}
		
	}
	
	public function mdlBajaImg($idDD){

	$BajaImagen=Conexiones::conDD()->prepare("DELETE FROM [MunicipalidadDigital].[dbo].[DocumentosDigitalizados]
      WHERE IdDocumentosDigitalizados= $idDD");

		if($BajaImagen->execute()){
			$bajaEncriptado=Conexiones::conM105()->prepare("DELETE FROM [MunicipalidadDigital].[dbo].[DocumentosEncriptados]
      		WHERE idDocumentosDigitalizados=$idDD");
      		if($bajaEncriptado->execute()){
				return "OK";
			}else{
				return "error";
			}
		}else{
			return "error";
		}
	}	
	public function mdlTramitesImporte(){
			$TramitesImporte=Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[ImporteTramites] ()");

		$TramitesImporte->execute();

		return $TramitesImporte->fetchAll();
	}
	
	public function mdlConsultaExisteTramitesPendientes($idContribuyentes,$Dominio,$idTramites){
			
		$TramitesImporte=Conexiones::conM105()->prepare("EXEC	[dbo].[TramitesPendientes] @idContribuyentes = $idContribuyentes, @idTramites = $idTramites, @Dominio = N'$Dominio'");

		if ($TramitesImporte->execute()) {
			return $TramitesImporte->fetchAll();
		} else {
			return "Error";
		}
		

		
	}

	public function mdlConfirmacionSolicitud($IdRubro,$idContribuyente,$idpat,$Dominio,$cuim,$NroDni,$Contribuyente,$Domicilio,$Marca,$Tipo,$Modelo,$ModeloY2K,$FechaAlta,$Identidad,$IdTipoBaja,$FechaBaja,$out,$NroTipo,$Documentacion,$Observaciones,$Prefijo,$Postfijo,$ConAutorizacion,$NroMotor,$OrigenEmp,$Codigo,$Anulado,$FechaAnula,$Usu_Anula,$Usu_A,$Firmado,$FechaFirma,$UsuFirma,$NroCaso,$DetalleCaso,$tabla,$idTramites){


			//EJECUTA EL SP "darmaximonro" EN EL CASO DE LOS EXPEDIENTES DE SOLICITUD DE TRAMITES

			$PV=20;

			$darmaximonro = Conexiones::conM105()->prepare("EXEC darmaximonro $tabla,$PV");
			$darmaximonro ->execute();
			
			$selectDarmaximonro = Conexiones::conM105()->prepare("SELECT maximonro FROM [municipio].[dbo].[maximos] where tabla = '$tabla'");
			$selectDarmaximonro->execute();

			$B=$selectDarmaximonro->fetchall();

				

			if($B){
					foreach ($B as $key => $resul) {
						$NroExpte =$resul[0];
					}

					$InsertMovimientoLibreDeudaBaja = Conexiones::conM105()->prepare("EXEC InsertMovimientoLibreDeudaBaja ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?");


					$InsertMovimientoLibreDeudaBaja->bindParam(1, $NroTipo);
					$InsertMovimientoLibreDeudaBaja->bindParam(2, $idpat);
					$InsertMovimientoLibreDeudaBaja->bindParam(3, $Dominio);
					$InsertMovimientoLibreDeudaBaja->bindParam(4, $Documentacion);
					$InsertMovimientoLibreDeudaBaja->bindParam(5, $Observaciones);
					$InsertMovimientoLibreDeudaBaja->bindParam(6, $NroExpte);
					$InsertMovimientoLibreDeudaBaja->bindParam(7, $Prefijo);
					$InsertMovimientoLibreDeudaBaja->bindParam(8, $Postfijo);
					$InsertMovimientoLibreDeudaBaja->bindParam(9, $FechaBaja);
					$InsertMovimientoLibreDeudaBaja->bindParam(10, $IdTipoBaja);
					$InsertMovimientoLibreDeudaBaja->bindParam(11, $ConAutorizacion);
					$InsertMovimientoLibreDeudaBaja->bindParam(12, $cuim);
					$InsertMovimientoLibreDeudaBaja->bindParam(13, $NroDni);
					$InsertMovimientoLibreDeudaBaja->bindParam(14, $Contribuyente);
					$InsertMovimientoLibreDeudaBaja->bindParam(15, $Domicilio);
					$InsertMovimientoLibreDeudaBaja->bindParam(16, $Marca);
					$InsertMovimientoLibreDeudaBaja->bindParam(17, $Tipo);
					$InsertMovimientoLibreDeudaBaja->bindParam(18, $Modelo);
					$InsertMovimientoLibreDeudaBaja->bindParam(19, $ModeloY2K);
					$InsertMovimientoLibreDeudaBaja->bindParam(20, $FechaAlta);
					$InsertMovimientoLibreDeudaBaja->bindParam(21, $NroMotor);
					$InsertMovimientoLibreDeudaBaja->bindParam(22, $OrigenEmp);
					$InsertMovimientoLibreDeudaBaja->bindParam(23, $Codigo);
					$InsertMovimientoLibreDeudaBaja->bindParam(24, $Anulado);
					$InsertMovimientoLibreDeudaBaja->bindParam(25, $FechaAnula);
					$InsertMovimientoLibreDeudaBaja->bindParam(26, $Usu_Anula);
					$InsertMovimientoLibreDeudaBaja->bindParam(27, $Usu_A);
					$InsertMovimientoLibreDeudaBaja->bindParam(28, $Firmado);
					$InsertMovimientoLibreDeudaBaja->bindParam(29, $FechaFirma);
					$InsertMovimientoLibreDeudaBaja->bindParam(30, $UsuFirma);
					$InsertMovimientoLibreDeudaBaja->bindParam(31, $NroCaso);
					$InsertMovimientoLibreDeudaBaja->bindParam(32, $DetalleCaso);
					$InsertMovimientoLibreDeudaBaja->bindParam(33, $out, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 200);
					
					if($InsertMovimientoLibreDeudaBaja->execute()){
						
						$selectIdMovimientosSolicitud = Conexiones::conM105()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[selectIdMovimientosSolicitud] ($Identidad)");
						$selectIdMovimientosSolicitud->execute();

						$RtaselectIdMovimientosSolicitud=$selectIdMovimientosSolicitud->fetchAll();

						if(count($RtaselectIdMovimientosSolicitud)>0){
							foreach ($RtaselectIdMovimientosSolicitud as $key => $resul) {
								$IdMovimiento =$resul[0];
							    $Identificador = $resul[1];
							    $Dominio = $resul[2];
							    $Contribuyente=$resul[4];
								$Modelo=$resul[8];
								$Marca=$resul[6];
								$ModeloY2K=$resul[9];
								$NroExpte=$resul[3];
								$TramiteFechaFin='';
							}
						}

						$insertMovimientosPagos = Conexiones::conM105()->prepare("EXEC [dbo].[InsertMovimientosPagos] $Identificador,$IdMovimiento");
						if ($insertMovimientosPagos->execute()) {

							$InsertMovimientosCertificados = Conexiones::conM105()->prepare("EXEC [dbo].[MovimientosCertificados] $IdMovimiento,
							    	$Identificador,'$Dominio',$idTramites");
							if ($InsertMovimientosCertificados->execute()) {

								$InsertTramitesContribuyentes = Conexiones::conM105()->prepare("EXEC InsertTramitesContribuyentes ?,?,?,?,?,?");

								$InsertTramitesContribuyentes->bindParam(1, $idTramites);
								$InsertTramitesContribuyentes->bindParam(2, $idContribuyente);
								$InsertTramitesContribuyentes->bindParam(3, $IdMovimiento);
								$InsertTramitesContribuyentes->bindParam(4, $TramiteFechaFin);
								$InsertTramitesContribuyentes->bindParam(5, $Dominio);
								$InsertTramitesContribuyentes->bindParam(6, $DetalleCaso);

								if ($InsertTramitesContribuyentes->execute()) {

									$RESPUESTA=array('NroExpte' => $NroExpte
													,'IdMovimiento' => $IdMovimiento
													, 'IdTipoBaja'=>$IdTipoBaja);
									return $RESPUESTA;
									$darmaximonro->close();
									$selectDarmaximonro ->close();
								}else{
									return die( print_r( sqlsrv_errors(), true) );
								}

							} else {
								return die( print_r( sqlsrv_errors(), true) );
							}
							

						}else{
							return die( print_r( sqlsrv_errors(), true) );
						}//End $insertMovimientosPagos->execute()
					
					}else{
						return die( print_r( sqlsrv_errors(), true) );
					} // End if($InsertMovimientoLibreDeudaBaja->execute())



				}
	}
}
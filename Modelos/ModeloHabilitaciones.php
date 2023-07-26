<?php
//INCLUIMOS LA CONEXION
include_once('conexiones.php');
/**
 * 
 */
class ModeloHabilitaciones
{

	public function ListarComercios()
	{
		$conT = Conexiones::conDD()->prepare("SELECT * FROM [dbo].[HabilitacionesC_ListarComercios]()");
		$conT->execute();

		$arreglo = array();
		if ($consulta = $conT->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conT->close();
		}
	}

	public function ListarDimensiones()
	{
		$conT = Conexiones::conDD()->prepare("SELECT * FROM [dbo].[HabilitacionesC_ListarDimensiones]()");
		$conT->execute();

		$arreglo = array();
		if ($consulta = $conT->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conT->close();
		}
	}

	public function MdlValidarPartida($nro_partida)
	{	
		$Filtro = Conexiones::conDD()->prepare("EXEC [Catastro].[dbo].[PRC_CATA_parcela_reducido_buscar_por_partida] ?");
		$Filtro->bindParam(1, $nro_partida);
		$Filtro->execute();

		$consulta = $Filtro->fetchAll();
		foreach ($consulta as $fila) {
			$arreglo[] = $fila;
		}
		if (empty($arreglo)) {
			return "sin registros";
		} else {
			return $arreglo;
		}
		
	}

	public function MdlFiltrarMzCasa($manzana, $casa)
	{	
		$Filtro = Conexiones::conDD()->prepare("EXEC [Catastro].[dbo].[PRC_OTROS_parcela_listar_por_mza_casa] ?,?");
		$Filtro->bindParam(1, $manzana);
		$Filtro->bindParam(2, $casa);
		$Filtro->execute();

		$consulta = $Filtro->fetchAll();
		foreach ($consulta as $fila) {
			$arreglo[] = $fila;
		}
		if (empty($arreglo)) {
			return "sin registros";
		} else {
			return $arreglo;
		}
		
	}

	public function MdlFiltrarCalleAltura($calle, $modificador, $altura)
	{	
		$Filtro = Conexiones::conDD()->prepare("EXEC [dbo].[HabComerciales_FiltrarCalleAltura] ?,?,?");
		$Filtro->bindParam(1, $calle);
		$Filtro->bindParam(2, $modificador);
		$Filtro->bindParam(3, $altura);
		$Filtro->execute();

		$consulta = $Filtro->fetchAll();
		foreach ($consulta as $fila) {
			$arreglo[] = $fila;
		}
		if (empty($arreglo)) {
			return "sin registros";
		} else {
			return $arreglo;
		}
		
	}

	public function MdlBuscarBarrio($id_barrio)
	{
		$conM = Conexiones::conSW()->prepare("SELECT municipio..BARRIOS_Indices.DESCRIP FROM municipio..BARRIOS_Indices
		WHERE municipio..BARRIOS_Indices.BARRIO = $id_barrio");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlBuscarCalle($cod_calle)
	{
		$conM = Conexiones::conSW()->prepare("SELECT municipio.dbo.CALLES_Originales.DESCRIP FRom municipio.dbo.CALLES_Originales
		WHERE municipio.dbo.CALLES_Originales.CALLE = $cod_calle");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlValidarRequisito($id_contribuyente, $id_requisito)
	{
		$conM = Conexiones::conDDLocal()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[HabilitacionesC_ValidaRequisito]($id_contribuyente, $id_requisito)");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	static public function mdlMostrarCalles(){
            
		$stmt=Conexiones::conSW()->prepare("SELECT Id, Detalle FROM [MunicipalidadDigital].[dbo].[HabilitacionesC_ListarCalles]()");
		$stmt->execute();

		return $stmt->fetchAll();

		// $stmt->close();
	}

	public function MdlMostrarMisSolicitudes($IdContribuyente)
	{
		$conM = Conexiones::conDDLocal()->prepare("SELECT * FROM [dbo].[HabilitacionesC_SolicitudesContribuyente]('$IdContribuyente')");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlostrarDatosContribuyentes($id_contribuyente)
	{
		$conM = Conexiones::conDD()->prepare("SELECT * FROM [MunicipalidadDigital].[dbo].[ContribuyentesDatos]('$id_contribuyente')");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlVisualizarRequisito($id_requisito)
	{
		$conM = Conexiones::conDDLocal()->prepare("SELECT id, DocumentosEncriptados.idDocumentosDigitalizados,img, HashFile, DocumentosDigitalizados.extension, DocumentosDigitalizados.archivo
		FROM DocumentosEncriptados 
		JOIN DocumentosDigitalizados ON DocumentosDigitalizados.IdDocumentosDigitalizados = DocumentosEncriptados.idDocumentosDigitalizados
		WHERE DocumentosEncriptados.idDocumentosDigitalizados = '$id_requisito'");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlNotificacionHabilitacion($idTramiteContribuyente)
	{
		$conM = Conexiones::conDDLocal()->prepare("SELECT SC.IdSolicitud, 
		SC.id_complejidad, 
		SC.ApeNomRs, 
		SC.NombreFantasia, 
		SC.TipoComercio,
		SC.NroDni, 
		CH.comercio_descripcion, 
		TC.TramiteFechaInicio, 
		TC.TramiteFechaFin,
		TC.TramiteObjeto, 
		TC.TramiteObservacion, 
		TC.idTamites_por_Contribuyentes,
		TE.idEstados,
		TE.Activo,
		Estados.estadosDetalles,
		TC.idContribuyentes
		FROM SolicitudesComerciales SC
		JOIN Comercios_habilitaciones CH ON CH.id_tipo_comercio = SC.TipoComercio 
		JOIN Tramites_por_Contribuyentes TC ON TC.idSolicitud = SC.IdSolicitud
		JOIN TramitesContribuyentes_por_Estados TE 
		ON TE.idTamites_por_Contribuyentes = TC.idTamites_por_Contribuyentes
		JOIN Estados on Estados.idEstados = TE.idEstados
		WHERE TE.idTamites_por_Contribuyentes = '$idTramiteContribuyente' AND TE.Activo = 1");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlMostrarRespuestaSolicitud($id_solicitud)
	{
		$conM = Conexiones::conDDLocal()->prepare("SELECT SC.IdSolicitud, 
		SC.id_complejidad, 
		SC.ApeNomRs, 
		SC.NombreFantasia, 
		SC.TipoComercio,
		SC.NroDni, 
		CH.comercio_descripcion, 
		TC.TramiteFechaInicio, 
		TC.TramiteFechaFin,
		TC.TramiteObjeto, 
		TC.TramiteObservacion, 
		TC.idTamites_por_Contribuyentes,
		TE.idEstados,
		Estados.estadosDetalles,
		TC.idContribuyentes,
		TD.dniFrente,
		TD.dniDorso,
		TD.ContratoLocacion,
		TD.PlanoLocalComercial,
		TD.PlanoPlantaGral,
		TD.ConstanciaAFIP,
		TD.ConstanciaDGR,
		TD.fechaHoraCreacion,
		TD.mensaje
		FROM SolicitudesComerciales SC
		JOIN Comercios_habilitaciones CH ON CH.id_tipo_comercio = SC.TipoComercio 
		JOIN Tramites_por_Contribuyentes TC ON TC.idSolicitud = SC.IdSolicitud
		JOIN TramitesContribuyentes_por_Estados TE 
		ON TE.idTamites_por_Contribuyentes = TC.idTamites_por_Contribuyentes
		JOIN Estados on Estados.idEstados = TE.idEstados
		JOIN TramitesDevolución TD ON TD.idTamites_por_Contribuyentes = TE.idTamites_por_Contribuyentes
		WHERE TD.idTamites_por_Contribuyentes = '$id_solicitud' AND TE.Activo = 1 AND TD.Activo = 1");
		$conM->execute();

		$arreglo = array();
		if ($consulta = $conM->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}


	public function SPA_SolcitudComercial($nro_partida, $id_ocupacion, $ape_nom_rs, $dni, $IdContribuyente, $cuil, $mail, $telefono, $dom_comercial, $dom_fiscal, $dom_real, $nom_fantasia, $superficie, $id_dimensiones, $id_complejidad, $id_tipo_comercio)
	{
		$SPA_Solcitud = Conexiones::conDDLocal()->prepare("EXEC [dbo].[SPA_SolicitudComercial] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?");


		$SPA_Solcitud->bindParam(1, $nro_partida);
		$SPA_Solcitud->bindParam(2, $id_ocupacion);
		$SPA_Solcitud->bindParam(3, $ape_nom_rs);
		$SPA_Solcitud->bindParam(4, $dni);
		$SPA_Solcitud->bindParam(5, $IdContribuyente);
		$SPA_Solcitud->bindParam(6, $cuil);
		$SPA_Solcitud->bindParam(7, $mail);
		$SPA_Solcitud->bindParam(8, $telefono);
		$SPA_Solcitud->bindParam(9, $dom_comercial);
		$SPA_Solcitud->bindParam(10, $dom_fiscal);
		$SPA_Solcitud->bindParam(11, $dom_real);
		$SPA_Solcitud->bindParam(12, $nom_fantasia);
		$SPA_Solcitud->bindParam(13, $superficie);
		$SPA_Solcitud->bindParam(14, $id_dimensiones);
		$SPA_Solcitud->bindParam(15, $id_complejidad);
		$SPA_Solcitud->bindParam(16, $id_tipo_comercio);

		if ($SPA_Solcitud->execute()) {
			return "Solicitud Enviada";
			// $SPA_Solcitud->close();
		} else {
			return "No se pudo Enviar Solicitud";
			// $SPA_Solcitud->close();
			// die( print_r(sqlsrv_errors(), true) );
		}
	}

	public function mdlAltaArchivo($IdContribuyente, $idRequisito, $Descripcion, $nro_partida_inmueble, $Tipo, $hashFile, $imgBase64, $IdTramite, $IdRubro, $Titulo, $DetalleComercio)
	{
		$Requerimiento = Conexiones::conDDLocal()->prepare("EXEC [dbo].[SPA_RequerimientoHabilitacionComercial] ?,?,?,?,?,?,?,?,?,?,?");

		$Requerimiento->bindParam(1, $IdContribuyente);
		$Requerimiento->bindParam(2, $idRequisito);
		$Requerimiento->bindParam(3, $Titulo);
		$Requerimiento->bindParam(4, $nro_partida_inmueble);
		$Requerimiento->bindParam(5, $Descripcion);
		$Requerimiento->bindParam(6, $Tipo);
		$Requerimiento->bindParam(7, $hashFile);
		$Requerimiento->bindParam(8, $imgBase64);
		$Requerimiento->bindParam(9, $IdTramite);
		$Requerimiento->bindParam(10, $IdRubro);
		$Requerimiento->bindParam(11, $DetalleComercio);

		if ($Requerimiento->execute()) {
			if (unlink($Descripcion)) {
				return "archivo guardado";
			} else {
				return "archivos no borrados";
			}
		} else {
			return "error archivos";
			// $Requerimiento->close();
			// die( print_r(sqlsrv_errors(), true) );
		}
	}


	public function MdlActualizarSolicitud($idSolicitudContribuyente)
	{
		$Reenviar = Conexiones::conDDLocal()->prepare("EXEC [dbo].[SPA_ReenviarSolicitud] ?");
		$Reenviar->execute();

		$Reenviar->bindParam(1, $idSolicitudContribuyente);

		if ($Reenviar->execute()) {
			return "Solicitud Reenviada";
		} else {
			return "No se puedo Reenviar la Solicitud";
			// $Requerimiento->close();
			// die( print_r(sqlsrv_errors(), true) );
		}
	}

	public function MdlExtraerInfoRequisito($IdContribuyente, $idRequisito, $partida, $DetalleComercio)
	{
		$infoRequisito = Conexiones::conDDLocal()->prepare("SELECT DE.id IDencriptado
		,DD.IdDocumentosDigitalizados IDdigitalizado
		,DD.idContribuyentes IDcontribuyente
		FROM DocumentosDigitalizados DD join
		DocumentosEncriptados DE ON DD.IdDocumentosDigitalizados=DE.idDocumentosDigitalizados
		WHERE DD.idContribuyentes = $IdContribuyente AND DD.idRequisitosTramites = $idRequisito AND DD.detalle = $partida
		AND DD.nombreFantasia = '$DetalleComercio'");
		$infoRequisito->execute();

		$arreglo = array();
		if ($consulta = $infoRequisito->fetchAll()) {
			foreach ($consulta as $fila) {
				$arreglo[] = $fila;
			}
			return $arreglo;
			// $conM->close();
		}
	}

	public function MdlActualizarRequisito($IDdigitalizado, $IDencriptado, $tipo, $hashFile, $imgBase64, $Descripcion)
	{
		$Requerimiento = Conexiones::conDDLocal()->prepare("EXEC [dbo].[SPM_ActualizarRequisito] ?,?,?,?,?");

		$Requerimiento->bindParam(1, $IDdigitalizado);
		$Requerimiento->bindParam(2, $IDencriptado);
		$Requerimiento->bindParam(3, $tipo);
		$Requerimiento->bindParam(4, $hashFile);
		$Requerimiento->bindParam(5, $imgBase64);

		if ($Requerimiento->execute()) {
			if (unlink($Descripcion)) {
				return "ok";
			} else {
				return "archivos no borrados";
			}
		} else {
			return "error";
			// $Requerimiento->close();
			// die( print_r(sqlsrv_errors(), true) );
		}
	}
}

<?php
    class Conexiones{

    	// CONEXIÓN A LA BASE DE DATOS CON local
		public function conEL(){
			
			$usuario = "AplDigitalizacion";
			$contraseña = 'Zr280534';
			$nombreBaseDeDatos = "Elecciones2021";
			# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
			$rutaServidor = "192.168.0.4";
			try {
			    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
			    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $base_de_datos;
			} catch (Exception $e) {
			   echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error de Sistema!',
									text: 'En estos momentos no podemos procesar su pedido. Por favor intenta más tarde',
									showConfirmButton: true
									}).then((result) => {
									/* Read more about isConfirmed, isDenied below */
									window.location.href = 'cerrarSession.php';
								})
							});
					   </script>";
			}
					
		}
    	// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE MunicipalidadDigital
		public function conDD(){
			
			$usuario = "racosta";
			$contraseña = "38577190Ra";
			$nombreBaseDeDatos = "MunicipalidadDigital";
			# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
			$rutaServidor = "192.168.0.4";
			try {
			    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
			    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $base_de_datos;
			} catch (Exception $e) {
			   echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error de Sistema!',
									text: 'En estos momentos no podemos procesar su pedido. Por favor intenta más tarde',
									showConfirmButton: true
									}).then((result) => {
									/* Read more about isConfirmed, isDenied below */
									window.location.href = 'cerrarSession.php';
								})
							});
					   </script>";
			}
					
		}
		// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE MunicipalidadDigital
		public function conIF(){

			$usuario = 'racosta';
			$contraseña ='38577190Ra';
			$nombreBaseDeDatos = "InfraccionesMunicipales";
			# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
			$rutaServidor = "192.168.0.4";
			try {
			    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
			    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $base_de_datos;
			} catch (Exception $e) {
			   echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error de Sistema!',
									text: 'En estos momentos no podemos procesar su pedido. Por favor intenta más tarde',
									showConfirmButton: true
									}).then((result) => {
									/* Read more about isConfirmed, isDenied below */
									window.location.href = 'cerrarSession.php';
								})
							});
					   </script>";
			
			}
		}
		// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE municipio
		public function conM(){
			$usuario = 'racosta';
			$contraseña ='38577190Ra';
			$nombreBaseDeDatos = "municipio";
			# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
			$rutaServidor = "192.168.0.4";
			try {
			    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
			    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $base_de_datos;
			} catch (Exception $e) {
			   echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error de Sistema!',
									text: 'En estos momentos no podemos procesar su pedido. Por favor intenta más tarde',
									showConfirmButton: true
									}).then((result) => {
									/* Read more about isConfirmed, isDenied below */
									window.location.href = 'cerrarSession.php';
								})
							});
					   </script>";
			
			}
		}
		// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE SeguridadWEB
		public function conSW(){
			
			$usuario = 'AplDigitalizacion';
			$contraseña ='Zr280534';
			$nombreBaseDeDatos = "SeguridadWeb";
			# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
			$rutaServidor = "192.168.0.4";
			try {
			    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
			    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $base_de_datos;
			} catch (Exception $e) {
			   echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error de Sistema!',
									text: 'En estos momentos no podemos procesar su pedido. Por favor intenta más tarde',
									showConfirmButton: true
									}).then((result) => {
									/* Read more about isConfirmed, isDenied below */
									window.location.href = 'cerrarSession.php';
								})
							});
					   </script>";
			
			}
		}
		// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE MunicipalidadDigital
		public function conM105(){

			$usuario = "sa";
			$contraseña = '$uperu$er';
			$nombreBaseDeDatos = "MunicipalidadDigital";
			# Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
			$rutaServidor = "192.168.0.105";
			try {
			    $base_de_datos = new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
			    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $base_de_datos;
			} catch (Exception $e) {
			   echo "<script>	
							jQuery(function(){
								Swal.fire({
									icon: 'error',
									title: '¡Error de Sistema!',
									text: 'En estos momentos no podemos procesar su pedido. Por favor intenta más tarde',
									showConfirmButton: true
									}).then((result) => {
									/* Read more about isConfirmed, isDenied below */
									window.location.href = 'cerrarSession.php';
								})
							});
					   </script>";
			
			}
		}
			// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE MunicipalidadDigita
		public function conDDLocal(){

			$user = 'emilianog';
			$pass = '250398Mc';

			$conDDLocal = new PDO('sqlsrv:Server=192.168.0.4; Database=MunicipalidadDigital;', $user, $pass);
			$conDDLocal -> exec('set names utf8');
			return $conDDLocal;
		}

		// public function conDDLocal(){

		// 	$user = 'sa';
		// 	$pass = '$uperu$er';

		// 	$conDDLocal = new PDO('sqlsrv:Server=192.168.0.105; Database=MunicipalidadDigital;', $user, $pass);
		// 	$conDDLocal -> exec('set names utf8');
		// 	return $conDDLocal;
		// }

		// CONEXIÓN A LA BASE DE DATOS CON FUNCION DE SEGURIDAD WEB
		public function conMLocal(){
			// $user = 'racosta';
			// $pass = '38577190Ra';
			$user = 'sa';
			$pass = '$uperu$er';

			// $conMLocal = new PDO('sqlsrv:Server=localhost; Database=municipio;', $user, $pass);
			$conMLocal = new PDO('sqlsrv:Server=192.168.0.105; Database=SeguridadWEB;', $user, $pass);
			$conMLocal -> exec('set names utf8');
			return $conMLocal;
		}
    }
	// $conexionPrueba=Conexiones::conDD();
	// print_r($conexionPrueba);


	$serverNameP = "server2011";
	$connectionInfoP = array("Database"=>"Parametria", "UID"=>"AplDigitalizacion", "PWD"=>'Zr280534', "CharacterSet"=>"UTF-8");
	$conP = sqlsrv_connect($serverNameP, $connectionInfoP);

	// CONEXIÓN A LA BASE DE DATOS Expedientes
	$serverNameE = "server2011";
	$connectionInfoE = array("Database"=>"Expedientes", "UID"=>"AplDigitalizacion", "PWD"=>'Zr280534', "CharacterSet"=>"UTF-8");
	$conE = sqlsrv_connect($serverNameE, $connectionInfoE);

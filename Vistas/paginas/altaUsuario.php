<?php 
include_once('../../Modelos/conexiones.php');

		if (isset($_POST['passUsuAgre']) && $_POST['nroUsuAgre']){
			$pass= $_POST['passUsuAgre'];
			$id=$_POST['nroUsuAgre'];
		}else{
			$pass= $_POST['passUsuActu'];
			$id=$_POST['nroUsuActu'];	
		}
		$stmt = Conexiones::conEL()->prepare("UPDATE Responsables2021
												   SET Contraseña = '$pass'
											  WHERE id=$id");
		if($stmt->execute()){
			echo 1;
		}else{
			echo 0;
		}	

			
			

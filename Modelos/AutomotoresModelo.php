<?php 
include 'conexiones.php';
// Desactivar toda notificación de error
error_reporting(0);
class ModelosElecciones {
	
	public function mdlListaUsuarios($tabla){
			
		$stmt = Conexiones::conEL()->prepare("SELECT * FROM $tabla");
		
		$stmt->execute();

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null; 
	}
	public function mdlAltaContrasenia(){
		if(isset($_POST['passUsuAgre'])){
			$pass=$_POST['passUsuAgre'];
			$id=$_POST['nroUsuAgre'];	
			$stmt = Conexiones::conEL()->prepare("UPDATE Responsables2021
													   SET Contraseña = $pass
												  WHERE id=$id");

			$stmt->execute();

			echo $stmt -> fetchAll();

			// $stmt->close();

			// $stmt = null; 
		}
	}
	public function mdlIngresoUsu($item,$valor){
			
		$stmt = Conexiones::conEl()->prepare("EXECUTE Elecciones2021.dbo.LOGEO ?,?");

		$stmt->bindParam(1, $item, PDO::PARAM_INT);
		$stmt->bindParam(2, $valor, PDO::PARAM_STR);
		
		$stmt->execute();

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null; 
	}
	public function mdlListaMesasUsuario($id,$idMesa){
		if($idMesa!=NULL){
			
			$stmt = Conexiones::conEl()->prepare("SELECT Escuela, MESA FROM VistaMesasPorEscuelas WHERE MESA=$idMesa");

			$stmt->execute();

			return $stmt -> fetchAll();

			$stmt->close();

			$stmt = null; 
		}else{
			$stmt = Conexiones::conEl()->prepare("SELECT * FROM [Elecciones2021].[dbo].[ListarEscuelaMesaXResponsable] (?)");

			$stmt->bindParam(1, $id, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt -> fetchAll();

			$stmt->close();

			$stmt = null; 
		}	
	}
	public function mdlListaLemaSublemas($id){
			
			$stmt = Conexiones::conEl()->prepare("SELECT * FROM [Elecciones2021].[dbo].[listaSublemaLema] (?)");

			$stmt->bindParam(1, $id, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt -> fetchAll();

			$stmt->close();

			$stmt = null; 
	}
	public function mdlListaPartidos(){
			
			$stmt = Conexiones::conEl()->prepare("SELECT * FROM Partidos WHERE Activo = 1");

			$stmt->execute();

			return $stmt -> fetchAll();

			$stmt->close();

			$stmt = null; 
	}
	public function mdlConsultaMesa($idMesa,$idSublema){
			
			$stmt = Conexiones::conEl()->prepare("SELECT [id]
												      ,[Mesa]
												      ,[idSublema]
												      ,[TotalSublema]
												  FROM [Elecciones2021].[dbo].[TotalSublema]
												  WHERE 
												  [Mesa]=$idMesa AND
												  [idSublema]=$idSublema");
			if($stmt->execute()){
				return $stmt->fetchAll();
			}else{
				return 'error';
			}

			$stmt->close();
	}
	public function mdlConsultaCargaPartidos($idMesa,$idPartidos){
			
			$stmt = Conexiones::conEl()->prepare("SELECT [id]
												      ,[idPartido]
												      ,[idMesa]
												      ,[totalPartido]
												  FROM [Elecciones2021].[dbo].[TotalPartidos]
												  WHERE
												  [idMesa]=$idMesa AND
												  [idPartido]=$idPartidos");
			if($stmt->execute()){
				return $stmt->fetchAll();
			}else{
				return 'error';
			}

			$stmt->close();
	}
	public function mdlAltaForm($idMesa,$idSublema,$cantidad){
			
			$stmt = Conexiones::conEl()->prepare("INSERT INTO TotalSublema
											           ([Mesa]
											           ,[idSublema]
											           ,[TotalSublema])
											     VALUES
											           (?
											           ,?
											           ,?)");

			$stmt->bindParam(1, $idMesa, PDO::PARAM_STR);
			$stmt->bindParam(2, $idSublema, PDO::PARAM_INT);
			$stmt->bindParam(3, $cantidad, PDO::PARAM_INT);

			if($stmt->execute()){
				return 'OK';
			}else{
				return 'error';
			}

			$stmt->close();
	}
	public function mdlAltaFormPartidos($idMesa,$idPartidos,$cantidad){
			
			$stmt = Conexiones::conEl()->prepare("INSERT INTO [Elecciones2021].[dbo].[TotalPartidos]
											           ([idPartido]
											           ,[idMesa]
											           ,[totalPartido])
											    	VALUES
											           (?
											           ,?
											           ,?)");

			$stmt->bindParam(1,$idPartidos, PDO::PARAM_INT);
			$stmt->bindParam(2,$idMesa, PDO::PARAM_INT);
			$stmt->bindParam(3,$cantidad, PDO::PARAM_INT);

			if($stmt->execute()){
				$stmt2 = Conexiones::conEl()->prepare("UPDATE [Elecciones2021].[dbo].[MESAS]
														   SET 
														   	  [VERIFICADO] = 1,
														      [CARGADO] = 1
														 WHERE [Elecciones2021].[dbo].[MESAS].MESA = $idMesa");
				if($stmt2->execute()){
					return 'OK';
				}else{
					return 'error';
				}
			}else{
				return 'error';
			}

			$stmt->close();
	}
	public function mdlActualizarForm($idMesa,$idSublema,$cantidad){
			
			$stmt = Conexiones::conEl()->prepare("UPDATE [Elecciones2021].[dbo].[TotalSublema]
												   SET [TotalSublema] = $cantidad
												WHERE
												[Mesa]= $idMesa AND
												[idSublema]= $idSublema");

			

			if($stmt->execute()){
				$stmt2 = Conexiones::conEl()->prepare("UPDATE [Elecciones2021].[dbo].[MESAS]
														   SET 
														      [VERIFICADO] = 1
														 WHERE [Elecciones2021].[dbo].[MESAS].MESA = $idMesa");
				if($stmt2->execute()){
					return 'OK';
				}else{
					return 'error';
				}
			}else{
				return 'error';
			}

			$stmt->close();
	}
	public function mdlTotalLemas(){
			
			$stmt = Conexiones::conEl()->prepare("SELECT SUM(TotalSublema.TotalSublema)as Total,Sublemas.Sublema,Lemas.id FROM TotalSublema JOIN
													Sublemas on TotalSublema.idSublema = Sublemas.id JOIN
													Lemas on Sublemas.idLema = Lemas.id
													GROUP BY Sublemas.Sublema,Lemas.id");
			$stmt->execute();
			return $stmt->fetchAll();

			$stmt->close();
	}
	public function mdlTotalCandidatos(){
		
		$stmt = Conexiones::conEl()->prepare("SELECT SUM(TotalSublema)as Total,lemas.Lema
											FROM TotalSublema JOIN
											Sublemas on TotalSublema.idSublema = Sublemas.id JOIN
											Lemas on Sublemas.idLema = Lemas.id
											GROUP BY lemas.Lema");
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
	}
	public function mdlTotalPartidos(){
		
		$stmt = Conexiones::conEl()->prepare("SELECT SUM(totalPartido)as Total,Partidos.Partidos
FROM Elecciones2021..TotalPartidos JOIN
Elecciones2021..Partidos on TotalPartidos.idPartido= Partidos.id
WHERE Activo = 1
GROUP BY Partidos.Partidos");
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
	}

}

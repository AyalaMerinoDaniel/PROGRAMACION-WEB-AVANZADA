<?php
	require_once "conexion.php";

	class ModeloUsuarios {


	
		static public function mostrar($elemento, $v) {
			
			if($elemento != null) {

				$s = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE $elemento = :$elemento");
				$s->bindParam(":".$elemento, $v, PDO::PARAM_STR);
				$s->execute();
				return $s->fetch();
			}
			else {
				$s = Conexion::conectar()->prepare("SELECT * FROM usuarios");
				$s->execute();
				return $s->fetchAll();
			}
			$s->close();
			$s = null;
		}
		static public function registrarUsuario($datos) {
			$s = Conexion::conectar()->prepare("INSERT INTO usuarios (rol, nombre, usuario, contra, foto) VALUES (:rol, :nombre, :usuario, :contra, :foto)");
			$s->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
			$s->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$s->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$s->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$s->bindParam(":contra", $datos["contra"], PDO::PARAM_STR);
			if( $s->execute() ) {
				return "0k";
			}
			else {
				return "error";
			}
			$s->close();
			$s = null;
		}
		
	}
?>
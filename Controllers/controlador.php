<?php
require_once "../Models/usuario.php";

	class Usuarios{
		static public function ingreso() {
			if(isset($_POST['ingUsuario'])) {
				if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingContra']) ) {
					$tabla = "usuarios";
					$e = "usuario";
					$val = $_POST['ingUsuario'];
					$r = ModeloUsuarios::mostrar($e, $val);
					if( $r["contra"] == $_POST['ingContra']) {
						$_SESSION['ingreso'] = '0k';
						echo '<script>
							window.location = "usuario.php";
							</script>';
						}
                
						else {
							echo '<br><div class="alert alert-danger">El usuario o contraseña no son correctos </div>';
						}
                }
			}
		}

		static public function ctrUsuarios($item, $valor) {
			$rtn = ModeloUsuarios::mostrar($item, $valor);
			return $rtn;
		}	
		
		public function ctrUsuario() {
			if(isset($_POST['usuario'])) {
			if(preg_match('/^[a-zA-Z ]+$/', $_POST["nombre"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["usuario"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["contra"])) {
				if(isset($_FILES["foto"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["foto"]["tmp_name"]);
					$n_ancho = 500;
					$n_alto = 500;
					$directorio = "Views/imgs/usuarios/". $_POST["usuario"];
					mkdir($directorio, 0744);
					if($_FILES["foto"]["type"] == "image/jpeg") {
					   $a = mt_rand(100, 999);
					   $ruta = "Views/imgs/usuarios/". $_POST["usuario"]. "/".$a.".jpg";
					   $origen = imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);
					   $dst = imagecreatetruecolor($n_ancho, $n_alto);
					   imagecopyresized($dst, $origen, 0, 0, 0, 0, $n_ancho, $n_alto, $ancho, $alto);
					   imagejpeg($dst, $ruta);
					}
					

				}
				$enc = crypt($_POST["contra"], password_hash("admin", PASSWORD_BCRYPT));
				$datos = array("nombre" => $_POST["nombre"],
						"usuario" => $_POST["usuario"],
						"contra" => $enc,
					 	"rol" => $_POST["rol"],
						"foto" => $ruta);

				$r = ModeloUsuarios::registrarUsuario($datos);
				if($r == "0k") {
					echo '<script>
					Swal.fire({
						icon: "success",
						title: "El usuario se registro correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result)=>{
						if(result.value) {
							window.location = "usuario";
						}
					});
					</script>';

				}
			}}

		}
	}
<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Views/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="Views/dist/css/adminlte.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


	<!-- jQuery -->
	<script src="Views/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="Views/dist/js/adminlte.min.js"></script>
  <script src="Views/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="Views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="Views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="Views/plugins/sweetalert2/sweetalert2.all.js"></script>
     
</head>

<?php
		
	if(isset($_SESSION["ingreso"]) && $_SESSION['ingreso'] == '0k') {
		echo '<body class="hold-transition sidebar-mini">';	
		if(isset($_GET['ruta'])) {
			if($_GET['ruta'] == 'inicial' ||
			$_GET['ruta'] == 'usuario')
			{
				include "encabezados.php";
				include "menu.php";

				echo '<div class="content-wrapper">';
				include "Views/".$_GET['ruta'].".php";
				echo '</div>';
			}
			else if ($_GET["ruta"] == "salir")
				include "Views/salir.php";
		}
		else {
			include "Views/404.html";
		}
	}
	else {
		//include "Vistas/inicio.php";
		echo '<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">';
		include "Views/login.php";
	}

?>

<script src="Views/js/usuarios.js"></script>
</body>
</html>


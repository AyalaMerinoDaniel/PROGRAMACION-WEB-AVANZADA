<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 <?php 
    $e = new PDO("mysql:host=localhost; dbname=agenda", "root", "");
    $e -> exec("set names utf8");
    //$e -> fetch();

    $users = $e->query("SELECT * from usuarios where usuario = 'temo'");
    
    echo "<script>console.log('Console: " . $users["usuario"] . "' );</script>";
    echo "hola";
    
 ?>
 </body>
</html>
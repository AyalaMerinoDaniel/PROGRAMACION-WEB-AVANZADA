<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/administrador.controlador.php";
require_once "modelos/administrador.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();

?>
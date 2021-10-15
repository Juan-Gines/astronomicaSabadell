<?php

if (!isset($_SESSION["datosCorrectos"])){  
  $_SESSION["datosCorrectos"]=false;
}
require_once "controlador/datos.php";
require_once "controlador/compra.php";

$formDatos=new Datos();
$formCarrito=new Compra();
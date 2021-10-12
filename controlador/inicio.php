<?php

if (!isset($_SESSION["datosCorrectos"])){  
  $_SESSION["datosCorrectos"]=false;
}
require_once "controlador/datos.php";

$formDatos=new Datos();
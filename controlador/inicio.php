<?php

if (!isset($_SESSION["datosCorrectos"])){  
  $_SESSION["datosCorrectos"]=false;
  $_SESSION["COelegido"]=false;
  $_SESSION["compraErronea"]=false;
  $_SESSION["compraFinalizada"]=false;
  if(isset($_SERVER["HTTP_REFERER"])&&strpos($_SERVER["HTTP_REFERER"],'/ca/')){
    $_SESSION["COidioma"]=3;
  }else{
    $_SESSION["COidioma"]=1;
  }
}
require_once "controlador/datos.php";
require_once "controlador/compra.php";
require_once "controlador/pago.php";
require_once "controlador/resultado.php";

$formDatos=new Datos;
$formCarrito=new Compra;
$formPago=new Pago;
$resultado=new Resultado;
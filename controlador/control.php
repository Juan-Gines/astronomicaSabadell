<?php

require_once "inicio.php";

if(!$_SESSION["datosCorrectos"]){
  $formDatos->formDatos();
}elseif(isset($_GET["Ds_Signature"])&&isset($_GET["Ds_MerchantParameters"])&&isset($_GET["Ds_SignatureVersion"])){
  $resultado->validar();
}elseif(isset($_GET["cerrar"])){
  $formDatos->cerrar();
}elseif(isset($_GET["recompra"])){
  $formDatos->recompra();
}elseif($_SESSION["compraFinalizada"]){
  $resultado->compraok();
}elseif($_SESSION["compraErronea"]){
  $resultado->comprako();
}elseif($_SESSION["COelegido"]){
  $formPago->formPago();
}else{
  $formCarrito->carrito();
}
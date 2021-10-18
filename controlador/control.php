<?php

require_once "inicio.php";

if(!$_SESSION["datosCorrectos"]){
  $formDatos->formDatos();
}elseif($_SESSION["COelegido"]){
  $formPago->formPago();
}else{
  $formCarrito->carrito();
}
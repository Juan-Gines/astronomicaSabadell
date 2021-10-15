<?php
require_once "vistas/carrito.php";
require_once "librerias/ValidarInputs.php";
class Compra{
  

  function carrito(){
    
    if($_SERVER["REQUEST_METHOD"]=="POST"&&$_SESSION["idrand"]==$_POST["idrand"]){
      ValidarInputs::limpio_alfanum($_POST["nombre"],"Nombre");
      ValidarInputs::valido() ? $datos["curNombre"]=ValidarInputs::msj() : $datos["errcurNombre"]=ValidarInputs::msj();
      ValidarInputs::limpio_alfanum($_POST["apellidos"],"Apellidos");
      ValidarInputs::valido() ? $datos["curApellidos"]=ValidarInputs::msj() : $datos["errcurApellidos"]=ValidarInputs::msj();
      ValidarInputs::limpio_telefono($_POST["telefono"]);
      ValidarInputs::no_requerido($_POST["telefono"]);
      ValidarInputs::valido() ? $datos["curTelefono"]=ValidarInputs::msj() : $datos["errcurTelefono"]=ValidarInputs::msj();
      ValidarInputs::limpio_email($_POST["email"]);
      ValidarInputs::valido() ? $datos["curEmail"]=ValidarInputs::msj() : $datos["errcurEmail"]=ValidarInputs::msj();
      ValidarInputs::limpio_email($_POST["numSocio"]);
      ValidarInputs::no_requerido($_POST["numSocio"]);
      ValidarInputs::valido() ? $datos["numSocio"]=ValidarInputs::msj() : $datos["errnumSocio"]=ValidarInputs::msj();
      $error=false;
      foreach($datos as $key=>$dato){
        if(substr($key,0,3)=="err"){
          $error=true;
          break;
        }
      }
      if(!$error){
        foreach($datos as $key=>$valor){
          $_SESSION["user"][substr($key,3)]=$valor;
        }
        unset($datos);
        $_SESSION["datosCorrectos"]=true;
        header("Location:{$_SERVER["PHP_SELF"]}");
        exit;
      }else{
        echo "formulario incorrecto";
      }
    }
    isset($datos)?Carrito::form($datos):Carrito::form();
  }
}
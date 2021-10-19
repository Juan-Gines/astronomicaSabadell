<?php
require_once "vistas/carrito.php";
require_once "librerias/ValidarInputs.php";
require_once "models/cursos.php";

class Compra {
  

  function carrito(){    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
      if(!empty($_GET)){
        $cursos=unserialize($_SESSION["cursosOnline"]);        
        foreach($cursos as $curso){         
          if(key_exists($curso->getId(),$_GET)){
            $_SESSION["COelegido"]=true;
            $_SESSION["cursoElegido"]=serialize($curso);            
            $_SESSION["importe"]=!empty($_SESSION["user"]["Socio"])? $curso->getImporteSocio(): $curso->getImporte();
            header("location:{$_SERVER["PHP_SELF"]}");
            exit;
          }
        }
      }
      Carrito::form();      
    }
    
  }
}
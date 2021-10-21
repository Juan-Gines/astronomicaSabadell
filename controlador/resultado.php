<?php
include_once "config/configuracion.php";
include_once "redsys/apiRedsys.php";
require_once "vistas/compraok.php";
require_once "vistas/comprako.php";
require_once "models/cursos.php";

class Resultado extends Configuracion{

  function validar(){
    $objredsys=new RedsysAPI;
    $version=$_GET["Ds_SignatureVersion"];
    $parametros=$_GET["Ds_MerchantParameters"];
    $signature=$_GET["Ds_Signature"];
    $kc = self::KC;
    $decodec = $objredsys->decodeMerchantParameters($parametros);
    $firma = $objredsys->createMerchantSignatureNotif($kc, $parametros);
    $_SESSION["resp"]=$respuesta=json_decode($decodec,true);
    $curso=unserialize($_SESSION["cursoElegido"]);    
    if ($firma === $signature) {      
      if($respuesta["Ds_Response"]>=0&&$respuesta["Ds_Response"]<100){

        //mail para el comercio
        $para="juangalenta@hotmail.com";
        $titulo="Nuevo curso pagado";
        $msj="Datos comprador:\r\n\r\n";
        foreach($_SESSION["user"] as $campo=>$valor){
          $msj.=$campo.": ".$valor."\r\n";
        }
        $msj.="\r\nDatos Curso:\r\n\r\n".
            "Id curso: ".$curso->getId()."\r\n".
            "Nombre: ".$curso->getNombre()."\r\n".       
            "Precio: ".$_SESSION["importe"]."€\r\n".       
            $curso->getDescripcion()."\r\n";
        $msj.="\r\nDatos compra:\r\n\r\n";
        foreach($respuesta as $campo=>$valor){
          if($campo=="Ds_Amount"){
            $msj.="Importe: ".substr($valor,0,strlen($valor)-2)."€\r\n";
            continue;
          }
          $msj.=substr($campo,3).": ".urldecode($valor)."\r\n";
        }        
        $cabeceras="From: juangalenta@gmail.com";
        mail($para,$titulo,$msj,$cabeceras);       

        //mail para el cliente
        $para=$_SESSION["user"]["Email"];
        $titulo="Curso online Astronómica de Sabadell";
        $msj="Datos comprador:\r\n\r\n";
        foreach($_SESSION["user"] as $campo=>$valor){
          $msj.=$campo.": ".$valor."\r\n";
        }
        $msj.="\r\nDatos Curso:\r\n\r\n".
            "Id producto: ".$curso->getId()."\r\n".
            "Nombre: ".$curso->getNombre()."\r\n".       
            "Precio: ".$_SESSION["importe"]."€\r\n".       
            $curso->getDescripcion()."\r\n";
        $msj.="\r\n"."Datos compra:\r\n\r\n".        
            "Fecha: ".urldecode($respuesta["Ds_Date"])."\r\n".
            "Hora: ".urldecode($respuesta["Ds_Hour"])."\r\n".       
            "PagoSeguro: Si\r\n".         
            "Importe: ".substr($respuesta["Ds_Amount"],0,strlen($respuesta["Ds_Amount"])-2)."€\r\n".
            "Id orden: ".$respuesta["Ds_Order"]."\r\n".
            "Código autorización: ".$respuesta["Ds_AuthorisationCode"]."\r\n".
            "Beneficiario: Astronómica de Sabadell\r\n\r\n".
            "En un plazo máximo de 24 horas laborales recibira el correo con los datos de conexión"."\r\n\r\n".
            "Contacto: secretaria@astrosabadell.org"."\r\n\r\n".
            "Teléfono:  93.725.53.73"."\r\n\r\n".
            "Gracias por su compra";
        $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";        
        mail($para,$titulo,$msj,$cabeceras);
        
        $_SESSION["compraFinalizada"]=true;
        header("Location:{$_SERVER["PHP_SELF"]}");
        exit;        
      }else{
        //mail intento fallido de compra para el comercio
        $para="juangalenta@hotmail.com";
        $titulo="Intento fallido de comprar un curso";
        $msj="Datos comprador:\r\n\r\n";
        foreach($_SESSION["user"] as $campo=>$valor){
          $msj.=$campo.": ".$valor."\r\n";
        }
        $msj.="\r\nDatos Curso:\r\n\r\n".
            "Id producto: ".$curso->getId()."\r\n".
            "Nombre: ".$curso->getNombre()."\r\n".       
            "Precio: ".$_SESSION["importe"]."€\r\n".       
            $curso->getDescripcion()."\r\n";
        $msj.="\r\nDatos compra:\r\n\r\n";
        foreach($respuesta as $campo=>$valor){
          if($campo=="Ds_Amount"){
            $msj.="Importe: ".substr($valor,0,strlen($valor)-2)."€\r\n";
            continue;
          }
          $msj.=substr($campo,3).": ".urldecode($valor)."\r\n";
        }        
        $cabeceras="From: juangalenta@gmail.com";
        mail($para,$titulo,$msj,$cabeceras);

        $_SESSION["compraErronea"]=true;
        header("Location:{$_SERVER["PHP_SELF"]}");
        exit;
      }      
    } else {
      //mail intento fallido de compra para el comercio
        $para="juangalenta@hotmail.com";
        $titulo="Intento fallido de comprar un curso";
        $msj="Datos comprador:\r\n\r\n";
        foreach($_SESSION["user"] as $campo=>$valor){
          $msj.=$campo.": ".$valor."\r\n";
        }
        $msj.="\r\nDatos compra:\r\n\r\n";
        foreach($respuesta as $campo=>$valor){
          if($campo=="Ds_Amount"){
            $msj.="Importe: ".substr($valor,0,strlen($valor)-2)."€\r\n";
            continue;
          }
          $msj.=substr($campo,3).": ".urldecode($valor)."\r\n";
        }        
        $cabeceras="From: juangalenta@gmail.com";
        mail($para,$titulo,$msj,$cabeceras);

        $_SESSION["compraErronea"]=true;
        header("Location:{$_SERVER["PHP_SELF"]}");
        exit;
    }  
  }
  
  function compraok(){
    Compraok::pagoRealizado();
  }
  function comprako(){
    Comprako::pagoFallido();
  }
}
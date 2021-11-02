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
    $kc = $this->kc;
    $decodec = $objredsys->decodeMerchantParameters($parametros);
    $firma = $objredsys->createMerchantSignatureNotif($kc, $parametros);
    $_SESSION["resp"]=$respuesta=json_decode($decodec,true);
    $curso=unserialize($_SESSION["cursoElegido"]);
    $joven= $_SESSION["user"]["Joven"] ? "Si": "No";    
    if ($firma === $signature) {      
      if($respuesta["Ds_Response"]>=0&&$respuesta["Ds_Response"]<100){

        if ($_SESSION["COidioma"]==1) {

            //en español
            //mail para el comercio
            $para="juangalenta@hotmail.com";
            $titulo="Nuevo curso pagado";

            $msj="PAGO REALIZADO, PENDIENTE DE ALTA EN EL CURSO\r\n\r\n".
            "Datos comprador:\r\n\r\n".
            "Nombre: ".$_SESSION["user"]["Nombre"]."\r\n".
            "Apellidos: ".$_SESSION["user"]["Apellidos"]."\r\n".
            "Teléfono: ".$_SESSION["user"]["Telefono"]."\r\n".
            "Email: ".$_SESSION["user"]["Email"]."\r\n".
            "Núm. Socio: ".$_SESSION["user"]["Email"]."\r\n".
            "Socio joven: ".$joven."\r\n";

            $msj.="\r\nDatos Curso:\r\n\r\n".
            "Id curso: ".$curso->getId()."\r\n".
            "Nombre: ".$curso->getNombre()."\r\n".
            "Precio: ".$_SESSION["importe"]."€\r\n".
            $curso->getDescripcion()."\r\n";

            $msj.="\r\nDatos compra:\r\n\r\n";
            foreach ($respuesta as $campo=>$valor) {
                if ($campo=="Ds_Amount") {
                    $msj.="Importe: ".substr($valor, 0, strlen($valor)-2)."€\r\n";
                    continue;
                }
                $msj.=substr($campo, 3).": ".urldecode($valor)."\r\n";
            }
            $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";
            mail($para, $titulo, $msj, $cabeceras);

            //mail para el cliente
            $para=$_SESSION["user"]["Email"];
            $titulo="Curso online Astronómica de Sabadell";

            $msj="Datos comprador:\r\n\r\n".
            "Nombre: ".$_SESSION["user"]["Nombre"]."\r\n".
            "Apellidos: ".$_SESSION["user"]["Apellidos"]."\r\n".
            "Teléfono: ".$_SESSION["user"]["Telefono"]."\r\n".
            "Email: ".$_SESSION["user"]["Email"]."\r\n".
            "Núm. Socio: ".$_SESSION["user"]["Email"]."\r\n".
            "Socio joven: ".$joven."\r\n";

            $msj.="\r\nDatos Curso:\r\n\r\n".
            "Id producto: ".$curso->getId()."\r\n".
            "Nombre: ".$curso->getNombre()."\r\n".
            "Precio: ".$_SESSION["importe"]."€\r\n".
            $curso->getDescripcion()."\r\n";

            $msj.="\r\n"."Datos compra:\r\n\r\n".
            "Fecha: ".urldecode($respuesta["Ds_Date"])."\r\n".
            "Hora: ".urldecode($respuesta["Ds_Hour"])."\r\n".
            "PagoSeguro: Si\r\n".
            "Importe: ".substr($respuesta["Ds_Amount"], 0, strlen($respuesta["Ds_Amount"])-2)."€\r\n".
            "Id orden: ".$respuesta["Ds_Order"]."\r\n".
            "Código autorización: ".$respuesta["Ds_AuthorisationCode"]."\r\n".
            "Beneficiario: Astronómica de Sabadell\r\n\r\n".
            "En un plazo máximo de 24 horas laborales recibira el correo con los datos de conexión"."\r\n\r\n".
            "Contacto: secretaria@astrosabadell.org"."\r\n\r\n".
            "Teléfono:  93.725.53.73"."\r\n\r\n".
            "Gracias por su compra";
            $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";
            mail($para, $titulo, $msj, $cabeceras);
        
            $_SESSION["compraFinalizada"]=true;
            header("Location:{$_SERVER["PHP_SELF"]}");
            exit;
        }else{

            //en Català
            //mail para el comercio
            $para="juangalenta@hotmail.com";
            $titulo="Nou curs pagat";

            $msj="PAGAMENT REALITZAT, PENDENT D'ALTA AL CURS\r\n\r\n".
            "Dades comprador:\r\n\r\n".
            "Nom: ".$_SESSION["user"]["Nombre"]."\r\n".
            "Cognom: ".$_SESSION["user"]["Apellidos"]."\r\n".
            "Telèfon: ".$_SESSION["user"]["Telefono"]."\r\n".
            "Email: ".$_SESSION["user"]["Email"]."\r\n".
            "Núm. Soci: ".$_SESSION["user"]["Email"]."\r\n".
            "Soci jove: ".$joven."\r\n";
            
            $msj.="\r\nDades Curs:\r\n\r\n".
            "Id curs: ".$curso->getId()."\r\n".
            "Nom: ".$curso->getNombreCa()."\r\n".
            "Preu: ".$_SESSION["importe"]."€\r\n".
            $curso->getDescripcionCa()."\r\n";

            $msj.="\r\nDades compra:\r\n\r\n";
            foreach ($respuesta as $campo=>$valor) {
                if ($campo=="Ds_Amount") {
                    $msj.="Importe: ".substr($valor, 0, strlen($valor)-2)."€\r\n";
                    continue;
                }
                $msj.=substr($campo, 3).": ".urldecode($valor)."\r\n";
            }
            $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";
            mail($para, $titulo, $msj, $cabeceras);

            //mail para el cliente català
            $para=$_SESSION["user"]["Email"];
            $titulo="Curs online L'astronòmica de Sabadell";

            $msj="Dades comprador:\r\n\r\n".
            "Nom: ".$_SESSION["user"]["Nombre"]."\r\n".
            "Cognom: ".$_SESSION["user"]["Apellidos"]."\r\n".
            "Telèfon: ".$_SESSION["user"]["Telefono"]."\r\n".
            "Email: ".$_SESSION["user"]["Email"]."\r\n".
            "Núm. Soci: ".$_SESSION["user"]["Email"]."\r\n".
            "Soci jove: ".$joven."\r\n";

            $msj.="\r\nDades Curs:\r\n\r\n".
            "Id producte: ".$curso->getId()."\r\n".
            "Nom: ".$curso->getNombreCa()."\r\n".
            "Preu: ".$_SESSION["importe"]."€\r\n".
            $curso->getDescripcionCa()."\r\n";

            $msj.="\r\n"."Dades compra:\r\n\r\n".
            "Data: ".urldecode($respuesta["Ds_Date"])."\r\n".
            "Hora: ".urldecode($respuesta["Ds_Hour"])."\r\n".
            "Pagament segur: Si\r\n".
            "Import: ".substr($respuesta["Ds_Amount"], 0, strlen($respuesta["Ds_Amount"])-2)."€\r\n".
            "Id ordre: ".$respuesta["Ds_Order"]."\r\n".
            "Codi autorització: ".$respuesta["Ds_AuthorisationCode"]."\r\n".
            "Beneficiari: L'Astronòmica de Sabadell\r\n\r\n".
            "En un termini màxim de 24 hores laborals rebrà el correu amb les dades de connexió"."\r\n\r\n".
            "Contacte: secretaria@astrosabadell.org"."\r\n\r\n".
            "Telèfon:  93.725.53.73"."\r\n\r\n".
            "Gracies per la seva compra";
            $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";
            mail($para, $titulo, $msj, $cabeceras);
        
            $_SESSION["compraFinalizada"]=true;
            header("Location:{$_SERVER["PHP_SELF"]}");
            exit;
        }        
      }else{
        
        //mail intento fallido de compra para el comercio

        $para="juangalenta@hotmail.com";
        $titulo="Intento fallido de comprar un curso";

        $msj="NO SE COMPLETÓ EL PAGO. NO REGISTRE ESTE CLIENTE EN EL CURSO.\r\n\r\n".
            "Datos comprador:\r\n\r\n".
            "Nombre: ".$_SESSION["user"]["Nombre"]."\r\n".
            "Apellidos: ".$_SESSION["user"]["Apellidos"]."\r\n".
            "Teléfono: ".$_SESSION["user"]["Telefono"]."\r\n".
            "Email: ".$_SESSION["user"]["Email"]."\r\n".
            "Núm. Socio: ".$_SESSION["user"]["Email"]."\r\n".
            "Socio joven: ".$joven."\r\n";

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
        $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";
            mail($para, $titulo, $msj, $cabeceras);

        $_SESSION["compraErronea"]=true;
        header("Location:{$_SERVER["PHP_SELF"]}");
        exit;
      }      
    } else {
      
      //mail intento fallido de compra para el comercio

        $para="juangalenta@hotmail.com";
        $titulo="Intento fallido de comprar un curso";

        $msj="NO SE COMPLETÓ EL PAGO. NO REGISTRE ESTE CLIENTE EN EL CURSO.\r\n\r\n".
            "Datos comprador:\r\n\r\n".
            "Nombre: ".$_SESSION["user"]["Nombre"]."\r\n".
            "Apellidos: ".$_SESSION["user"]["Apellidos"]."\r\n".
            "Teléfono: ".$_SESSION["user"]["Telefono"]."\r\n".
            "Email: ".$_SESSION["user"]["Email"]."\r\n".
            "Núm. Socio: ".$_SESSION["user"]["Email"]."\r\n".
            "Socio joven: ".$joven."\r\n";

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
        $cabeceras="From: juangalenta@gmail.com"."\r\n".
                'Content-Type: text/plain; charset=utf-8' . "\r\n";
            mail($para, $titulo, $msj, $cabeceras);

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
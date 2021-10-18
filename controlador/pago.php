<?php
require_once "vistas/eligePago.php";
require_once "librerias/ValidarInputs.php";
require_once "models/cursos.php";
class Pago{
  

  function formPago(){    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["submitPago"])){
        $factura=$_SESSION["idpago"]=time().mt_rand(100,999);
        $curso=unserialize($_SESSION["cursoElegido"]);
        $importe=$_SESSION["importe"];
        switch ($_POST["tipoPago"]) {
          case 'credito':
            $parametros["DS_MERCHANT_AMOUNT"]=$importe.'00';
            $parametros["DS_MERCHANT_CURRENCY"]='978';
            $parametros["DS_MERCHANT_MERCHANTCODE"]='999008881';
            $parametros["DS_MERCHANT_MERCHANTURL"]= "http://www.prueba.com/urlNotificacion.php";
            $parametros["DS_MERCHANT_ORDER"]= $factura;
            $parametros["DS_MERCHANT_TERMINAL"]= "1";
            $parametros["DS_MERCHANT_TRANSACTIONTYPE"]= "0";
            $parametros["DS_MERCHANT_URLKO"]= "http://www.prueba.com/urlKO.php";
            $parametros["DS_MERCHANT_URLOK"]= "http://www.prueba.com/urlOK.php";
            $jsonParametros=json_encode($parametros);
            $Ds_MerchantParameters=base64_encode($jsonParametros);
            $Ds_SignatureVersion="HMAC_SHA256_V1";
        }
        
      }
      EligePago::formPago();      
    }
    
  }
}
<?php
require_once "vistas/eligePago.php";
require_once "librerias/ValidarInputs.php";
require_once "models/cursos.php";
include_once "config/configuracion.php";
include_once "redsys/apiRedsys.php";
class Pago extends Configuracion{  

  function formPago(){
    $objPago=new RedsysAPI;
    $factura=$_SESSION["idpago"]=time();    
    $importe=$_SESSION["importe"];
    $objPago->setParameter("DS_MERCHANT_AMOUNT",$importe.'00');
    $objPago->setParameter("DS_MERCHANT_CURRENCY", self::MONEDA);
    $objPago->setParameter("DS_MERCHANT_MERCHANTCODE",self::CODIGO);
    $objPago->setParameter("DS_MERCHANT_MERCHANTURL", self::URL);
    $objPago->setParameter("DS_MERCHANT_ORDER", $factura);
    $objPago->setParameter("DS_MERCHANT_TERMINAL", self::TERMINAL);
    $objPago->setParameter("DS_MERCHANT_TRANSACTIONTYPE", self::TIPO);
    $objPago->setParameter("DS_MERCHANT_URLKO", self::KO);
    $objPago->setParameter("DS_MERCHANT_MERCHANTNAME", self::NAME);
    $objPago->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", self::DESCRIPCION);
    $objPago->setParameter("DS_MERCHANT_URLOK", self::OK);
    $params = $objPago->createMerchantParameters();
    $signature = $objPago->createMerchantSignature(self::KC);            
    $version=self::VERSION;    
    $datos=["Ds_MerchantParameters"=>$params,"Ds_SignatureVersion"=>$version,"Ds_Signature"=>$signature];
    EligePago::formPago($datos);   
  }
}
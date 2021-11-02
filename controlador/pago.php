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
    if($_SESSION["COidioma"]==3){
      $name=$this->nameCa;
      $descripcion=$this->descripcionCa;
    }else{
      $name=$this->name;
      $descripcion=$this->descripcion;
    }
    $objPago->setParameter("DS_MERCHANT_AMOUNT",$importe.'00');
    $objPago->setParameter("DS_MERCHANT_CURRENCY", $this->moneda);
    $objPago->setParameter("DS_MERCHANT_MERCHANTCODE",$this->codigo);
    $objPago->setParameter("DS_MERCHANT_MERCHANTURL", $this->url);
    $objPago->setParameter("DS_MERCHANT_ORDER", $factura);
    $objPago->setParameter("DS_MERCHANT_CONSUMERLANGUAGE", $_SESSION["COidioma"]);
    $objPago->setParameter("DS_MERCHANT_TERMINAL", $this->terminal);
    $objPago->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $this->tipo);
    $objPago->setParameter("DS_MERCHANT_URLKO", $this->ko);
    $objPago->setParameter("DS_MERCHANT_MERCHANTNAME", $name);
    $objPago->setParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $descripcion);
    $objPago->setParameter("DS_MERCHANT_URLOK", $this->ok);
    $params = $objPago->createMerchantParameters();
    $signature = $objPago->createMerchantSignature($this->kc);            
    $version=$this->version;    
    $datos=["Ds_MerchantParameters"=>$params,"Ds_SignatureVersion"=>$version,"Ds_Signature"=>$signature];
    EligePago::formPago($datos);   
  }
}
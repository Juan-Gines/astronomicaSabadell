<?php
class Cursos{

  private $id;
  private $nombre;
  private $descripcion;
  private $importe;
  private $importeSocio;
  private $imagen;
  private $nombreCa;
  private $descripcionCa;
  private $imagenCa;  
  private $importeJoven;  
  
  function __construct($id,$nombre,$descripcion,$importe,$importeSocio,$imagen,$nombreCa,$descripcionCa,$imagenCa,$importeJoven=false) {
    $this->id=$id;
    $this->nombre=$nombre;
    $this->descripcion=$descripcion;
    $this->importe=$importe;
    $this->importeSocio=$importeSocio;
    $this->imagen=$imagen;
    $this->nombreCa=$nombreCa;
    $this->descripcionCa=$descripcionCa;
    $this->imagenCa=$imagenCa;
    $this->importeJoven=$importeJoven;
  }

  function getId(){
    return $this->id;
  }

  function getNombre(){
    return $this->nombre;
  }

  function getDescripcion(){
    return $this->descripcion;
  }

  function getImporte(){
    return $this->importe;
  }

  function getImporteSocio(){
    return $this->importeSocio;
  }

  function getImagen(){
    return $this->imagen;
  }
  
  function getNombreCa(){
    return $this->nombreCa;
  }

  function getDescripcionCa(){
    return $this->descripcionCa;
  }

  function getImagenCa(){
    return $this->imagenCa;
  }

  function getImporteJoven(){
    return $this->importeJoven;
  }
}
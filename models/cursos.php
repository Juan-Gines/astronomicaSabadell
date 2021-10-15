<?php
class Cursos{

  private $id;
  private $nombre;
  private $descripcion;
  private $importe;
  private $importeSocio;
  private $imagen;  
  
  function __construct($id,$nombre,$descripcion,$importe,$importeSocio,$imagen) {
    $this->id=$id;
    $this->nombre=$nombre;
    $this->descripcion=$descripcion;
    $this->importe=$importe;
    $this->importeSocio=$importeSocio;
    $this->imagen=$imagen;

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
    
}
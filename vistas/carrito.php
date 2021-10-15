<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
class Carrito{

  static function form($datos=[]){
    Cabecera::head();
    $idrand=mt_rand();
    $_SESSION["idrand"]=$idrand;
    ?>
      <h2>Cursos Disponibles</h2> 
      <div class="container-row">     
       <h3>Elige los cursos online que desees - paso 2</h3>
       <button class="button"><img src="imagenes/carrito.png" alt="carrito"></button>
      </div>
      <div class="separador"></div>
      <main>
        <ul>
          <li>
            <h4>nombre del curso</h4>
            <img src="imagenes/COCosmologia.png" alt="imagen presentación del curso de cosmologia">
            <p>Descripción</p>
            <button class="button">Añadir al carrito </button>
          </li>
        </ul>
      </main>
    <?php
    Pie::footer();
  }
}
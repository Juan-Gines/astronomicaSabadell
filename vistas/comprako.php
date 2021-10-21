<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
include_once "models/cursos.php";
class Comprako{

  static function pagoFallido(){
    Cabecera::head();
    $curso=unserialize($_SESSION["cursoElegido"]);        
    ?>       
      <div class="container-row">     
        <h2>Error al comprar el curso online</h2>        
      </div>
      <div class="separador"></div>
      <main>
        <h3>Datos de la compra</h3>
        <div class="separador final"></div>
        <div class="bloque">                   
          <label>Id producto: </label><span><?= $curso->getId()?></span><br>
          <label>Nombre: </label><span><?= $curso->getNombre()?></span><br>
          <label>Precio: </label><span><?= substr($_SESSION["resp"]["Ds_Amount"],0,strlen($_SESSION["resp"]["Ds_Amount"])-2) ?>€</span><br>
          <label>Hora: </label><span><?= urldecode($_SESSION["resp"]["Ds_Hour"]) ?></span><br>
          <label>Fecha: </label><span><?= urldecode($_SESSION["resp"]["Ds_Date"]) ?></span><br>
          <p>No se ha podido realizar el cobro de su curso.</p>
          <p>Muchas gracias por su confianza.</p>
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"])."?recompra" ?>"><button>Volver a intentar</button></a>
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"])."?cerrar" ?>"><button>Inicio</button></a>
        </div>              
      </main>
    <?php
    Pie::footer();
  }
}
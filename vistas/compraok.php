<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
include_once "models/cursos.php";
class Compraok{

  static function pagoRealizado(){
    Cabecera::head();
    $curso=unserialize($_SESSION["cursoElegido"]);        
    ?>       
      <div class="container-row">     
        <h2>Compra realizada con éxito</h2>        
      </div>
      <div class="separador"></div>
      <main>
        <h3>Datos de la compra</h3>
        <div class="separador final"></div>
        <div class="bloque">          
          <label>Código autorización: </label><span><?= $_SESSION["resp"]["Ds_AuthorisationCode"]?></span><br>
          <label>Id compra: </label><span><?= $_SESSION["resp"]["Ds_Order"]?></span><br>          
          <label>Id producto: </label><span><?= $curso->getId()?></span><br>
          <label>Nombre: </label><span><?= $curso->getNombre()?></span><br>
          <label>Precio: </label><span><?= substr($_SESSION["resp"]["Ds_Amount"],0,strlen($_SESSION["resp"]["Ds_Amount"])-2) ?>€</span><br>
          <label>Hora: </label><span><?= urldecode($_SESSION["resp"]["Ds_Hour"]) ?></span><br>
          <label>Fecha: </label><span><?= urldecode($_SESSION["resp"]["Ds_Date"]) ?></span><br>
          <p>Nota: Después de verificar el pago (máximo 24h laborales). Se enviarán los datos de conexión a su correo electrónico.</p>
          <p>Muchas gracias por su confianza.</p>
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"])."?cerrar" ?>"><button>Inicio</button></a>
        </div>              
      </main>
    <?php
    Pie::footer();
  }
}
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
        <h2><?=$_SESSION["COidioma"]==1 ?"Compra realizada con éxito":"Compra realitzada amb èxit"?></h2>        
      </div>
      <div class="separador"></div>
      <main>
        <h3><?=$_SESSION["COidioma"]==1 ?"Datos de la compra":"Dades de la compra"?></h3>
        <div class="separador final"></div>
        <div class="bloque">
          <figure class="imagenflex">
            <img class="cursos" src="<?=$_SESSION["COidioma"]==1 ? $curso->getImagen():$curso->getImagenCa()?>" alt="<?=$_SESSION["COidioma"]==1 ? "imagen presentación del " .$curso->getNombre(): "imatge presentació del " .$curso->getNombreCa()?>">
          </figure>          
          <label><?=$_SESSION["COidioma"]==1 ?"Código autorización: ":"Codi autorització: "?></label><span><?= $_SESSION["resp"]["Ds_AuthorisationCode"]?></span><br>
          <label>Id compra: </label><span><?= $_SESSION["resp"]["Ds_Order"]?></span><br>          
          <label><?=$_SESSION["COidioma"]==1 ?"Id producto: ":"Id producte: "?></label><span><?= $curso->getId()?></span><br>
          <label><?=$_SESSION["COidioma"]==1 ?"Nombre: ":"Nom: "?></label><span><?=$_SESSION["COidioma"]==1 ?$curso->getNombre():$curso->getNombreCa()?></span><br>
          <label><?=$_SESSION["COidioma"]==1 ?"Precio: ":"Preu: "?></label><span><?= substr($_SESSION["resp"]["Ds_Amount"],0,strlen($_SESSION["resp"]["Ds_Amount"])-2) ?>€</span><br>
          <label>Hora: </label><span><?= urldecode($_SESSION["resp"]["Ds_Hour"]) ?></span><br>
          <label><?=$_SESSION["COidioma"]==1 ?"Fecha: ":"Data: "?></label><span><?= urldecode($_SESSION["resp"]["Ds_Date"]) ?></span><br>
          <p><?=$_SESSION["COidioma"]==1 ?"Nota: Después de verificar el pago (máximo 24h laborales). Se enviarán los datos de conexión a su correo electrónico.":"Nota: Després de verificar el pagament (màxim 24 hores laborals). S'enviaran les dades de connexió al vostre correu electrònic."?></p>
          <p><?=$_SESSION["COidioma"]==1 ?"Muchas gracias por su confianza.":"Moltes gràcies per la vostra confiança."?></p>
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"])."?cerrar" ?>"><button><?=$_SESSION["COidioma"]==1 ?"Inicio":"Inici"?></button></a>
        </div>              
      </main>
    <?php
    Pie::footer();
  }
}
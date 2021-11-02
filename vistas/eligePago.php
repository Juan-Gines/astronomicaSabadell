<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
include_once "models/cursos.php";
class EligePago{
  
  static function get_link($datos){       
        $link=$_SERVER["PHP_SELF"]."?".$datos;
        return $link;
    }
  static function formPago($datos){
    Cabecera::head();
    $curso=unserialize($_SESSION["cursoElegido"]);
    $importe=$_SESSION["importe"];    
    ?>   
      <div class="container-row">     
        <h2><?=$_SESSION["COidioma"]==1 ?"Resumen del pago - paso 3":"Resum del pagament - pas 3"?></h2>        
      </div>
      <div class="separador"></div>
      <main>
        <h3><?=$_SESSION["COidioma"]==1 ?"Datos del curso":"Dades del curs"?></h3>
        <div class="separador final"></div>
        <div class="bloque">
          <figure class="imagenflex">
            <img class="cursos" src="<?=$_SESSION["COidioma"]==1 ? $curso->getImagen():$curso->getImagenCa()?>" alt="<?=$_SESSION["COidioma"]==1 ? "imagen presentación del " .$curso->getNombre(): "imatge presentació del " .$curso->getNombreCa()?>">
          </figure>          
          <label>Id: </label><span><?= $curso->getId()?></span><br>
          <label><?=$_SESSION["COidioma"]==1 ?"Nombre: ":"Nom: "?></label><span><?= $curso->getNombre()?></span><br>
          <label><?=$_SESSION["COidioma"]==1 ?"Precio: ":"Preu: "?></label><span><?= $importe ?>€</span><br>
          <p><?=$_SESSION["COidioma"]==1 ?"Nota: Después de verificar el pago (máximo 24h laborales). Se enviarán los datos de conexión a su correo electrónico.":"Nota: Després de verificar el pagament (màxim 24 hores laborals). S'enviaran les dades de connexió al vostre correu electrònic."?></p>
        </div>
        <h3><?=$_SESSION["COidioma"]==1 ?"Pago con tarjeta de crédito (redireccionado a la plataforma de pagos online)":"Pagament amb targeta de crèdit (redireccionat a la plataforma de pagaments en línia)"?></h3>
        <div class="separador final"></div>
        <div class="bloque">
          <form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
            <?php
              foreach($datos as $name=>$value){
            ?>
            <input type="hidden" name="<?=$name?>" value="<?=$value?>"/>
            <?php
              }?>
            <button><?=$_SESSION["COidioma"]==1 ?"Efectuar el pago":"Efectuar el pagament"?></button>            
          </form> 
        </div>      
      </main>
    <?php
    Pie::footer();
  }
}
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
        <h2>Formas de pago - paso 3</h2>        
      </div>
      <div class="separador"></div>
      <main>
        <h3>Datos del curso</h3>
        <div class="separador final"></div>
        <div class="bloque">          
          <label>Id: </label><span><?= $curso->getId()?></span><br>
          <label>Nombre: </label><span><?= $curso->getNombre()?></span><br>
          <label>Precio: </label><span><?= $importe ?>€</span><br>
          <p>Nota: Después de verificar el pago (máximo 24h laborales). Se enviarán los datos de conexión a su correo electrónico.</p>
        </div>
        <h3>Método de pago (redireccionado a la plataforma de pagos online)</h3>
        <div class="separador final"></div>
        <div class="bloque">
          <form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
            <?php
              foreach($datos as $name=>$value){
            ?>
            <input type="hidden" name="<?=$name?>" value="<?=$value?>"/>
            <?php
              }?>
            <button>Efectuar el pago</button>            
          </form> 
        </div>      
      </main>
    <?php
    Pie::footer();
  }
}
<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
include_once "models/cursos.php";
class Carrito{

  static function get_link($datos){       
        $link=$_SERVER["PHP_SELF"]."?".$datos;
        return $link;
    }
  static function form(){
    Cabecera::head();    
    ?>     
      <div class="idioma">  
        <h2 class="titulo"><?=$_SESSION["COidioma"]==1 ?"Cursos disponibles - paso 2":"Cursos disponibles - pas 2"?></h2>
        <div class="iconos">
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]."?catala") ?>"><img src="imagenes/ca.gif" alt="Català" ></a>
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]."?castellano") ?>"><img src="imagenes/es.gif" alt="Español" ></a>
        </div>
      </div>
      <div class="separador"></div>
      <main>        
        <ul>
          <?php
            include_once "config/gestioncursos.php";
                
            foreach ($cursos as $curso) {                            
              if(empty($_SESSION["user"]["Socio"])){              
                $importe = $curso->getImporte();
              }else{
                if($_SESSION["user"]["Joven"]){
                  $importe = !$curso->getImporteJoven() ? $curso->getImporteSocio(): $curso->getImporteJoven();                  
                }else{                  
                  $importe=$curso->getImporteSocio();
                }
              }
                ?>
          <li>
            <h3><?=$_SESSION["COidioma"]==1 ? $curso->getNombre(): $curso->getNombreCa()?></h3>
            <div class="separador lista"></div>
            <figure class="imagenflex">
              <img class="cursos" src="<?=$_SESSION["COidioma"]==1 ? $curso->getImagen():$curso->getImagenCa()?>" alt="<?=$_SESSION["COidioma"]==1 ? "imagen presentación del " .$curso->getNombre(): "imatge presentació del " .$curso->getNombreCa()?>">
            </figure>
            <p><?=$_SESSION["COidioma"]==1 ? $curso->getDescripcion(): $curso->getDescripcionCa()?> 
              <a href="<?=$_SESSION["COidioma"]==1 ?"https://astrosabadell.org/es/formacio/cursos-online":"https://astrosabadell.org/ca/formacio/cursos-online"?>":><?=$_SESSION["COidioma"]==1 ?"más info":"més info"?></a>
            </p>
            <p><?=$_SESSION["COidioma"]==1 ?"Precio: ":"Preu: " ?><?= $importe?>€</p>            
            <a href="<?=htmlspecialchars(SELF::get_link($curso->getId()))?>"><button type="button">Comprar</button></a>            
          </li>
          <?php
            }
          ?>
        </ul>
      </main>
    <?php
    Pie::footer();
  }
}
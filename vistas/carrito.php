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
      <div class="container-row">     
        <h2>Cursos disponibles - paso 2</h2>        
      </div>
      <div class="separador"></div>
      <main>        
        <ul>
          <?php
            $cursos[]=new Cursos('CO001','Curso online: Cosmología','Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
                                100,70,'imagenes/COCosmologia.png');
            $cursos[]=new Cursos('CO002','Curso online: Iniciación a la astronomía','Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
                                120,60,'imagenes/COIniciacion.png');
            $cursos[]=new Cursos('CO003','Curso online: Técnicas de observación visual con telescopio','Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
                                120,60,'imagenes/COTecnicas.png');
            $_SESSION["cursosOnline"]=serialize($cursos);
            foreach ($cursos as $curso) {
                ?>
          <li>
            <h3><?= $curso->getNombre()?></h3>
            <div class="separador lista"></div>
            <img src="<?= $curso->getImagen()?>" alt="imagen presentación del curso de <?= $curso->getNombre()?>">
            <p><?= $curso->getDescripcion()?> <a href="#">más info</a></p>
            <p>Precio: <?= !empty($_SESSION["user"]["Socio"])? $curso->getImporteSocio(): $curso->getImporte()?>€</p>            
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
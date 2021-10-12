<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
class Inscripcion{

  static function form($datos=[]){
    Cabecera::head();
    $idrand=mt_rand();
    $_SESSION["idrand"]=$idrand;
    ?>
      <main>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
          <label for="nombre">Nombre *</label><br>
          <input type="text" name="nombre" id="nombre" value="<?= isset($datos["curNombre"])? $datos["curNombre"]:""?>"><br>          
          <label for="apellidos">Apellidos *</label><br>
          <input type="text" name="apellidos" id="apellidos" value="<?= isset($datos["curApellidos"])? $datos["curApellidos"]:""?>"><br>
          <label for="telefono">Teléfono *</label><br>
          <input type="text" name="telefono" id="telefono" value="<?= isset($datos["curTelefono"])? $datos["curTelefono"]:""?>"><br>
          <label for="email">Correo electrónico *</label><br>
          <input type="text" name="email" id="email" value="<?= isset($datos["curEmail"])? $datos["curEmail"]:""?>"><br>
          <label for="numSocio">Núm. de socio (rellenar sólo si ya es socio)</label><br>
          <input type="text" name="numSocio" id="numSocio" placeholder="Núm. socio" value="<?= isset($datos["curSocio"])? $datos["curSocio"]:""?>"><br>
          <input type="hidden" name="idrand" id="idrand" value="<?= $idrand?>">
        </form>
      </main>
    <?php
    Pie::footer();
  }
}
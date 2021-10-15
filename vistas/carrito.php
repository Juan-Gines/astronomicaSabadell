<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
class Carrito{

  static function form(){
    Cabecera::head();
    $idrand=mt_rand();
    $_SESSION["idrand"]=$idrand;
    ?>
      <h2>Cursos Disponibles</h2>      
      <h3>Elige los cursos online que desees - paso 2</h3>
      <div class="separador"></div>
      <main>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
          <label for="nombre">Nombre *</label><br>
          <input type="text" name="nombre" id="nombre" value="<?= isset($datos["curNombre"])? $datos["curNombre"]:""?>">
          <output><?= isset($datos["errcurNombre"])? $datos["errcurNombre"]:""?></output><br>          
          <label for="apellidos">Apellidos *</label><br>
          <input type="text" name="apellidos" id="apellidos" value="<?= isset($datos["curApellidos"])? $datos["curApellidos"]:""?>">
          <output><?= isset($datos["errcurApellidos"])? $datos["errcurApellidos"]:""?></output><br>
          <label for="telefono">Teléfono *</label><br>
          <input type="tel" name="telefono" id="telefono" value="<?= isset($datos["curTelefono"])? $datos["curTelefono"]:""?>">
          <output><?= isset($datos["errcurTelefono"])? $datos["errcurTelefono"]:""?></output><br>
          <label for="email">Correo electrónico *</label><br>
          <input type="text" name="email" id="email" value="<?= isset($datos["curEmail"])? $datos["curEmail"]:""?>">
          <output><?= isset($datos["errcurEmail"])? $datos["errcurEmail"]:""?></output><br>
          <label for="numSocio">Núm. de socio (rellenar sólo si ya es socio)</label><br>
          <input type="text" name="numSocio" id="numSocio" value="<?= isset($datos["numSocio"])? $datos["numSocio"]:""?>">
          <output><?= isset($datos["errnumSocio"])? $datos["errnumSocio"]:""?></output><br>
          <p><small> * Campos requeridos </small></p>
          <input type="hidden" name="idrand" id="idrand" value="<?= $idrand?>">
          <button name="datPersonales">Enviar</button>
        </form>
        <div class="separador"></div>
      </main>
    <?php
    Pie::footer();
  }
}
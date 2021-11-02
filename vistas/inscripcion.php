<?php
include_once "vistas/cabezera.php";
include_once "vistas/pie.php";
class Inscripcion{

  static function form($datos=[]){
    Cabecera::head();
    $idrand=mt_rand();
    $_SESSION["idrand"]=$idrand;    
    ?>
      <div class="idioma">  
        <h2 class="titulo"><?=$_SESSION["COidioma"]==1 ?"Datos personales - paso 1":"Dades personals - pas 1"?></h2>
        <div class="iconos">
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]."?catala") ?>"><img src="imagenes/ca.gif" alt="Català" ></a>
          <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]."?castellano") ?>"><img src="imagenes/es.gif" alt="Español" ></a>
        </div>
      </div>
      <div class="separador"></div>
      <main>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
          <label for="nombre"><?=$_SESSION["COidioma"]==1 ?"Nombre *":"Nom *"?></label><br>
          <input type="text" name="nombre" id="nombre" value="<?= isset($datos["curNombre"])? $datos["curNombre"]:""?>">
          <output><?= isset($datos["errcurNombre"])? $datos["errcurNombre"]:""?></output><br>          
          <label for="apellidos"><?=$_SESSION["COidioma"]==1 ?"Apellidos *":"Cognoms *"?></label><br>
          <input type="text" name="apellidos" id="apellidos" value="<?= isset($datos["curApellidos"])? $datos["curApellidos"]:""?>">
          <output><?= isset($datos["errcurApellidos"])? $datos["errcurApellidos"]:""?></output><br>
          <label for="telefono"><?=$_SESSION["COidioma"]==1 ?"Teléfono":"Telèfon"?> </label><br>
          <input type="tel" name="telefono" id="telefono" value="<?= isset($datos["curTelefono"])? $datos["curTelefono"]:""?>">
          <output><?= isset($datos["errcurTelefono"])? $datos["errcurTelefono"]:""?></output><br>
          <label for="email"><?=$_SESSION["COidioma"]==1 ?"Correo electrónico *":"Correu electrònic *"?></label><br>
          <input type="text" name="email" id="email" value="<?= isset($datos["curEmail"])? $datos["curEmail"]:""?>">
          <output><?= isset($datos["errcurEmail"])? $datos["errcurEmail"]:""?></output><br>
          <label for="numSocio"><?=$_SESSION["COidioma"]==1 ?"Núm. de socio (rellenar sólo si ya es socio)":"Núm. de soci (emplenar només si ja és soci)"?></label><br>
          <input type="text" name="numSocio" id="numSocio" value="<?= isset($datos["numSocio"])? $datos["numSocio"]:""?>">          
          <output><?= isset($datos["errnumSocio"])? $datos["errnumSocio"]:""?></output><br>
          <label><?=$_SESSION["COidioma"]==1 ?"¿Eres socio joven?":"Ets soci jove?"?></label>   <label for="socJovenOk" class="radio">Si</label>
          <input type="radio" name="socJoven" id="socJovenOk" value="si" <?= (isset($datos["socJoven"])&&$datos["socJoven"])? "checked":""?>>
          <label for="socJovenKO" class="radio"> No</label>
          <input type="radio" name="socJoven" id="socJovenKO" value="no" <?= (!isset($datos["socJoven"])||!$datos["socJoven"])? "checked":""?>>
          <p><small><?=$_SESSION["COidioma"]==1 ?" * Campos requeridos ":" * Camps requerits "?></small></p>
          <input type="hidden" name="idrand" id="idrand" value="<?= $idrand?>">
          <button name="datPersonales">Enviar</button>
        </form>
        <div class="separador"></div>
      </main>
    <?php
    Pie::footer();
  }
}
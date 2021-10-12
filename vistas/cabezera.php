<?php
class Cabecera{
  
  static function head(){
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/style.css">
      <link rel="icon" href="imagenes/favicon.ico" type="image/ico" />
      <title>AstroSabadell Cursos Online</title>
    </head>
    <body>
      <header>
        <figure>
          <img src="imagenes/logoastronomica.png" alt="logo">
        </figure>
        <div>
          <h1>ASTRONÓMICA</h1>
          <h2>DE SABADELL</h2>
        </div>
      </header>
    
    <?php
  }
}
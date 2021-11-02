<?php

include_once "models/cursos.php";

    //aquí cambiamos los cursos online... Todos las propiedades tienen que ponerse excepto la ultima si no procede
    //ponemos en el constructor (
    //  id,
    //  nombre,
    //  descripcion,
    //  importe,
    //  importeSocio,
    //  url imagen,
    //  nombre catalán,
    //  descripcion catalan,
    //  url imagen catalan,
    //  OPCIONAL importe socio joven(SI NO TIENE NO SE PONE NADA));

$cursos[]=new Cursos(
        'CO001',
        'Curso online: Cosmología',
        'Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
        100,
        70,
        'imagenes/COCosmologia.png',
        'Curs online: Cosmologia',
        "Curs actiu tot l'any. Inscripcions obertes. Període de realització: 3 mesos, amb opció de pròrroga.",
        'imagenes/ca/COCosmologiaCa.png');
$cursos[]=new Cursos(
        'CO002',
        'Curso online: Iniciación a la astronomía',
        'Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
        120,
        60,
        'imagenes/COIniciacion.png',
        "Curs online: Iniciació a l'astronomia",
        "Curs actiu tot l'any. Inscripcions obertes. Període de realització: 3 mesos, amb opció de pròrroga.",
        'imagenes/ca/COIniciacionCa.png');
$cursos[]=new Cursos(
        'CO003',
        'Curso online: Técnicas de observación visual con telescopio',
        'Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
        120,
        60,
        'imagenes/COTecnicas.png',
        "Curs online: Tècniques d'observació visual amb telescopi",
        "Curs actiu tot l'any. Inscripcions obertes. Període de realització: 3 mesos, amb opció de pròrroga.",
        'imagenes/ca/COTecnicasCa.png');
    
    //aquí escribimos cursos que solo están disponibles en catalán                

if ($_SESSION["COidioma"]==3) {
    $cursos[]=new Cursos(
        'CO004',
        'Curso online: Introducción a la física quántica',
        'Curso activo todo el año. Inscripciones abiertas. Período de realización: 3 meses, con opción de prórroga.',
        100,
        70,
        'imagenes/COQuantica.png',
        "Curs online: Introducció a la física quàntica",
        "Curs actiu tot l'any. Inscripcions obertes. Període de realització: 3 mesos, amb opció de pròrroga.",
        'imagenes/ca/COQuanticaCa.png',
        35);
}            
$_SESSION["cursosOnline"]=serialize($cursos);
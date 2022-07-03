<?php

global $rutaHeader; 
$rutaHeader = require('Vista/componentes/header.php');

// global $rutaFooter;
// $rutaFooter = require_once realpath('Vista/componentes/footer.php');

//INTENTOS FALLIDOS

//define($rutaHeader, require_once realpath('Vista/componentes/header.php'));

//define("rutaFooter", require_once realpath('Vista/componentes/footer.php'));

//OTRO TIPO DE INTENTOS FALLIDOS


// function rutaH()
// {
//     $rutaHeader = require("Vista/componentes/header.php");
//     global $rutaHeader;
//     $header = $rutaHeader;
//     return $header;
// }

// $rutaFooter = require_once realpath('Vista/componentes/footer.php');
// function rutaF()
// {
//     global $rutaFooter;
//     $footer = $rutaFooter;
//     return $footer;
// }

?>
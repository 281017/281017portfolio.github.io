<?php
session_start();
// inkluder database forbindelse
require_once('classes/DB.php');

// inkluder classes

// inkluder generelle funktioner
require_once('code/fncMain.php');

// Inkluder vores fil header.php
require_once('includes/header.php');

// kontroller om der ønskes en underside

if(isset($_GET['page'])){

    // Hent get variabel med ønsket underside
   $page = $_GET['page']; // super global $_GET

    if(file_exists($pagesFolderPath.$page.'.php')){
        // Siden findes - Inkluder undersiden
        include($pagesFolderPath.$page.'.php');
    } else {
        // Den ønskede side findes ikke
        include($pagesFolderPath.'404.php');
    }
} else {
    // vis forsiden
    include($pagesFolderPath.$frontPage);
}

// inkluder js
require('js/sticky.js');
require('js/transitions.js');

// Inkluder vores fil footer.php
require_once('includes/footer.php');

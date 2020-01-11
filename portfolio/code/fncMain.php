<?php

/*
 * Funktion til at indsætte titel på header.php
 */
function setPageTitle($page) {

    $title = '';

    switch($page){
        case 'home':
            $title = 'Home';
            break;
        default:
            $title = 'Home';
            break;
    }

    return $title;

}

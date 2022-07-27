<?php

/*
 * Ici, on définit les routes de notre application.
 * Nouvelle page ? => Nouvelle route
 */

$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/hommepage' => './homepage.php'
    ],
    // Routes de la méthode POST
    'POST' => [
        '/registration' => './form.php',
    ],
];
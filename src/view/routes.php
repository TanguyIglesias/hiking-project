<?php

/*
 * Ici, on définit les routes de notre application.
 * Nouvelle page ? => Nouvelle route
 */

$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/homepage' => 'view/homepage.php',
        '/registration' => 'view/form.php',
    ],
    // Routes de la méthode POST
    'POST' => [
    ],
];
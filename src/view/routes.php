<?php

/*
 * Ici, on définit les routes de notre application.
 * Nouvelle page ? => Nouvelle route
 */

$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => 'view/homepage.php',
        '/homepage' => 'view/homepage.php',
        '/registration' => 'view/form.php',
        '/delete' => 'view/delete.php',
        '/update' => 'view/updateForm.php',
        '/hike' => 'view/singleHike.php',
        '/user' => 'view/userProfil.php',
        
    ],
    // Routes de la méthode POST
    'POST' => [
        '/sendForm' => 'Model/sendForm.php',
        '/deleteUser' => 'Model/deleteUser.php',
        '/updateUser' => 'Model/updateUser.php',
        '/register' => 'Model/register.php'
    ],
];
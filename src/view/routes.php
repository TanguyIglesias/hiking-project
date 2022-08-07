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
        '/admin' => 'view/adminProfil.php',
        '/createhike' => 'view/createHike.php',
        '/pinterest' => 'view/pinterest.php',
        //'/deleteHike' => 'view/deleteHike.php',
        '/tags' => 'view/tag.php',
        '/editTags' => 'view/editTags.php',
        '/updateHike' => 'view/updateHike.php',
        '/404' => 'view/404.php',

    ],
    // Routes de la méthode POST
    'POST' => [
        '/sendForm' => 'Model/sendForm.php',
        '/deleteUser' => 'Model/deleteUser.php',
        '/updateUser' => 'Model/updateUser.php',
        '/register' => 'Model/register.php',
        '/logout' => 'Model/logOut.php',
        '/sendHike' => 'Model/sendHike.php',
        '/deleteHike' => 'Model/deleteHike.php',
        '/addTags' => 'controler/addTags.php',
        '/editTag' => 'controler/editTag.php',
        '/deleteTag' => 'Model/deleteTag.php',
        '/sendUpdateHikes' => 'Model/updateHikes.php'
    ],
];
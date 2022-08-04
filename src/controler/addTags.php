<?php

require_once '../Model/Tag.php';

function addTag()
{

    if(isset($_POST['AddTag']))
    {
        $tag = new Tag();
        $tag_name = "";

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = ucfirst($data);
            return $data;
        }

        if(empty($_POST["tag_name"]))
        {
            header("Location: /tags");
            $_SESSION['error'] = 'Aucun Nom de Tag précisé';
            exit();
        }else
        {
            $tag_name = test_input($_POST['tag_name']);
            if($tag->checkTag($_POST["tag_name"])>0)
            {
                header("Location:/tags");
                $_SESSION['tagErr'] = "Ce tag existe déjà";
                exit();
            }else
            {

                if(!preg_match("/^[a-zA-z-' ]*$/", $tag_name))
                {
                    header("Location:/tags");
                    $_SESSION['nameErr'] = "Seul les lettres et les espaces sont autorisés.";
                    exit();
                }
            }
        }

        $tag->createTag($tag_name);
    }
}
addTag();
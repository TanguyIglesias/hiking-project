<?php

class Tag extends Database
{
    public function getTag()
    {
        $db = $this->connectdb();

        $req = $db->query("SELECT * FROM tags");

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTag($tagName)
    {
        $db = $this->connectdb();
        $query ="INSERT INTO tags (tag_name) VALUES (:tag_name)";
        $query_run= $db->prepare($query);
        $query_run->bindParam(":tag_name", $tagName);
        if($query_run->execute())
        {
            header("Location:/");
        }else{
            echo 'ERROR';
        }
    }

    public function checkTag(string $tagName)
    {   
       
        $db = $this->connectdb();
        $req = $db->query("SELECT * FROM tags WHERE tag_name='$tagName'");
        return $req->rowCount();
        
    }

    public function linkTag($hikeId)
    {
        $db = $this->connectdb();
        $req = $db->query("SELECT tag_id FROM tag_hike WHERE hike_id = '$hikeId'");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagById($tagId)
    {
        $db = $this->connectdb();
        $req = $db->query("SELECT * FROM tags WHERE tag_id ='$tagId'");
        return $req->fetch(PDO::FETCH_ASSOC);
    }
}
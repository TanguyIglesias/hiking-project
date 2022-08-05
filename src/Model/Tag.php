<?php

class Tag extends Database
{
    public function getTag()
    {
        $db = $this->connectdb();

        $req = $db->query("SELECT * FROM tags");

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTag($tagName)
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

    public function addTag($tagId, $hike_name)
    {
        $db = $this->connectdb();
        $name_request = $db->query("SELECT hike_id FROM hikes WHERE hike_name = '$hike_name'");
        $hike_id_fetch = $name_request->fetch(PDO::FETCH_ASSOC);
        $hike_id = $hike_id_fetch['hike_id'];
        $query ="INSERT INTO tag_hike (hike_id, tag_id) VALUES (:hike_id, :tagId)";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':hike_id',$hike_id);
        $query_run->bindParam(':tagId',$tagId);
        $query_run->execute();
    }

    public function deleteRelation($hike_id)
    {
        $db = $this->connectdb();

/*         $query = "DELETE FROM tag_hike WHERE hike_id=$hike_id";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':hike_id',$hike_id);
        $query_run->execute(); */

        $data =[
            'deleteHikeId' => $hike_id
        ];

        $query = "DELETE FROM tag_hike WHERE hike_id=:deleteHikeId";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':deleteHikeId', $data['deleteHikeId']);
        $query_run->execute($data);

    }

    public function addRelation($tagId, $hike_id)
    {
        $db = $this->connectdb();
        $query ="INSERT INTO tag_hike (hike_id, tag_id) VALUES (:hike_id, :tagId)";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':hike_id',$hike_id);
        $query_run->bindParam(':tagId',$tagId);
        $query_run->execute();
    }
}
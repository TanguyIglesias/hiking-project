<?php
require_once '../Model/Tag.php';

class DeleteHike extends Database
{

    public function deleteHike() {

        $db=$this->connectDb();

        $hikeID = $_POST['deleteHikeId'];

        $data =[
            'deleteHikeId' => $hikeID
        ];

        $query = "DELETE FROM hikes WHERE hike_id=:deleteHikeId";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':deleteHikeId', $data['deleteHikeId']);
        if($query_run->execute($data))
        {
            header("Location:/user");   
        }
    }
}
$hikeID = $_POST['deleteHikeId'];

$tag = new Tag();
$tag->deleteRelation($hikeID);

$delete= new DeleteHike();
$delete->deleteHike();
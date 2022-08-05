<?php

class DeleteTag extends Database
{

    public function deleteTag() {

        $db=$this->connectDb();

        $tagID = $_POST['deleteTag'];

        echo $tagID;

        $data =[
            'deleteTag' => $tagID
        ];

        $query = "DELETE FROM tags WHERE user_id=:deleteTag";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':deleteTag', $data['deleteTag']);
        if($query_run->execute($data))
        {
            header("Location:/user");   
        }
    }
}
$delete= new DeleteTag;
$delete->deleteTag();
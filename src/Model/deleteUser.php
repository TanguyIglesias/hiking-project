<?php


class DeleteUser extends Database
{

    public function deleteUser() {

        $db=$this->connectDb();

        $userID = $_POST['deleteUserId'];

        echo $userID;

        $data =[
            'deleteUserId' => $userID
        ];

        $query = "DELETE FROM users WHERE user_id=:deleteUserId";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':deleteUserId', $data['deleteUserId']);
        if($query_run->execute($data))
        {
            header("Location:/");   
        }
    }
}
$delete= new DeleteUser();
$delete->deleteUser();
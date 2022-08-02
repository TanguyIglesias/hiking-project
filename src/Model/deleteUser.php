<?php


class DeleteUser extends Database
{

    public function deleteUser() {

        $db=$this->connectDb();

        $userID = $_POST['deleteUser'];

        echo $userID;

        $data =[
            'deleteUser' => $userID
        ];

        $query = "DELETE FROM users WHERE user_id=:deleteUser";
        $query_run = $db->prepare($query);
        $query_run->bindParam(':deleteUser', $data['deleteUser']);
        if($query_run->execute($data))
        {
            header("Location:/user");   
        }
    }
}
$delete= new DeleteUser();
$delete->deleteUser();
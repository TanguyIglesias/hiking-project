<?php
require_once '../Model/Tag.php';
var_dump($_POST);


function deleteTag()
{
    if(isset($_POST["submit"]))
    {
        $tagId = "";
        $tagId = $_POST['deleteTag'];
        $tag = new Tag();
        $tag->deleteTag($tagId);
    }
}
deleteTag();









// class DeleteTag extends Database
// {

//     public function deleteTag() {

//         $db=$this->connectDb();

//         $tagID = $_POST['deleteTag'];

//         echo $tagID;

//         $data =[
//             'deleteTag' => $tagID
//         ];

//         $query = "DELETE FROM tags WHERE user_id=:deleteTag";
//         $query_run = $db->prepare($query);
//         $query_run->bindParam(':deleteTag', $data['deleteTag']);
//         if($query_run->execute($data))
//         {
//             header("Location:/user");   
//         }
//     }
// }
// $delete= new DeleteTag;
// $delete->deleteTag();
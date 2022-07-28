
    
<form action="../Model/deleteUser" method="POST">

        <input type="text" name="deleteUserId" placeholder="User ID to Delete">
        <br>
        <button type="submit" name="submit">Sign up</button>
</form>

<?php
        require '../Model/deleteUser.php';
        $form= new DeleteUser;
        $data = $form-> deleteUser();
    ?>
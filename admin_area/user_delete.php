<?php
if (isset($_GET['user_delete'])) {
    $user_delete = $_GET['user_delete'];

    $delete_query = "DELETE FROM `user_tables` WHERE user_id = $user_delete";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('User is deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_users','_self')</script>";
    } else {
        echo "<script>alert('Error: Unable to delete user')</script>";
    }
}
?>

<?php

if(isset($_GET['delete_payments'])){
    $delete_id=$_GET['delete_payments'];
    // echo $delete_id;
    // delete query
    
    $delete_product="delete from `user_payment` where order_id=$delete_id";
    $result_product=mysqli_query($con,$delete_product);
    if($result_product){
        echo "<script>alert('Payments Deleted Successfully')</script>";
        echo "<script>window.open('./index.php?list_payments','_self')</script>";

    }
}

?>
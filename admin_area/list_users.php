<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         .product_img1{
            width: 100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
    

<h3 class="text-center text-success">All User</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">


    <?php
$get_payments="select * from `user_tables`";
$result=mysqli_query($con,$get_payments);
$row_count=mysqli_num_rows($result);
echo "<tr>
<th>S.N</th>
<th>User Name</th>
<th>User E-mail</th>
<th>User Image</th>
<th>User Address</th>
<th>User Mobile</th>
<th>Delete</th>
</tr>
</thead>
<tbody class='bg-secondary text-light'>";

if($row_count==0){
    echo "<h2 class='bg-danger text-center mt-5'>No Payment received Yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $user_image=$row_data['user_image'];
        $user_address=$row_data['user_address'];
        $user_mobile=$row_data['user_mobile'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$username</td>
        <td>$user_email</td>
        <td><img src='../user_area/user_images/$user_image' alt='$username' class='product_img1'/></td>
        <td>$user_address</td>
        <td>$user_mobile</td>
        <td><a href='index.php?user_delete=$user_id'<i class='fa-solid fa-trash'></i></a></td> 
    </tr>";
    }
}

?>
        
        
    </tbody>
</table>
</body>
</html>
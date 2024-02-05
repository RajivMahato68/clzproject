<?php
include('../includes/connect.php');
include('../function/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_Registration</title>
      <!-- bootstarp css link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <!-- css file  -->
     <link rel="stylesheet" href="../style.css">
     <style>
        .footer{
            position: absolute;
            bottom:0;
        }
           body{
            overflow-x:hidden;
        }
     
     </style>
</head>
<body>
<div class="container-fluid p-0">
        <!-- first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="../Fruit/logo2.png" alt="logo" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
       
      
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li> -->
        
      </ul>
      </form>
    </div>
  </div>
</nav>

    
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6 ">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- User_name  -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">User Name</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your Name" autocomplete="off" required="required" name="user_username"/>
                </div>
                   <!-- email  -->
                   <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Your Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your Email" autocomplete="off" required="required" name="user_email"/>
                </div>
                  <!-- image  -->
                  <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">Your image</label>
                    <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
                </div>
                 <!-- password  -->
                 <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Your password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                </div>
                 <!-- password  -->
                 <div class="form-outline mb-4">
                    <label for="conf_user_password" class="form-label">Confirm password</label>
                    <input type="password" id="conf_user_password" class="form-control" placeholder="Enter your Confirm password" autocomplete="off" required="required" name="conf_user_password"/>
                </div>
                 <!-- Address  -->
                 <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your Address" autocomplete="off" required="required" name="user_address"/>
                </div>
                <!-- Contract  -->
                <div class="form-outline mb-4">
                    <label for="user_contract" class="form-label">Contract No.</label>
                    <input type="text" id="user_contract" class="form-control" placeholder="Enter your Mobile Number" autocomplete="off" required="required" name="user_contract"/>
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="User_register">
                 
                </div>
                <div class="d-flex">
                <p class="small fw-bold mt-2 pt-1 mb-0">Already have an accout ? <a href="checkout.php" class="text-danger"> Login</a></p>
                
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code  -->
<?php
 if(isset($_POST['User_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contract=$_POST['user_contract'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();

    // select query 
    $select_query="select * from `user_tables` where user_email='$user_email' or user_mobile=$user_contract";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('User already exists')</script>";
    }else if($user_password!=$conf_user_password){
        echo "<script>alert('Password Does not Matched')</script>";
    }
    else{
  // insert_query 
  move_uploaded_file($user_image_tmp,"./user_images/$user_image");
  $insert_query="insert into `user_tables` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contract')";
  $sql_execute=mysqli_query($con,$insert_query);
  echo "<script>alert('Sucessfully Register')</script>";
    }
   

    // select cart items 
    $select_cart_items="select * from `cart_detail` where ip_address='$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('you have items in your carts')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../index.php','_self')</script>";   
    }
 }


?>
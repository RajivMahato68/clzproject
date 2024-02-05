<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_tile=$_POST['product_title'];
    $product_decsription=$_POST['product_decsription'];
    $product_keywords=$_POST['product_keywords'];
    $product_categories=$_POST['product_categories'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    // accesing images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    // accesing img temp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    // checking empty condition

    if($product_tile=='' or $product_decsription=='' or $product_keywords=='' or  $product_categories=='' or $product_brands=='' or $product_price=='' or  $product_image1=='' or $product_image2=='' or $product_image2==''){
        echo "<script>alert('Please fill all the aviable fields')</script>";
        exit();  
    } else{
        //upload photot store 
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");

        // insert query
        $insert_products="insert into `product` (product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) value('$product_tile','$product_decsription','$product_keywords','$product_categories','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('sucessfully inserted the products')</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- css file  -->
     <link rel="stylesheet" href="../style.css">

      <!-- bootstarp css link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <style>
           body{
            overflow-x:hidden;
        }
        </style>
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- product details  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label"> Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product title" autocomplete="off" required="required">
            </div>

             <!-- product Description  -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="decsription" class="form-label"> Product Description</label>
                <input type="text" name="product_decsription" id="decsription" class="form-control" placeholder="Enter product_decsription" autocomplete="off" required="required">
            </div>

             <!-- keywords -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label"> product_keywords</label>
                <input type="text" name="product_keywords" id="decsription" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
               <select name="product_categories" id="" class="form-select">
               <option value="">Select Category</option>
                <?php
                $select_query="select * from `categorie`";
                $result_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $category_title=$row['category_title'];
                    $category_id=$row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
               </select>
            </div>

              <!-- Brands -->
              <div class="form-outline mb-4 w-50 m-auto"> 
               <select name="product_brands" id="" class="form-select">
                <option value="">Select Brands</option>
                <?php
                $select_query="select * from `brand`";
                $result_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $brand_title=$row['brand_title'];
                    $brand_id=$row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
               </select>
            </div>

            <!-- Image1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"  required="required">
            </div>

             <!-- Image2 -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control"  required="required">
            </div>

             <!-- Image3 -->
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control"  required="required">
            </div>

              <!-- pPrice -->
              <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Producr Prices</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            
              <!-- pPrice -->
              <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert product">
            </div>
        </form>
    </div>
   
</body>
</html>
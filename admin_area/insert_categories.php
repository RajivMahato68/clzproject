
<?php
include('../includes/connect.php');

if (isset($_POST['insert_cart'])) {
    $category_title = $_POST['cat_title'];

    // Check if the category title is empty
    if (empty($category_title)) {
        echo "<script>alert('Please enter a category title');</script>";
    } else {
        // Select data from the database
        $select_query = "SELECT * FROM `categorie` WHERE category_title='$category_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);

        if ($number > 0) {
            echo "<script>alert('This category is present inside the database')</script>";
        } else {
            $insert_query = "INSERT INTO `categorie` (category_title) VALUES ('$category_title')";
            $result = mysqli_query($con, $insert_query);

            if ($result) {
                echo "<script>alert('Category has been inserted successfully')</script>";
            }
        }
    }
}

// if (isset($_POST['insert_cart'])) {
//     $category_title= $_POST['cat_title'];
//     $insert_query = "INSERT INTO `categorie` (category_title) VALUES ('$category_title')";

//     $result=mysqli_query($con,$insert_query);
//     if($result){
//         echo "<script>alert('Category has been inserted successfully')</script>";
//     }
//     echo "Category Title: " . $category_title . "<br>";

// }
?>


<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="insert categories" aria-label="Categories" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class=" bg-info b-0 p-2 my-3" name="insert_cart" value="Insert categories" >


</div>

</form>
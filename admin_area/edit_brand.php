<?php
if(isset($_GET['edit_brands'])){
    $edit_brands = $_GET['edit_brands'];
    $get_brands = "SELECT * FROM `brand` WHERE brand_id = $edit_brands";
    $result = mysqli_query($con, $get_brands);

    // Check for errors in the query
    if (!$result) {
        die("Error in query: " . mysqli_error($con));
    }

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $brand_title = $row['brand_title'];
    }
}

if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];
    
    $update_query="UPDATE `brand` SET brand_title='$brand_title' WHERE brand_id = $edit_brands";
    $result_brand = mysqli_query($con, $update_query);

    if ($result_brand) {
        echo "<script>alert('Brands Updated successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}
?>


<div class="container mt-3">
    <h1 class="text-center">Edit Brands</h1>
    <form action=""method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Category Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control text-center" required="required" value='<?php echo $brand_title;?>'>
        </div>
        <input type="submit" value="Update Brands" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>

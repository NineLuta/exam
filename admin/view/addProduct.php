<?php

include "../view/header.php"; 
require_once "../../inc/conn.php";
include "../view/sidebar.php";
include "../view/navbar.php";

?>







<?php







if(isset($_POST['addProduct']))
{
    $cat= $_POST['cat'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $errors=[];
    if(empty($cat))
    {
        $errors[] = "the category should be exist";
    }
    if(empty($title))
    {
        $errors[] = "the title should be exist";
    }
    if(empty($desc))
    {
        $errors[] = "the description should be exist";
    }
    if(empty($price))
    {
        $errors[] = "the price should be exist";
    }
    if(empty($quantity))
    {
        $errors[] = "the quantity should be exist";
    }

    $img = $_FILES['img'];
    $img_name = $img['name'];
    $img_tmpName = $img['tmp_name'];
    $ext = pathinfo($img_name,PATHINFO_EXTENSION);
    $img_error= $img['error'];
    $img_size = $img['size'] / (1024 * 1024);
    $now = date("Y/m/d h:i:s");
    $newName = uniqid(). "." . $ext; 
    $dir_img = "../assets/images/img/"; 
    if($img_error > 0)
    {
        $errors[] = "the img is broken";
    }
    elseif( $img_size > 1 )
    {
        $errors[] = "the image size is bigger than 1mb";
    }
    elseif(!in_array($ext,['png','jpg']))
    {
          $errors[] = "the image must be jpg pr png";
    }

    if(empty($errors))
    {
        $query = "INSERT INTO products (`Name`,`Description`,`Price`,`image`,`CategoryID`,`StockQuantity`)
        VALUES ('$title','$desc','$price','$newName','$cat','$quantity')";
        $result = mysqli_query($conn,$query);
        // var_dump($result);
        if($result)
        {
            $_SESSION['success'] = "the product is inserted successfully";
            move_uploaded_file($img_tmpName,$dir_img.$newName);
            // header('Location: '.$_SERVER['PHP_SELF']);exit;
            // exit();
        }else {
            $errors[]= "the product is not inserted";
        }
    }

    $_SESSION['errors'] = $errors;
    // header('Location: '.$_SERVER['PHP_SELF']);exit;
}




$query= "SELECT * from categories";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
  $categories= mysqli_fetch_all($result,MYSQLI_ASSOC);


}




?>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Product</h3>
                <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Category</label>
                      <select name="cat" class="form-control p_input">
                       <?php foreach($categories as $category){   
                        
                         ?>
                         <option value="<?php echo $category['CategoryID'];  ?>"><?php echo $category['CategoryName']; ?></option>
                       <?php }
                       ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="desc" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>
                
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

<?php 
include "../view/footer.php";
 ?>
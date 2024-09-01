<?php
require_once "../../inc/conn.php";
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
?>





<?php 
if (isset($_POST['add'])){
  $name=htmlspecialchars(trim($_POST["name"]));

  if(!empty($name)){
    $query = "INSERT INTO categories (`CategoryName`) values ('$name')";
    $result = mysqli_query($conn,$query); 
    if($result){
      $_SESSION['success']="added successfully";
      // header('Location: '.$_SERVER['PHP_SELF']);exit;

    }else{
      $_SESSION['error']="your input is wrong";
      // header('Location: '.$_SERVER['PHP_SELF']);exit;
    }
  // header('Location: '.$_SERVER['PHP_SELF']);

  }

}




?>

      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Category</h3>
                <form method="POST" action="<?php  echo $_SERVER['PHP_SELF']; ?>">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="name" class="form-control p_input text-light" >
                  </div>
                  <div class="text-center">
                    <button type="submit" name="add" class="btn btn-primary btn-block enter-btn">Add</button>
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
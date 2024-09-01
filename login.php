<?php

include "header.php";
require_once "inc/conn.php";
include "navbar.php";
?>
<?php
// isset($_POST['login'])
if(isset($_POST['login'])){
  
    $email=$_POST ['email'];
    $password=$_POST ['password'];
    
    if(!empty($email) && !empty($password)){
     
      
      $query= "SELECT * from customers where email = '$email'";
      $result= mysqli_query($conn,$query);
      if(mysqli_num_rows($result)== 1){
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['CustomerID']; 
        $user_name = $user['Name'];
        $user_role= $user['role'];
        $oldpassword = $user['password'];
        $verify= password_verify($password, $oldpassword);
        

        // var_dump( $verify) ;
        if($verify){
          $_SESSION['user_id']=$user_id;
          $_SESSION['success']="welcome '$user_name'";
          if($user_role=='admin'){
            header('location:admin/view/layout.php');
          }else
        
            header('location:index.php');
            
        }
        else{
        
        $_SESSION['errors']='password not correct';
        // header('Location: '.$_SERVER['PHP_SELF']);exit;
      }
      
      }else{
        $_SESSION['errors']='email invalid';
        // header('Location: '.$_SERVER['PHP_SELF']);exit;
      }



  }

  // header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "login.php");
  // header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
// exit;
else{

header('Location: '.$_SERVER['PHP_SELF']);exit;
  
}


}
?>



<?php
          if (!empty($_SESSION['success'])) {
          ?> <div class="alert alert-success">
              <?php echo $_SESSION['success']; ?>
            </div><?php
                }
                unset($_SESSION['success']);
                if (!empty($_SESSION['errors'])) {
                 
                  ?> <div class="alert alert-danger">
                <?php echo $_SESSION['errors']; ?>
              </div>
          <?php
                  
                }
                unset($_SESSION['errors']);
          ?>
            <head>   
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
               </head>
              <div class="card-body px-5 py-5" style="background-color:darkgray;">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form  action= "<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" class="form-control p_input" name='email' >
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" class="form-control p_input" name='password' >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name ='remember me'> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn" name='login'>Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
                </form>
              </div>
              <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    //table user, product, cart ,, review comment , rating  = session
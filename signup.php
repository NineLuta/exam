
<?php

include "header.php";
require_once "inc/conn.php";
include "navbar.php";
?>




<?php
echo "herf";
if (isset($_POST['Signup'])) {
  
  $name=htmlspecialchars(trim($_POST["username"]));  
  $email=htmlspecialchars(trim($_POST["Email"]));  
  $password=$_POST["password"];  
  $phone=htmlspecialchars(trim($_POST["phone"]));  
  $address= htmlspecialchars(trim($_POST["Address"]));


  $errors= [];

if (empty($name)){
    $errors[]="your name is required";
}elseif (is_numeric($name)){
    $errors[]="your name must be string";
}elseif (strlen($name)<3){
    $errors[]="your name must be greater than 3 char";
}

if(empty($email)){
    $errors[]="your email is required";
}elseif(!is_string($email)){
    $errors[]="your email should't be numbers only! ";
}


if (empty($phone)){
    $errors[]="your phone is required";
  }elseif(!is_numeric($phone)){
    $errors[]="must be numeric";
  }
  

if(empty($password)){
    $errors[]="your password is required";
}elseif(strlen($password)<6){
    $errors[]="your password less than 6";
}


if (empty($address)){
    $errors[]="your address is required";
}



if(empty($errors)){
  $hashPassword = password_hash($password,PASSWORD_DEFAULT);
  $query = "INSERT INTO customers (`Name`,`Email`,`password`,`phone`,`Address`) VALUES
    ('$name','$email','$hashPassword','$phone','$address')";
    $result = mysqli_query($conn,$query);
    // var_dump($result);
    if($result)
    { $_SESSION['success']="registered successfully'";
        header("location:login.php");
    }else 
    {
       header('Location: '.$_SERVER['PHP_SELF']);exit;
    }
}else {
    $_SESSION['errors']=$errors;
    $_SESSION['username']=$name;
    $_SESSION['Email']=$email;
    $_SESSION['phone']=$phone;
    $_SESSION['Address']=$address;
    header('Location: '.$_SERVER['PHP_SELF']);exit;
  }
  
  //  header('Location: '.$_SERVER['PHP_SELF']);exit;
  
}




if (!empty($_SESSION['errors'])) {
  foreach($_SESSION['errors'] as $errors){
  ?> <div class="alert alert-danger">
    <?php 
    echo $errors;
    ?> </div> 

<?php
  } 
}
unset($_SESSION['errors']);
?>











              <div class="card-body px-5 py-5" style="background-color:darkgray;">
              <h3 class="card-title text-left mb-3">Register</h3>
                <form  action= "<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control p_input" name="username"value="<?php echo $_SESSION['username'] ?>" >
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control p_input" name="Email" value="<?php echo $_SESSION['Email'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control p_input" name="password" >
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control p_input" name="phone" value="<?php echo $_SESSION['phone'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control p_input" name="Address" value="<?php echo $_SESSION['Address'] ?>" >
                  </div>
              
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                    
                  <div class="text-center">
                    <button type="submit"  class="btn btn-primary btn-block enter-btn" name="Signup">Signup</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
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

    <?php include "footer.php" ?>
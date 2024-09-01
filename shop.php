
<?php   
    include 'header.php' ;
    include 'navbar.php';
    require_once "inc/conn.php";


if(isset($_POST["add"])){
    $quantity= $_POST["quantity"];
    $product_id= $_POST["product_id"];
    
}



$query="SELECT * FROM products ";
$result= mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0){
  $products= mysqli_fetch_all($result,MYSQLI_ASSOC);

}
?>



    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modren Desgin</p>
        <div class="pro-container">
            
        <?php foreach($products as $product ) {?>
            <div class="pro">
                <img src="admin/assets/images/img/<?php echo $product['image']; ?>" alt="p1" />
                <div class="des">
                <h2><?php echo $product['Name']; ?></h2>
                    <h5><?php echo $product['Description']; ?> </h5>
                    <!-- <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div> -->
                    <h4><?php echo $product['Price']."$"; ?></h4>
                    <form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type='hidden' name='product_id' value='<?php echo $product['ProductID'] ;?>'/> 
                        <input type="number" name="quantity" value="1">
                        <button type="submit"><a class="cart" name="add"> <i class="fas fa-shopping-cart "></i></a></button>
                    </form>
                </div>
            </div>
        <?php } ?>
             
           
        </div>
    </section>
    


<section id="pagenation" class="section-p1">
    <nav aria-label="Page navigation example" >
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="shop.php" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1 of 2 </a></li>

            <li class="page-item">
                <a class="page-link" href="shop.php?" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>

</section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext ">
            <h4>Sign Up For Newletters</h4>
            <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
        </div>
        <div class="form ">
            <input type="text " placeholder="Enter Your E-mail... ">
            <button class="normal ">Sign Up</button>
        </div>
    </section>


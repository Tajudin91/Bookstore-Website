<?php

include 'conn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added to Cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product Added to Cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TheBookDweeb | No 1 Bookstore In Malaysia</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" type="image/x-icon" href="images/bookstore-favicon.png">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Create Your Own Personal Library</h3>
      <p>Learn Why We Are the Best of the Best!</p>
      <a href="about.php" class="white-btn">Learn More</a>
   </div>

</section>

<section class="products">

   <h1 class="title">New Releases</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('Query Failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">RM&nbsp;<?php echo $fetch_products['price']; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">No Books Added Yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">See More</a>
   </div>

</section>

<section class="reviews">

   <h1 class="title">TESTIMONIALS</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/shah-rukh-khan.jpg" alt="">
         <p>Bollywood Actor</p>
         <p>"I bought several books from the physical and online store. The service is top-notch!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Shah Rukh Khan</h3>
      </div>

      <div class="box">
         <img src="images/mira-filzah.png" alt="">
         <p>Malaysian Actress</p>
         <p>"The shipping is fast! The website user interface is very simple and easy to navigate!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Mira Filzah</h3>
      </div>

      <div class="box">
         <img src="images/chris-pratt.png" alt="">
         <p>Hollywood Actor</p>
         <p>"The books are frequently updated! I especially love the fiction section!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Chris Pratt</h3>
      </div>

   </div>

</section>



<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-us-banner.jpg" alt="">
      </div>

      <div class="content">
         <h3>About Us</h3>
         <p>
            On 2008, TheBookDweeb started as a very small operation located in the outskirt of Taman Melawati. They began by selling fictional and kids book before
            getting an offer to open a retail in Pelangi Indah Mall in Melawati. That started a new era for TheBookDweeb.
         </p>
         <p>
            Our mission is to create, inspire and empower readers and to inculcate the reading habit by making books accessible to and affordable for all. 
            We are industry icons, set on reinventing the book industry.
         </p>
         <a href="about.php" class="btn">Read More</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Why Don't You Talk To Us?</h3>
      <p>We Are Here To Assist You in Any Way You Want!</p>
      <a href="contact.php" class="white-btn">Contact Us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
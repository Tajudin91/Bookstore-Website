<?php

include 'conn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('Query Failed');

   if($cart_total == 0){
      $message[] = 'Your Cart is Empty!';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order Already Placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('Query Failed');
         $message[] = 'Order Placed Succesfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout | TheBookDweeb</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" type="image/x-icon" href="bookstore-favicon.png">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="color: white;">Checkout</h3>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Query Failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'RM'.$fetch_cart['price'].' '.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Your Cart is Empty!</p>';
   }
   ?>
   <div class="grand-total"> Total : <span>RM<?php echo $grand_total; ?></span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place Your Order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" required placeholder="Enter Your Name">
         </div>
         <div class="inputBox">
            <span>Phone Number :</span>
            <input type="number" name="number" required placeholder="Enter Phone Number">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="Email Address">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method">
               <option value="cash on delivery">COD</option>
               <option value="credit card">Credit Card</option>
               <option value="paypal">E-wallet</option>
               <option value="paytm">ToyyibPay</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address:</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. House No">
         </div>
         <div class="inputBox">
            <span>Address:</span>
            <input type="text" name="street" required placeholder="e.g. Road Name">
         </div>
         <div class="inputBox">
            <span>City:</span>
            <input type="text" name="city" required placeholder="e.g. Kuala Lumpur">
         </div>
         <div class="inputBox">
            <span>State:</span>
            <input type="text" name="state" required placeholder="e.g. Selangor">
         </div>
         <div class="inputBox">
            <span>Country:</span>
            <input type="text" name="country" required placeholder="e.g. Malaysia">
         </div>
         <div class="inputBox">
            <span>Postcode:</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 86900">
         </div>
      </div>
      <input type="submit" value="Order Now" class="btn" name="order_btn">
   </form>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
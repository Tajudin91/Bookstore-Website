<?php

include 'conn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('Query Failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message is sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('Query Failed');
      $message[] = 'Message Sent Successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us | TheBookDweeb</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" type="image/x-icon" href="bookstore-favicon.png">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Contact Us</h3>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>How Can We Help You?</h3>
      <input type="text" name="name" required placeholder="Enter Your Name" class="box">
      <input type="email" name="email" required placeholder="Email Address" class="box">
      <input type="number" name="number" required placeholder="Phone Number" class="box">
      <textarea name="message" class="box" placeholder="Message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Send Message" name="send" class="btn">
   </form>

</section>








<?php include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>
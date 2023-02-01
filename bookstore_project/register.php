<?php

include 'conn.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('Query Failed!');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User Already Exist! Please Sign In!';
   }else{
      if($pass != $cpass){
         $message[] = 'Passwords do not match!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('Query Failed!');
         $message[] = 'Registered Successfully!';
         header('location:login.php');
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
   <title>Sign Up | TheBookDweeb</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" type="image/x-icon" href="images/bookstore-favicon.png">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Sign Up Now</h3>
      <input type="text" name="name" placeholder="Name" required class="box">
      <input type="email" name="email" placeholder="Email Address" required class="box">
      <input type="password" name="password" placeholder="Password" required class="box">
      <input type="password" name="cpassword" placeholder="Retype Password" required class="box">
      <select name="user_type" class="box">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>Already have an account? <a href="login.php">Sign in here!</a></p>
   </form>

</div>

</body>
</html>
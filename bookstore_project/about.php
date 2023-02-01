<?php

include 'conn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us | TheBookDweeb</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" type="image/x-icon" href="images/bookstore-favicon.png">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="color: white;">About Us</h3>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-us.jpg" alt="">
      </div>

      <div class="content">
         <h3>Why We Are the Best?</h3>
                     <p>
                        On 2008, TheBookDweeb started as a very small operation located in the outskirt of Taman Melawati. They began by selling fictional and kids book before
                         getting an offer to open a retail in Pelangi Indah Mall in Melawati. That started a new era for TheBookDweeb.
                     </p>
                     <p>
                        Our mission is to create, inspire and empower readers and to inculcate the reading habit by making books accessible to and affordable for all. 
                        We are industry icons, set on reinventing the book industry.
                     </p>

                     <p>
                        In the early 2000, we embarked on our journey into the e-commerce world by launching our very own e-commerce store, TheBookDweeb. 
                        Being the first book retailer in Malaysia to venture into the e-commerce business, TheBookDweeb vision of creating a borderless, 
                        online bookstore has allowed us to reach customers in places where we had no physical presence. Since then, TheBookDweeb has succeeded in delivering
                         the retail experience right to the doorsteps of customers, fulfilling the need for convenience, speed, efficiency and reliability of our services.
                     </p>

                     <p>
                        We believe local bookstores are essential community hubs that foster culture, 
                        curiosity, and a love of reading, and we're committed to helping them thrive. Every purchase on the site financially supports 
                        independent bookstores. Our platform gives independent bookstores tools
                        to compete online and financial support to help them maintain their presence in local communities.
                     </p>
         <a href="contact.php" class="btn">Get in Touch!</a>
      </div>

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


<?php include 'footer.php'; ?>

<!-- JS link -->
<script src="js/script.js"></script>

</body>
</html>
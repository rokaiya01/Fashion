<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fashion Forward</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-1.jpg" alt="">
         </div>
         <div class="content">
            <span>Upto 90% Off</span>
            <h3>Latest Dress</h3>
            <a href="category.php?category=women" class="btn">Shop Now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-2.jpg" alt="">
         </div>
         <div class="content">
            <span>Upto 50% off</span>
            <h3>Trending Footwear</h3>
            <a href="category.php?category=footwear" class="btn">Shop Now.</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-3.jpg" alt="">
         </div>
         <div class="content">
            <span>upto 80% off</span>
            <h3>Elegant jewellery</h3>
            <a href="category.php?category=jewel" class="btn">Shop Now.</a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-4.jpg" alt="">
         </div>
         <div class="content">
            <span>upto 60% off</span>
            <h3>Popular Dress</h3>
            <a href="category.php?category=man" class="btn">Shop Now.</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading" style="color:pink;font-family:cursive">Shop by Category</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=women" class="swiper-slide slide">
      <img src="images/icon-1.jpg" alt="Women">
      <h3>Women Dress</h3>
   </a>

   <a href="category.php?category=man" class="swiper-slide slide">
      <img src="images/icon-2.jpg" alt="Men">
      <h3>Men Fashion</h3>
   </a>

   <a href="category.php?category=kid" class="swiper-slide slide">
      <img src="images/icon-3.jpg" alt="Kids">
      <h3>Kids Fashion</h3>
   </a>

   <a href="category.php?category=cosmetic" class="swiper-slide slide">
      <img src="images/icon-4.jpg" alt="Cosmetics">
      <h3>Cosmetics</h3>
   </a>

   <a href="category.php?category=jewel" class="swiper-slide slide">
      <img src="images/icon-5.jpg" alt="Jewellery">
      <h3>Jewellery</h3>
   </a>

   <a href="category.php?category=footwear" class="swiper-slide slide">
      <img src="images/icon-6.jpg" alt="Footwear">
      <h3>Footwear</h3>
   </a>

   <a href="category.php?category=bag" class="swiper-slide slide">
      <img src="images/icon-7.jpg" alt="Bag">
      <h3>Handbags</h3>
   </a>

   <a href="category.php?category=accessory" class="swiper-slide slide">
      <img src="images/icon-8.jpg" alt="Acessories">
      <h3>Acessories</h3>
   </a>
   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">Latest products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>₹ </span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOGUE</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="navbar.css" />
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="img/voguelogo.png" width="100px">
        </div>
        <nav>
            <ul>
                <li><a href="userHomePage.php">HOME</a></li>
                <li><a href="store.php">PRODUCTS</a></li>
                <?php session_start(); if (!isset($_SESSION['user'])): ?>
                    <!-- Show SIGNIN & SIGNUP if user is not logged in -->
                    <li><a href="userlogin.php">SIGNIN & SIGNUP</a></li>
                <?php else: ?>
                    <!-- Show PROFILE if user is logged in -->
                    <li><a href="AddcartView.php">ADD TO CART</a></li>
                    <li><a href="userProfile.php">PROFILE</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                <?php endif; ?>
                <li><a href="#about">ABOUT</a></li>
                
            </ul>
        </nav>
	</div>
    <section class="home" id="home">
        <div class="content">
        <h3><span>Welcome to</span> Vogue Boutique</h3>
            <a href="#shop" class="btn">shop now</a>
        </div>
        
    </section>
    <section class="plan" id="plan">
      <h1 class="heading">Offers and <span>Promos</span></h1>

      <div class="box-container">
        <div class="box">
          <h3 class="title">Hot</h3>
          <h3 class="day">Limited Bundle</h3>
          <i class="fas fa-clock"></i>
          <div class="list">
            <p>one selected Batik wear <span class="fas fa-check"></span></p>
            <p>two tradition wools<span class="fas fa-check"></span></p>
            <p>three day delivery <span class="fas fa-check"></span></p>
            <p>Cash on Delivery <span class="fas fa-check"></span></p>
          </div>
          <div class="amount"><span>Rs.</span>6,000</div>
        </div>

        <div class="box">
          <h3 class="title">Sale</h3>
          <h3 class="day">20% Off</h3>
          <i class="fas fa-dollar icon"></i>
          <div class="list">
            <p>any selected batik wear <span class="fas fa-check"></span></p>
            <p>no return <span class="fas fa-check"></span></p>
            <p>Card payments only <span class="fas fa-check"></span></p>
            <p>one-two day delivery <span class="fas fa-check"></span></p>
          </div>
          <div class="amount"><span>from Rs.</span>10,000</div>
        </div>


        <div class="box">
          <h3 class="title">New</h3>
          <h3 class="day">Free Delivery</h3>
          <i class="fas fa-car-side icon"></i>
          <div class="list">
            <p>order within today <span class="fas fa-check"></span></p>
            <p>orders on all ranges <span class="fas fa-check"></span></p>
            <p>Cash on delivery <span class="fas fa-check"></span></p>
            <p>One-Two day delivery <span class="fas fa-check"></span></p>
          </div>
        </div>
      </div>
    </section>
    <section class="shop" id="shop">
          <h1 class="heading">Our Products</h1>
          <h2 onclick="window.location.href='store.php?search=&gender=Men'">Men &#10151;</h2>
          <div class="product-container">
              <?php 
                  $conn = mysqli_connect("localhost", "root", "", "vogue");
                  if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                  }
                  $sql = "SELECT * FROM dresses WHERE gender = 'Men' LIMIT 3";
                  $result = mysqli_query($conn, $sql);
                  if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <div class="product-item">
                  <div class="image-container">
                      <img src="<?php echo '../admin/dress_images/' . htmlspecialchars($row['image_one']); ?>" class="main-image" alt="Main Dress Image">
                  </div>
                  <div class="content">
                      <h3 class="card__title4"><?php echo htmlspecialchars($row['dress_name']); ?></h3>
                      <h3 class="card__title41">Rs <?php echo htmlspecialchars($row['dress_price']); ?>.00</h3>
                      <form action="productsview.php?dress_id=<?php echo htmlspecialchars($row['id']); ?>" method="post">
                          <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                          <input type="submit" value="Visit" class="btns" />
                      </form>
                  </div>
              </div>
              <?php
                      }
                  } else {
                      echo "<p>No products found.</p>";
                  }
              ?>
          </div>
          <h2 onclick="window.location.href='store.php?search=&gender=Women'">Women &#10151;</h2>
          <div class="product-container">
              
              <?php 
                  $sql = "SELECT * FROM dresses WHERE gender = 'Women' LIMIT 3";
                  $result = mysqli_query($conn, $sql);
                  if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <div class="product-item">
                  <div class="image-container">
                      <img src="<?php echo '../admin/dress_images/' . htmlspecialchars($row['image_one']); ?>" class="main-image" alt="Main Dress Image">
                  </div>
                  <div class="content">
                      <h3 class="card__title4"><?php echo htmlspecialchars($row['dress_name']); ?></h3>
                      <h3 class="card__title41">Rs <?php echo htmlspecialchars($row['dress_price']); ?>.00</h3>
                      <form action="productsview.php?dress_id=<?php echo htmlspecialchars($row['id']); ?>" method="post">
                          <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                          <input type="submit" value="Visit" class="btns" />
                      </form>
                  </div>
              </div>
              <?php
                      }
                  } else {
                      echo "<p>No products found.</p>";
                  }
              ?>
          </div>
          <h2 onclick="window.location.href='store.php?search=&gender=Children'">Children &#10151;</h2>
          <div class="product-container">
              
              <?php 
                  $sql = "SELECT * FROM dresses WHERE gender = 'Children' LIMIT 3";
                  $result = mysqli_query($conn, $sql);
                  if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <div class="product-item">
                  <div class="image-container">
                      <img src="<?php echo '../admin/dress_images/' . htmlspecialchars($row['image_one']); ?>" class="main-image" alt="Main Dress Image">
                  </div>
                  <div class="content">
                      <h3 class="card__title4"><?php echo htmlspecialchars($row['dress_name']); ?></h3>
                      <h3 class="card__title41">Rs <?php echo htmlspecialchars($row['dress_price']); ?>.00</h3>
                      <form action="productsview.php?dress_id=<?php echo htmlspecialchars($row['id']); ?>" method="post">
                          <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                          <input type="submit" value="Visit" class="btns" />
                      </form>
                  </div>
              </div>
              <?php
                      }
                  } else {
                      echo "<p>No products found.</p>";
                  }
                  mysqli_close($conn);
              ?>
          </div>
      </section>


    <section class="about" id="about">
        <div class="image">
            <img src="img/DressShop.jpg" style="border-radius: 10px" alt="" />
        </div>

        <div class="content">
            <h3>premium <span>batik</span> Distributor</h3>
            <p>
            Welcome to our website dedicated to Batik wear.Viztoza is a clothing
            platform Established in 2022 to provide tremendous batik wear with a
            taste of elegancy and class!Viztoza is confronted in Hand-knitted
            Batik Wear , Knitted by the finest artists in Asia.THe fabrication is
            not just Quality but it also a voice of style and fashion.Located in
            the heart of Matara and shared across the island.
            </p>
        </div>
        </section>

        <div class="dog-food">
        <div class="image">
            <img src="img/Offer.png" style="border-radius: 10px" alt="" />
        </div>

        <div class="content">
            <h3><span>What do</span> We Offer?</h3>
            <p>
            Still Struggling to find that right fit? We got you covered!! Viztoza
            offers range of batik wear freshly Knitted and stiched to neet all
            your needs, THe premium batik we provide are concentrated towards to
            all the women out of there with different styles and fashions to meet
            your expectations and standards.In Addition, we are providing Delivery
            services Islandwide with 24/7 operating agents ready for inquiries
            along with secure payment methods and quick delivery to all our
            beloved customers.The batik attires derives from our talented artists
            pouring all the colors of the world to there needles and to our shop
            striahgt to your doorsteps.
            </p>
            <div class="amount">Starting at Rs.2000 Onwards</div>
        </div>
        </div>

        <div class="dog-sup">
        <div class="image">
            <img src="img/delivery.avif" style="border-radius: 10px" alt="" />
        </div>

        <div class="content">
            <h3>delivery <span> process </span></h3>
            <p>
            We understand the importance of fast delivery therefore look out we
            are providing delivery within 24/hrs to selected areas.For regions
            outside the capital city the estimated delivery time would be of two
            to three working days.Delivery is handled by our master couriers who
            have provided service for over two years and is the best hands to
            entrust your package.
            </p>
        </div>
        </div>

        <div class="dog-aso">
        <div class="image">
            <img src="img/Policy.jpg" style="border-radius: 10px" alt="" />
        </div>

        <div class="content">
            <h3><span> complains/return </span> Policy</h3>
            <p>
            An complain? we truely ask for your pardon on the bruise we have
            caused and we aim to make it right by proper compensation and provide
            a better service.To make a complaint please refer to the "contact"
            page and fill up the relevant details to submit an complain,The
            submitted complain will be reviewed by our agents and relevant agent
            will contact you with pardon. returns will be accepted however note
            that proper inspection of the good will be done by our agents to make
            sure reliability and after two to three working days the return will
            be accepted and immediately money back process will be applied.
            </p>
            <div class="amount">
            NOTE THAT RETURN IS ONLY FOR 7 DAYS AFTER PURCHASE
            </div>
        </div>
        </div>
    </section>
    <section class="services" id="services">
      <h1 class="heading">our <span>services</span></h1>

      <div class="box-container">
        <div class="box">
          
          <h3>Premium Batik</h3>
            <p>
            the Finest batik in Sri lanka at your fingertips
            </p>
        </div>


        <div class="box">
          
          <h3>24/7 assistant</h3>
          <p>
            Help and support is open for customers 24/7 to recieve help and
          assistant from our agents via direct hotline or emails.
          </p>
        </div>

        <div class="box">
          
          <h3>Security Payment</h3>
          <p>
          Secure payment structure with Cash-in-Hand accessability to our
          customers.
          </p>
        </div>

        <div class="box">
          
          <h3>Money back Gurantee</h3>
          <p>
          100% guranteed money return policy to customers within 2-3 Working
          days.
          </p>
        </div>

        <div class="box">
          
          <h3>coperate orders</h3>
          <p>
          Handling coperate orders for batik wear with bulk discounts and
            installment access.
          </p>
        </div>

        <div class="box">
          
          <h3>Incentives</h3>
          <p>
          Stay tune for Pop up offers and seasonal discounts with varity of
          promotions.
          </p>
        </div>
      </div>
    </section>
</body>
</html>

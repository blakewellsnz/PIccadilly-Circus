<?php
session_start();
include_once("config.php");
?>

<!DOCTYPE html>
<head>
  <title>Piccadilly Circus</title>
  <!-- My css -->
  <link rel="stylesheet" href="css/main.css"/>

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>

</head>
<body>
  <div class="container">
    <header>
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          <img src="images/logo.jpg" class="img-responsive logo">
        </a>
          <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
            <i class="fa fa-bars fa-2x"></i>
          </button>
          <div class="collapse navbar-collapse navHeaderCollapse nav">
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-item"><a href="index.html">Home</a></li>
              <li class="nav-item"><a href="products.html">Products</a></li>
              <li class="nav-item"><a href="about.html">About</a></li>
              <li class="nav-item"><a href="contact.html">Contact</a></li>
              <li class="nav-item visible-xs"><a href="view_cart.php">View Cart <i class="fa fa-shopping-cart"></i></a></li>
            </ul>
          </div>
          <div class="hidden-xs">
            <br/>
            <p class="pull-right">
            <?php
            if(isset($_SESSION["products"]))
            {   
                $total = 0;
                foreach ($_SESSION["products"] as $cart_itm)
                {
                        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
                        $total = ($total + $subtotal);
                        }
                    echo '<span class="check-out-text"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">View Cart</a></span>';
            }else{
                    echo 'Your cart is empty';
                }   
            ?>
            
            </p>
          </div>
        </div>
      </div>
    </header>
  </div>
    <hr class="header-hr"/>
    <div class="header-image">
    </div>
    <hr class="header-hr"/>
  <div class="container">
    <h3 class="text-center">Products</h3>
    <hr class="seperator"/>
    <div class="row">
      <div class="col-md-4 text-center">
    <?php
    // current URL of he page. cart_update.php redirects back to this URL
    $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
        $results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
        if ($results) {
            // outputs results from database
            while($obj = $results->fetch_object())
            { ?>
               <div class="product">
                <form method="post" action="cart_update.php">
                <div class="product-thumb"><img src="images/<?php echo $obj->product_img_name ?>" class="img-responsive"></div>
                <div class="product-content"><h3><?php echo $obj->product_name ?></h3></div>
                <div class="product-desc"><?php echo $obj->product_desc ?></div>
                <div class="product-info">
			          Price <?php echo $currency.$obj->price ?> | 
                Qty <select name="product_qty">
                            <option name="product_qty" value="1">1</option>
                            <option name="product_qty" value="2">2</option>
                            <option name="product_qty" value="3">3</option>
                            <option name="product_qty" value="4">4</option>
                          </select>
			          <button class="add_to_cart">Add To Cart</button>
			          </div></div>
                <input type="hidden" name="product_code" value="<?php echo $obj->product_code ?>" />
                <input type="hidden" name="type" value="add" />
                <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                </form>
        </div>
           <?php }
        }
    
    
    
    ?>
     </div>
    </div>
    <!--
    <div class="col-xs-12 col-md-4 product">
      <a href="products/marmite-jar.html"><img src="images/marmite-jar.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/marmite-jar.html">Marmite Jar - $7.99</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/tango-apple.html"><img src="images/tango-apple.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/tango-apple.html">Tango Apple - $2</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/tango-orange.html"><img src="images/tango-orange.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/tango-orange.html">Tango Orange - $2</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/marmite-squeeze.html"><img src="images/marmite-squeeze.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/marmite-squeeze.html">Marmite Squeeze - $9.99</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/walkers-ready-salted.html"><img src="images/walkers-ready-salted.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/walkers-ready-salted.html">Walkers Crisps (Ready Salted) - $1.50</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/walkers-tomato-ketchup.html"><img src="images/walkers-tomato-ketchup.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/walkers-tomato-ketchup.html">Walkers Crisps (Tomato Ketchup) - $1.50</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/walkers-cheese-and-onion.html"><img src="images/walkers-cheese-and-onion.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/walkers-cheese-and-onion.html">Walkers Crisps (Cheese and Onion) - $1.50</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/walkers-prawn-cocktail.html"><img src="images/walkers-prawn-coctail.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/walkers-prawn-cocktail.html">Walkers Crisps (Prawn Cocktail) - $1.50</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/smiths-frazzles.html"><img src="images/smiths-frazzles.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/smiths-frazzles.html">Frazzles - $1.50</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/haribo-starmix.html"><img src="images/haribo-starmix.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/haribo-starmix.html">Haribo Starmix - $3.00</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/haribo-tangfastics.html"><img src="images/haribo-tangfastics.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/haribo-tangfastics.html">Haribo Tangfastics - $3.00</a></p>
    </div>
    <div class="col-xs-12 col-md-4 product">
      <a href="products/haribo-colas.html"><img src="images/haribo-colas.jpg" class="img-responsive text-center"><br/>
      <p class="text-center"><a href="products/haribo-colas.html">Haribo Happy Cola - $3.00</a></p>
    </div>
    -->
  </div>
  <footer class="footer">
    <div class="container">
      <div class="col-xs-6"></div>
      <div class="col-xs-6">
        <i class="fa fa-facebook-square fa-2x pull-right"></i>
        <i class="fa fa-envelope-o fa-2x pull-right"></i>
        <i class="fa fa-linkedin-square fa-2x pull-right"></i>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>




</html>
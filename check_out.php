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
              <li class="nav-item"><a href="products.php">Products</a></li>
              <li class="nav-item"><a href="about.html">About</a></li>
              <li class="nav-item"><a href="contact.html">Contact</a></li>
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
    <h3 class="text-center">Your Contact Details</h3>
    <hr class="seperator"/>
    <form class="col-xs-12 col-md-12" method="post" action="<?php mail ( 'blakewellsnz@gmail.com' , 'order has been placed' , 'message is here'); ?>">
      <div class="col-xs-12 col-md-6">
        <label for="first-name">First Name:</label>
        <input type="text" class="first-name"></input>
      </div>
      <div class="col-xs-12 col-md-6">
        <label for="last-name">Last Name:</label>
        <input type="text" class="last-name"></input>
      </div>
      <div class="col-xs-12 col-md-6">
        <label for="phone-number">Phone Number:</label>
        <input type="text" class="phone-number"></input>
      </div>
      <div class="col-xs-12 col-md-6">
        <label for="email-address">Email Address:</label>
        <input type="text" class="email-address"></input>
      </div>
      <div class="col-xs-12 text-center">
        <br/><br/>
        <button class="btn btn-success">Place Order <i class="fa fa-share"></i></button>
      </div>
    </form>
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
</body>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</html>
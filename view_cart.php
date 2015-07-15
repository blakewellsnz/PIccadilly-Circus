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
<?php
    if(isset($_SESSION["products"]))
    {
        $total = 0;
        echo '<form method="post" action="cart-update.php">';
        echo '<ul>';
        $cart_items = 0;
        foreach ($_SESSION["products"] as $cart_itm)
        {
           $product_code = $cart_itm["code"];
           $results = $mysqli->query("SELECT product_name,product_img_name,product_desc, price FROM products WHERE product_code='$product_code' LIMIT 1");
           $obj = $results->fetch_object();
           
            echo '<table>';
            echo '<tr class="row">';
            echo '<td class="col-xs-6">';
            echo '<h3>'.$obj->product_name.' (Code :'.$product_code.')</h3> ';
            echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
            echo '<div>'.$obj->product_desc.'</div>';
            echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">Remove</a></span>';
            echo '<div class="p-price">'.$currency.$obj->price.'</div>';
            echo '</td>';
            echo '<td class="col-xs-6 text-center">';
            echo '<img class="product-thumb pull-right" src="images/'.$obj->product_img_name.'">';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
            $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
            $total = ($total + $subtotal);

            echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->product_name.'" />';
            echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
            echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->product_desc.'" />';
            echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'" />';
            $cart_items ++;
            
        }
        echo '</ul>';
        echo '<span class="check-out-txt text-center">';
        echo '<strong>Total : '.$currency.$total.'</strong>  ';
        echo '</span>';
        echo '</form>';
        echo '<a href="check-out.php"><button class="btn btn-success">Continue to Contact Details</button></a>';
        
    }else{
        echo '<h3 class="text-center">Your Cart is empty <a href="products.php">shop now!</a></h3>';
    }
?>

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
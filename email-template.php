<?php
session_start();
include_once('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Piccadilly Circus - Invoice</title>
<link href="styles.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body itemscope itemtype="http://schema.org/EmailMessage">

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
     
            $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
            $total = ($total + $subtotal);

            echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->product_name.'" />';
            echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
            echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->product_desc.'" />';
            echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'" />';
            $cart_items ++;
            
        }
        
    }else{
        echo '<h3 class="text-center">Your Cart is empty <a href="products.php">shop now!</a></h3>';
    }
?>

<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" width="600">
			<div class="content">
				<table class="main" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="content-wrap aligncenter">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td class="content-block">
										<h1 class="aligncenter"><?php  ?></h1>
									</td>
								</tr>
								<tr>
									<td class="content-block">
										<h2 class="aligncenter">Thanks for purchasing at Piccadilly Circus</h2>
									</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
										<table class="invoice">
											<tr>
												<td>
													<table class="invoice-items" cellpadding="0" cellspacing="0">
														<?php foreach ($_SESSION["products"] as $cart_itm)
        														{ ?>
														<tr>
															<td><?php echo '<p>'.$obj->product_name.'</p> '; ?>
          													</td>
															<td class="alignright"><?php echo '<div class="p-qty"><p>Qty : '.$cart_itm["qty"].'</div>'; ?></p></td>
														</tr>
														<?php } ?>
														<tr class="total">
															<?php echo '<strong>Total : '.$currency.$total.'</strong>  '; ?>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
										123 Piccadilly Road, Christchurch
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer">
					<table width="100%">
						<tr>
							<td class="aligncenter content-block">Questions? Email <a href="mailto:">admin@piccadillycircus.nz</a></td>
						</tr>
					</table>
				</div></div>
		</td>
		<td></td>
	</tr>
</table>

</body>
</html>

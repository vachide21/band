<?php

session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>


<html>
<head><link rel="shortcut icon"  href="favicon.png" />

<link rel="stylesheet" type="text/css" href="style.css" />
<title>System Of A Down</title>
</head>

<body>
    <div id="page">
		
        <div id="header">
        	<h1>System Of A Down</h1>
            <ul>
           	 <li><a href="index.html">Home</a></li>
               	<li><a href="about.html">About</a></li>
                <li><a href="tours.html">Tours</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
  
        <div id="main">
        
        	<div class="main_top">

            
            	

            	<h1>About the band...</h1>
                 
                
                

            </div>
            
           	<div class="main_body">
            
            <p>
            <img name="soad.png" src="img/cd.png" width="350" height="250" alt="System of a Down CD" style="float:left" >
</p>
Steal This Album! is the third studio album by Armenian-American heavy metal band System of a Down, released on November 26, 2002 by American Recordings and Columbia Records. Produced by Rick Rubin and Daron Malakian, the album peaked at number 15 on the US Billboard 200.
  <p>
  
  <br><br><br><br><br><br><br><br><br><br><br><br>
   <?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php"><img src="img/cart-icon.png" width="76" height="67" /> <span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='003'");
$row = mysqli_fetch_assoc($result);

		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  
			  <button type='submit' class='buy'>Buy Now</button>

			  </form>
		   	  </div>";
        
mysqli_close($con);
?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
  </p>
            </div>
            
           	<div class="main_bottom"></div>
            
        </div>
        
        
        
        <div id="footer">
       
        </div>
        
        </div>
</body>
</html>

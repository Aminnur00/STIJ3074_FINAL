<?php
include_once("dbconnect.php");
session_start();
$useremail = "Guest";
if (isset($_SESSION['sessionid'])) {
    $useremail = $_SESSION['email'];
}else{
   echo "<script>alert('Please login or register')</script>";
   echo "<script> window.location.replace('login.php')</script>";
}
if (isset($_GET['submit'])) {
    if ($_GET['submit'] == "add"){
        $foodid = $_GET['id'];
        $qty = $_GET['qty'];
        $cartqty = $qty + 1 ;
        $updatecart = "UPDATE `tbl_carts` SET `cart_qty`= '$cartqty' WHERE email = '$useremail' AND id = '$foodid'";
        $conn->exec($updatecart);
        echo "<script>alert('Cart updated')</script>";
    }
    if ($_GET['submit'] == "remove"){
        $foodid = $_GET['id'];
        $qty = $_GET['qty'];
        if ($qty == 1){
            $updatecart = "DELETE FROM `table_carts` WHERE email = '$useremail' AND id = '$foodid'";
            $conn->exec($updatecart);
            echo "<script>alert('Item removed')</script>";
        }else{
            $cartqty = $qty - 1 ;
            $updatecart = "UPDATE `table_carts` SET `cart_qty`= '$cartqty' WHERE email = '$useremail' AND id = '$foodid'";
            $conn->exec($updatecart);    
            echo "<script>alert('Removed')</script>";
        }
        
    }
}


$stmtqty = $conn->prepare("SELECT * FROM table_carts INNER JOIN table_product ON table_carts.id = table_product.id WHERE table_carts.email = '$useremail'");
$stmtqty->execute();
$resultqty = $stmtqty->setFetchMode(PDO::FETCH_ASSOC);
$rowsqty = $stmtqty->fetchAll();
foreach ($rowsqty as $carts) {
    $carttotal = 0;
    $carttotal = $carts['cart_qty'] + $carttotal;
}

function subString($str)
{
    if (strlen($str) > 15)
    {
        return $substr = substr($str, 0, 15) . '...';
    }
    else
    {
        return $str;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--ViewPort-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--W3css References-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../images/food/profile.png">
    <link rel="stylesheet" href="../css/style.css">
    <script src= "../javascript/script.js"></script>
    <script>
         function myFunction() {
            var x = document.getElementById("idnavbar");
            if (x.className.indexOf("w3-show") == -1){
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }  
        }
    </script>
    <style>
        body,html {height: 100%;}
        body,h1,h2,h3,h4,h5,h6 {font-family: 'Times New Roman', Georgia, serif;}
        
        @media screen and (min-width: 1920px) {
            body {
                max-width: 60%;
                margin: auto;
            }
        }
        .bgimg1 {
            background-position: center;
            background-size: cover;
            background-image: url("../images/header.jpg");
            min-height: 75%;
        }
    </style>
    <title>My Cart</title>
</head>
<body onload="loadCookies()">
    <!--Navbar on top-->
    <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="about.php" class="w3-bar-item w3-button">DAINTY BITES</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-right">REGISTER</a>
        <a href="#cart" class="w3-bar-item w3-button w3-hide-small w3-right">CART</a>
        <a href="payment_details.php" class="w3-bar-item w3-button w3-hide-small w3-right">PAYMENT HISTORY</a>
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-right">MENU</a>
        <a href="#about" class="w3-bar-item w3-button w3-hide-small w3-right">ABOUT US</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>


    <!--Right-sided navbar Dropdown menu. Shows on small screen-->
    <div id="idnavbar" class="w3-bar-block w3-sand w3-hide w3-hide-large w3-hide-medium">
        <a href="about.php" class="w3-bar-item w3-button w3-center">ABOUT US</a>
        <a href="#index.php" class="w3-bar-item w3-button w3-center">MENU</a>
        <a href="#contact" class="w3-bar-item w3-button w3-center">PAYMENT HISTORY</a>
        <a href="#location" class="w3-bar-item w3-button w3-center">CART</a>
        <a href="login.php" class="w3-bar-item w3-button w3-center">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-center">REGISTER</a>
    </div>

    <!--Page Header-->
    <header id="header" class="bgimg1 w3-display-container w3-greyscale-min">
        <div class="w3-display-middle w3-center">
            <h1 class="w3-text-black" style="font-size: calc(30px + 5vw);" style="text-shadow: 1px 1px #444;">Dainty Bites<br></h1>
            <h5 class="w3-cursive w3-text-black" style="font-size: calc(10px + 4vw);" style="text-shadow: 1px 1px #444;">-Delight in every bite-</h5>
        </div>
        <div class="w3-display-bottomright w3-center w3-padding-large w3-hide-small">
            <h4 class="w3-text-white w3-tag">Available at Temerloh and nearby area</h4>
        </div>
        <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
            <h4 class="w3-text-white w3-tag">Contact us to make order</h4>
        </div>
      </header>
    </div>

    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
        <div class="w3-container w3-center"><p>Cart for <?php echo $useremail?> </p></div><hr>
        <div class="w3-grid-template">
             <?php
             
             $total_payable = 0.00;
                foreach ($rowsqty as $food){
                    $foodid = $food['id'];
                    $food_name = subString($food['name']);
                    $food_price = $food['price'];
                    $food_qty = $food['cart_qty'];
                    $food_total = $food_qty * $food_price;
                    $total_payable = $food_total + $total_payable;
                    echo "<div class='w3-center w3-padding-small' id='itemcard_$foodid'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><a href='item_details.php?itemid=$foodid'><img class='w3-container w3-image' 
                    src=../images/food/$food_name.png onerror=this.onerror=null;this.src='../images/items/default.jpg'></a></div>
                    <b>$food_name</b><br>RM $food_price/unit<br>
                    <input type='button' class='w3-button w3-red' id='button_id' value='-' onClick='removeCart($foodid,$food_price);'>
                    <label id='qtyid_$foodid'>$food_qty</label>
                    <input type='button' class='w3-button w3-green' id='button_id' value='+' onClick='addCart($foodid,$food_price);'>
                    <br>
                    <b><label id='foodprid_$foodid'> Price: RM $food_total</label></b><br></div></div>";
                }
             ?>
        </div>
        <?php 
        echo "<div class='w3-container w3-padding w3-block w3-center'><p><b><label id='totalpaymentid'> Total Amount Payable: RM $total_payable</label>
        </b></p><a href='payment.php?email=$useremail&amount=$total_payable' class='w3-button w3-round w3-blue'> Pay Now </a> </div>";
        ?>

        <!--Footer-->

<footer class="w3-footer w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
</footer>

<script>
 function addCart(foodid, food_price) {
	jQuery.ajax({
		type: "GET",
		url: "mycartajax.php",
		data: {
			foodid: foodid,
			submit: 'add',
			foodprice: food_price
		},
		cache: false,
		dataType: "json",
		success: function(response) {
			var res = JSON.parse(JSON.stringify(response));
			console.log(res.data.carttotal);
			if (res.status = "success") {
				var foodid = res.data.foodid;
				document.getElementById("carttotalida").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("qtyid_" + itemid).innerHTML = res.data.qty;
				document.getElementById("foodprid_" + itemid).innerHTML = "Price: RM " + res.data.foodprice;
				document.getElementById("totalpaymentid").innerHTML = "Total Amount Payable: RM " + res.data.totalpayable;
			} else {
				alert("Failed");
			}

		}
	});
}

function removeCart(foodid, food_price) {
	jQuery.ajax({
		type: "GET",
		url: "mycartajax.php",
		data: {
			foodid: foodid,
			submit: 'remove',
			foodprice: food_price
		},
		cache: false,
		dataType: "json",
		success: function(response) {
			var res = JSON.parse(JSON.stringify(response));
			if (res.status = "success") {
				console.log(res.data.carttotal);
                if (res.data.carttotal == null || res.data.carttotal == 0){
				    alert("Cart empty");
				    window.location.replace("index.php");
                } else { 
				var foodid = res.data.foodid;
				document.getElementById("carttotalida").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("qtyid_" + itemid).innerHTML = res.data.qty;
				document.getElementById("foodprid_" + itemid).innerHTML = "Price: RM " + res.data.foodprice;
				document.getElementById("totalpaymentid").innerHTML = "Total Amount Payable: RM " + res.data.totalpayable;
				console.log(res.data.qty);
				if (res.data.qty==null){
				    var element = document.getElementById("itemcard_"+foodid);
				    element.parentNode.removeChild(element);
				}
                }
			} else {
				alert("Failed");
			}

		}
	});
}
</script>
</body>
</html>
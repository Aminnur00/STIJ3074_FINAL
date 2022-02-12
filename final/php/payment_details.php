<?php
include_once ("dbconnect.php");
session_start();
if (isset($_SESSION['sessionid']))
{
    $useremail = $_SESSION['email'];
}else{
    echo "<script>alert('Please login or register')</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

$receiptid = $_GET['receipt'];
$sqlquery = "SELECT * FROM table_orders INNER JOIN table_product ON table_orders.order_foodid = table_product.id WHERE table_orders.order_receiptid = '$receiptid'";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

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
    <title>Payment History</title>
</head>
<body onload="loadCookies()">
    <!--Navbar on top-->
    <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="about.php" class="w3-bar-item w3-button">DAINTY BITES</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-right">REGISTER</a>
        <a href="#cart" class="w3-bar-item w3-button w3-hide-small w3-right">CART</a>
        <a href="#payment" class="w3-bar-item w3-button w3-hide-small w3-right">PAYMENT HISTORY</a>
        <a href="#menu" class="w3-bar-item w3-button w3-hide-small w3-right">MENU</a>
        <a href="#about" class="w3-bar-item w3-button w3-hide-small w3-right">ABOUT US</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>


    <!--Right-sided navbar Dropdown menu. Shows on small screen-->
    <div id="idnavbar" class="w3-bar-block w3-sand w3-hide w3-hide-large w3-hide-medium">
        <a href="about.php" class="w3-bar-item w3-button w3-center">ABOUT US</a>
        <a href="#menu" class="w3-bar-item w3-button w3-center">MENU</a>
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
      
      <div class="w3-grid-template">
          
      <?php 
            $totalpaid = 0.0;
           foreach ($rows as $details)
            {
                $foodid = $details['id'];
                $item_title = subString($details['name']);
                $order_qty = $details['order_qty'];
                $order_paid = $details['order_paid'];
                $order_status = $details['order_status'];
                $totalpaid = ($order_paid * $order_qty) + $totalpaid;
               echo "<div class='w3-center w3-padding-small'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><img class='w3-container w3-image' 
                    src=../images/food/$name.jpg onerror=this.onerror=null;this.src='../images/items/default.jpg'></a></div>
                    <b>$name</b><br>RM $order_paid<br> $order_qty unit<br></div></div>";
             }
             
             $totalpaid = number_format($totalpaid, 2, '.', '');
            echo "</div><br><hr><div class='w3-container w3-left'><h4>Your Order</h4><p>Order ID: $receiptid<br>Email: $useremail <br> Total Paid: RM $totalpaid<p></div>";
            ?>
    </div>


<?php
include 'dbconnect.php';
session_start();
if (isset($_SESSION['sessionid'])){
    $useremail = $_SESSION['email'];
}

if (isset($_GET['submit'])){

    if ($_GET['submit'] == "cart"){
        if (!empty($useremail)){
            $foodid = $_GET['id'];
            $cartqty = "1";
            
                $addcart = "INSERT INTO `table_carts`(`email`, `id`, `cart_qty`) VALUES ('$useremail','$foodid','$cartqty')";
                try {
                    $conn->exec($addcart);
                    echo "<script>alert('Success')</script>";
                }catch(PDOException $e){
                    echo "<script>alert('Failed')</script>";
                }

            }
   
        }
    }




 $sqldata = "SELECT * FROM `table_product` ORDER BY id DESC";

 $results_per_page= 10;
 if (isset($_GET['pagenum'])) {
     $pagenum = (int)$_GET['pagenum'];

     $page_first = ($pagenum - 1) * $results_per_page;
  } else {
         $pagenum =1;
         $page_first = ($pagenum - 1) * $results_per_page;
     }

 $stmt = $conn->prepare($sqldata);
 $stmt->execute();
 $result_num = $stmt->rowCount();
 $num_page = ceil($result_num / $results_per_page);

 $stmt = $conn->prepare($sqldata);
 $stmt->execute();
 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 $rows = $stmt->fetchAll();

 ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--ViewPort-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--W3css References-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <title>Menu</title>
</head>
<body onload="loadCookies()">
    <!--Navbar on top-->
    <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="about.php" class="w3-bar-item w3-button">DAINTY BITES</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-right">REGISTER</a>
        <a href="mycart.php" class="w3-bar-item w3-button w3-hide-small w3-right">CART</a>
        <a href="payment_details.php" class="w3-bar-item w3-button w3-hide-small w3-right">PAYMENT HISTORY</a>
        <a href="#menu" class="w3-bar-item w3-button w3-hide-small w3-right">MENU</a>
        <a href="#about" class="w3-bar-item w3-button w3-hide-small w3-right">ABOUT US</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>


    <!--Right-sided navbar Dropdown menu. Shows on small screen-->
    <div id="idnavbar" class="w3-bar-block w3-sand w3-hide w3-hide-large w3-hide-medium">
        <a href="about.php" class="w3-bar-item w3-button w3-center">ABOUT US</a>
        <a href="#menu" class="w3-bar-item w3-button w3-center">MENU</a>
        <a href="#contact" class="w3-bar-item w3-button w3-center">PAYMENT HISTORY</a>
        <a href="mycart.php" class="w3-bar-item w3-button w3-center">CART</a>
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

    <div class="w3-center w3-padding-32 w3-dark-grey">
        <h1><strong>LIST OF PRODUCT</strong></h1>
</div>

<div class="w3-grid-template">
        <?php
        $cart = "cart";
        foreach ($rows as $food) {
            $foodid = $food['id'];
            $name = $food['name'];
            $description = $food['description'];
            $price = $food['price'];
            $quantity = $food['quantity'];
            echo "<div class='w3-center w3-padding'>";
            echo "<div class='w3-card-4 w3-dark-grey'>";
            echo "<header class='w3-container w3-sand'";
            echo "<h5><strong>$name</h5>";
            echo "</header>";
            echo "<div class='w3-padding'><a href= 'details.php?id=$foodid'><img class='w3-image' src=../images/food/$name.png" .
            " onerror=this.onerror=null;this.src='../images/food/profile.png'"
            . " '></div>";
            echo "<div class='w3-container w3-left-align'><hr>";
            echo "<p><i class='fa fa-id-card' style='font-size:16px'>
            </i>&nbsp&nbsp$description<br>
            <i class='fa fa-money' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$price<br>
            <i class='fa fa-dropbox' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$quantity<br>
            <a href= 'index.php?id=$foodid&submit=$cart' class='w3-btn w3-blue w3-round'>Add to Cart</a><br><br>";
        
            echo "</div>";
             echo "</div>";
             echo "</div>";
                      
         }
         ?>
         </div>

         <?php
         $num = 1;
         if ($pagenum == 1) {
             $num = 1;
         } else if ($pagenum == 2) {
             $num = ($num) + $results_per_page;
         } else {
             $num = $pagenum * $results_per_page - 6;
         }
         echo "<div class='w3-container w3-row'>";
         echo "<center>";
         for ($page = 1; $page <= $num_page; $page++) {
             echo '<a href = "main.php?pageno=' . $page . '" style=
             "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
         }
         echo " ( " . $pagenum . " )";
         echo "</center>";
         echo "</div>";
         ?>
     
     <!--Footer-->

<footer class="w3-footer w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
</footer>
<script>
 function addCart(foodid) {
	jQuery.ajax({
		type: "GET",
		url: "updatecartajax.php",
		data: {
			foodid: foodid,
			submit: 'add',
		},
		cache: false,
		dataType: "json",
		success: function(response) {
		    var res = JSON.parse(JSON.stringify(response));
		    console.log("HELLO ");
			console.log(res.status);
			if (res.status == "success") {
			    console.log(res.data.carttotal);
				//document.getElementById("carttotalida").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				alert("Success");
			}
			if (res.status == "failed") {
			    alert("Please login/register account");
			}
			

		}
	});
}
</script>

        </body>
        </html>

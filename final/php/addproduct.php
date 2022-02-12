<?php
    
    if(isset($_POST["submit"])){
        include 'dbconnect.php';
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $sqlregister = "INSERT INTO `table_product`(`name`, `description`, `price`, `quantity`)
         VALUES('$name', '$description', '$price', '$quantity')";
    
        try{
            $conn->exec($sqlregister);
            if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
                uploadImage($name);
                echo "<script>alert('Successfuly added')</script>";
                echo "<script>window.location.replace('index.php')</script>";
            }    
            
        }catch (PDOException $e) {
                echo"<script>alert('Failed to add')</script>";
                echo "<script>window.location.replace('addproduct.php')</script>";
            }
    }

        function uploadImage($id){
            $target_dir = "../images/food/";
            $target_file = $target_dir . $id . ".png";
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--ViewPort-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--W3css References-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-aswsome.min.css"> 
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
    <title>Add Product</title>
</head>
<body onload="loadCookies()">
    <!--Navbar on top-->
    <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="about.php" class="w3-bar-item w3-button">DAINTY BITES</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-right">REGISTER</a>
        <a href="#cart" class="w3-bar-item w3-button w3-hide-small w3-right">CART</a>
        <a href="#payment" class="w3-bar-item w3-button w3-hide-small w3-right">PAYMENT HISTORY</a>
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-right">MENU</a>
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

    <!--Add Product Form-->
    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
            <div class="w3-container w3-grey">
                <p>Add Product</p>
            </div>
            <form class="w3-container w3-padding " name="registerForm" action="addproduct.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin"
                    src="../images/food/profile.png" style="width:100%;
                    max-width:600px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload"
                    id="fileToUpload"><br>
                </div>

            <p>
                <label class="w3-text-black"><b>Product Name</b></label>
                <input class="w3-input w3-border w3-round" name="name" type="text" id="idname" required>
            </p>

            <p>
                <label class="w3-text-black"><b>Description</b></label>
                <input class="w3-input w3-border w3-round" name="description" type="text" id="iddescription" required>
            </p> 

            <p>
                <label class="w3-text-black"><b>Price</b></label>
                <input class="w3-input w3-border w3-round" name="price" type="text" id="idprice" required>
            </p>  

            <p>
                <label class="w3-text-black"><b>Quantity</b></label>
                <input class="w3-input w3-border w3-round" name="quantity" type="text" id="idquantity" required>
            </p> 

            <p>
                <button class='w3-btn w3-round w3-grey w3-block' name="submit">Add Product</button>
            </p>
    </form>
    </div>  
    </div>

<!--Footer-->

<footer class="w3-footer w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
</footer>

    </body>
</html>




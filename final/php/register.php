
<?php
if (isset($_POST["submit"])) {
    include 'dbconnect.php';
    if(isset($_POST['submit'])){  
        $email = $_POST["email"];
        $pass = sha1($_POST["password"]);
        $otp = rand(10000,99999);
        
//Check if the email is already exist
        $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0){
            echo '<script>alert("Email already exists. Please login or use another email ")</script>';
       }
       
      else{
//Insert the input into the database
        $sql = "INSERT INTO users (email, password, otp) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$email, $pass, $otp]);

        if ($result) {
            echo "<script>alert('Successfuly Sign Up. Please Log In');</script>";
            echo '<script>window.location.replace("login.php")</script>';
        } else {
            echo "<script>alert('Sign Up Failed');</script>";
        }
        } 
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-aswsome.min.css"> 
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
    <title>Register</title>
</head>
<body>
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

    <!--Sign UP Form-->
    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card w3-round">
            <div class="w3-container w3-sand w3-round">
                <h2>Sign Up</h2>
                <p>Welcome to Dainty Bites! Please fill in this form to create an account.</p>
    </div>
        <form name="signupForm" class="w3-container" action="register.php" method="post">
            <p>
                <label class="w3-text-black"><b>Email</b></label>
                <input class="w3-input w3-border w3-round" name="email" type="email" id="idremail" required>
            </p>

            <p>
                <label class="w3-text-black"><b>Password</b></label>
                <input class="w3-input w3-border w3-round" name="password" type="password" id="idrpassword" >
            </p>  

            <p>
                <label class="w3-text-black"><b>Repeat Password</b></label>
                <input class="w3-input w3-border w3-round" name="password1" type="password" id="idrpassword1" >
            </p> 

            <p>By creating an account you agree to our <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a></p>            </p>

            <p>
                <button class='w3-btn w3-round w3-sand w3-block' name="submit">Sign Up</button>
            </p>
            <p>Have an account? <a href="login.php">Log in</a></p>
    </form>
    </div>
    </div>

<!--Footer-->
<footer class="w3-container w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
</footer>

    </body>
</html>

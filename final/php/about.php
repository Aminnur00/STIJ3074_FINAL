<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--ViewPort-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--W3css References-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> <!--Icon References-->
    <style>
        body,html {height: 100%;}
        body,h1,h2,h3,h4,h5,h6 {font-family: 'Times New Roman', Georgia, serif;}
        
        @media screen and (min-width: 1920px) {
            body {
                max-width: 60%;
                margin: auto;
            }
        }
        .container {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%
        }

        .responsive-iframe {
            position: absolute;
            top: 0%;
            left: 0%;
            bottom: 0%;
            right: 0%;
            width: 100%;
            height: 100%;
            border: none;
        }

        .bgimg {
            background-position: center;
            background-size: cover;
            background-image: url("../images/header.jpg");
            min-height: 75%;
        }
    </style>
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
    <title>Dainty Bites</title>
</head>
<body>
    <!--Navbar on top-->
    <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="#home" class="w3-bar-item w3-button">DAINTY BITES</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-right">REGISTER</a>
        <a href="mycart.php" class="w3-bar-item w3-button w3-hide-small w3-right">CART</a>
        <a href="payment_details.php" class="w3-bar-item w3-button w3-hide-small w3-right">PAYMENT HISTORY</a>
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-right">MENU</a>
        <a href="#about" class="w3-bar-item w3-button w3-hide-small w3-right">ABOUT US</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>


    <!--Right-sided navbar Dropdown menu. Shows on small screen-->
    <div id="idnavbar" class="w3-bar-block w3-sand w3-hide w3-hide-large w3-hide-medium">
        <a href="#about" class="w3-bar-item w3-button w3-center">ABOUT US</a>
        <a href="index.php" class="w3-bar-item w3-button w3-center">MENU</a>
        <a href="payment_details.php" class="w3-bar-item w3-button w3-center">PAYMENT HISTORY</a>
        <a href="mycart.php" class="w3-bar-item w3-button w3-center">CART</a>
        <a href="login.php" class="w3-bar-item w3-button w3-center">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-center">REGISTER</a>
    </div>

    <!--Page Header-->
    <header id="header" class="bgimg w3-display-container w3-greyscale-min">
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


<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

    <!-- About Section --><!--Image Logo-->
    <div id="about" class="w3-row w3-padding-32">
      <div class="w3-col m6 w3-padding-24 w3-center" style="height: 300px;">
       <img src="../images/logo.jpeg" class="w3-round w3-image" alt="logo" width="300" height="300">
       
      </div>
        
      <div class="w3-col m6 w3-padding-32">
        <br>
          <h1 class="w3-center">About Dainty Bites</h1>
          <h3 class="w3-center">~Let us Create Joy For You~ </h3>
          <p class="w3-large">Dainty Bites is a food business managed by Miss. Nadrahtul Amirah with the help from her brothers and it was established in January 2020. This business do not have a physical store and all of the process from cooking to selling are made from home.
          The platform for this business is using social media such as Facebook, Instagram and WhatsApp. This business is located in her house in Temerloh, Pahang and also available in Car Boot Sales that held on every Saturday at Dataran Temerloh. <br>
        <br> Dainty Bites do not only focusing on one type of food only, instead, they sells various type of food such as brownies, cookies, chocolate jars, fruit juice and tauhu bergedil.   </p>
    </div>
    </div>
<hr>

<!--Menu content-->
<div id="menu" class="w3-container w3-row w3-padding-32 w3-sand">
    <div class="w3-col l6 w3-padding-32">
        <h1 class="w3-center">Our Menu</h1><br>
        <h3>Tauhu Begedil - RM6.00</h3>
        <p class="w3-cursive">5 pieces of Fried Tofu that consist of chopped meat, potatoes and fried onions.</p><br>
        <h3>Chocolate Brownies - RM30.00</h3>
        <p class="w3-cursive">Every bite you take will be bursting with chocolate flavors.</p><br>
        <h3>Chocolate Jars - RM10.00</h3>
        <p class="w3-cursive">Crispy coco jar filled with coco rice, coco ball and coco crunch. </p><br>
        <h3>Ayaq World Juice - RM10.00</h3>
        <p class="w3-cursive">Fresh fruit juice that will quench your thrist. </p>
    
</div>
    <!--Image menu-->
    <div class="w3-col l6 w3-padding-32 w3-center">
        <br><br><br>
        <img src="../images/tauhu.jpeg" class="w3-round w3-image" alt="menu" width="350" height="300">
    </div>
    <div class="w3-col l6 w3-padding-32 w3-center">
        <img src="../images/ayaq.jpeg" class="w3-round w3-image" alt="menu1" width="350" height="300">
    </div>
</div>
<hr>

<!--Contact Us Info-->
<div id="contact" class=" w3-container w3-padding-20 w3-center">
    <div class=" w3-padding-32 w3-center">
        <h1 class="w3-center">Contact Us</h1><br>
        <h3>Are You Hungry?<br> Come, order with us and we will deliver it to your location!<br></h3>
        <h3 class="w3-cursive">Operating Hours: Monday - Friday from 10.00am to 6.00pm<br> Location: Taman Temerloh Jaya, Temerloh</h3>
        </div>
</div>
<div id="contactinfo" class="w3-container w3-row w3-padding-20">
    <div class="w3-col l6 w3-padding-20">
        <h2 class="w3-center"> Contact Number</h2>
        <h3 class="w3-center">017-9061876 (Aminnur)<br> 011-37574814 (Amirah)</h3><br> 
    </div> 
    <div class="w3-col l6 w3-padding-20">
        <h2 class="w3-center">Email</h2>
        <h3 class="w3-center">daintybites@gmail.com</h3> 
    </div>
</div>
<hr>

<!--Contact Form-->
<div id="form" class="w3-container w3-row w3-padding-32 w3-sand">
    <div class=" w3-padding-32 w3-center">
        <h1 class="w3-center">Planning a special event? Write us here:</h1><br>
    
        <form action="contactus.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
            <h2 class="w3-center">Contact Us</h2>
            <div class="w3-row w3-section"> <!--Name Section-->
                <div class="w3-col" style="width: 50px;"> <i class="w3-xxlarge fa fa-user"></i></div>
                <div class="w3-rest">
                    <input class="w3-input w3-border" name="name" type="text" placeholder="Name">
                </div>
            </div>

            <div class="w3-row w3-section"> <!--Email Section-->
                <div class="w3-col" style="width: 50px;"> <i class="w3-xxlarge fa fa-envelope"></i></div>
                <div class="w3-rest">
                    <input class="w3-input w3-border" name="email" type="text" placeholder="Email">
                </div>
            </div>

            <div class="w3-row w3-section"> <!--Phone Section-->
                <div class="w3-col" style="width: 50px;"> <i class="w3-xxlarge fa fa-phone"></i></div>
                <div class="w3-rest">
                    <input class="w3-input w3-border" name="phone" type="number" placeholder="Contact Number">
                </div>
            </div>

            <div class="w3-row w3-section"> <!--Subject Section-->
                <div class="w3-col" style="width: 50px;"> <i class="w3-xxlarge fa fa-book"></i></div>
                <div class="w3-rest">
                    <input class="w3-input w3-border" name="subject" type="text" placeholder="Subject">
                </div>
            </div>

            <div class="w3-row w3-section"> <!--Message Section-->
                <div class="w3-col" style="width: 50px;"> <i class="w3-xxlarge fa fa-pencil"></i></div>
                <div class="w3-rest">
                    <textarea class="w3-input w3-border" id="idmessage" name="message" rows="4" cols="50" width="100%" placeholder="Please enter your message"></textarea>
                </div>
            </div>
            <button class="w3-button w3-block w3-section w3-blue w3-riplle w3-padding"> Send Message </button>
        </form>
</div>
</div><hr>

<!--Location-->
<div id="location" class=" w3-container w3-padding-32 w3-center">
    <div class=" w3-padding-32 w3-center">
        <h1 class="w3-center">Where To Find Us</h1>
        <div class="container">
        <iframe class="responsive-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.578896000635!2d102.39241924843739!3d3.452063508285401!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31ceb8fda2d7a0bf%3A0xdc858c076ba0889!2s47%2C%20Jln%20TJ%206%2F3%2C%20Taman%20Temerloh%20Jaya%2C%2028000%20Temerloh%2C%20Pahang!5e0!3m2!1sen!2smy!4v1636295591794!5m2!1sen!2smy" 
           width="auto" height="300" style="border: 0;" loading="lazy"></iframe>
        </div>
        <p>47, Jalan TJ 6/3, Taman Temerloh Jaya,<br>28000 Temerloh, Pahang</p>
        </div><hr>
</div>
</div>

<!--Footer-->
<footer class="w3-container w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
    
</footer>

</body>
</html>
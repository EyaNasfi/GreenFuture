<?php
include "../admin_page/config.php";


    
    if(isset($_GET['code'])) {
        
        $code = $_GET['code'];
        $db = config::getConnexion();


        $verifyQuery = $db->query("SELECT * FROM users WHERE code = '$code' and updated_time >= NOW() - Interval 1 DAY");
        $verifyQuery->execute();

        if($verifyQuery->rowCount() == 0) {
            header("Location: change_password.php");
            exit();
        }

        if(isset($_POST['change'])) {
            $email = $_POST['resetmail'];
            $new_password = md5($_POST['resetpass']);

            $changeQuery = $db->query("UPDATE users SET password = '$new_password' WHERE email = '$email' and code = '$code' and updated_time >= NOW() - INTERVAL 1 DAY");
            $changeQuery->execute();
            if($changeQuery) {
                header("Location: success.html");
            }
        }
        $db=NULL;
    }
    else {
        header("Location: changepassword.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cat gpt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyle.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Cat gpt</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="service.html">SERVICE</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
            </div>

            <div class="search">
                <input class="srch" type="search" name="" placeholder="search">
                <button class="btn">Search</button>
            </div>

        </div> 
        <div class="content">
            <h1>Welcome to  <br><span>GreenFuture</span></h1>
            <p class="par">your go-to source for sustainable and eco-friendly products. <br>
                Our mission is simple: <br>
                to help create a greener future by replacing traditional products with eco-friendly alternatives.<br>
                We believe that small changes can make a big impact,<br> and by choosing products that are good for the environment,<br>
                we can all contribute to a healthier planet. Whether you're looking for reusable bags,<br>
                non-toxic cleaning supplies, or energy-efficient appliances, we've got you covered.<br>
                Join us in the journey towards a more sustainable future, one product at a time.</p>

                <button class="cn"><a href="signup.php">JOIN US</a></button>

                <div class="form">
                    <form method="POST" action="">
                        <p>Please Insert Needed Informations</p>
                        <input type="email" name="resetmail" id="resetmail" placeholder="Enter Email " required>
                        <input type="password" name="resetpass" id="resetpass" placeholder="Enter New Password" required>
                        <button type="submit" class="btnn" name="change">Change</button>
                    </form>

                    <p class="link">Don't have an account<br>
                    <a href="signup.php">Sign up </a> here</p>
                   <br>

                   <div class="icons">
                        <p class="link">Already have an Account ?<br>
                        <a href="index.php">Log In </a> here</p>
                        </div>

                </div>
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>

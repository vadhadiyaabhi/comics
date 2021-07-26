<?php

    session_start();
    $var = false;

    if(isset($_POST['submit']))
    {
        require 'dbconnect.php';
        
        $email = isset($_POST['email']) ? mysqli_real_escape_string($con,$_POST['email']) : '';
        $fname = isset($_POST['fname']) ? mysqli_real_escape_string($con,$_POST['fname']) : '';
        $lname = isset($_POST['lname']) ? mysqli_real_escape_string($con,$_POST['lname']) : '';

        $otp = rand(100000,999999);
        $_SESSION['otp'] = $otp;

        $q = "SELECT email from email_info WHERE email = '$email'";
        $result = mysqli_query($con,$q);
        $num = mysqli_num_rows($result);
        if($num > 0){
            $var = true;
        }

        else{
            $que = "INSERT INTO email_info (fname, lname, email,status) VALUES ('$fname', '$lname', '$email', 'inactive')";
            $result = mysqli_query($con,$que);
            if($result)
            {
                $random = rand(1,999);
                echo $random;

                $to = $email;
                $subject = "Verification email";
                $body = "Please enter this verification code to subscribe TheGreatComis $otp";
                $headers = "From:vadhadiyaabhishek@gmail.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";

                $mail = mail($to, $subject, $body, $headers);
                if($mail){
                    $_SESSION['email'] = $email;
                    $_SESSION['email_sent'] = true;
                }
                else
                    $_SESSION['email'] = "unsent";

                header('location: verification.php');
                exit;
            }
        }
        
      
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <style>
            a{
                display: block;
                margin-top: 15px;
                font-size: large;
            }
            a:link{
                text-decoration: none;
            }
            .status{
                display: flex;
                align-items: center;
            }
            .fail{
                display: inline-block;
                align-items: center;
                background-color: rgb(0, 119, 255);
                color: white;
                border-radius: 10px;
                padding: 12px;
                margin: 20px auto;
            }
        </style>
        <title>Signin Page</title>
    </head>

    <body>
        <div class="title">
        <br>
        <hr>
        <h2>The Great Comics</h2>
        <hr>
        </div>
        <div class="container">
            <p style="text-align:center;" class="para1">Subscribe with valid email to get Great Comics after every 5 minutes</p>
            <form action="<?php if(isset($_SERVER['PHP_SELF'])){echo htmlentities($_SERVER['PHP_SELF']); } ?>" method="POST">
                <label for="email">First Name:</label><br>
                <input type="text" name="fname" id="inputField" autocomplete="on" placeholder="Enter Your Fisrt name" required> <br>
                <label for="email">Last Name:</label><br>
                <input type="text" name="lname" class="inputField" autocomplete="on" placeholder="Enter Your Last name" required> <br>
                <label for="email">Email address:</label><br>
                <input type="text" name="email" class="inputField" autocomplete="on" placeholder="Enter Your Valid email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required> <br>
                <input type="submit" value="submit" name="submit">
            </form>

            <a href="unsubscribe.php">Click here to Unsubscribe...</a>
            <div class="status">
                <?php if($var == true){ ?>
                    <p class="fail">
                        You are already subscribed to TheGreatComics!
                    </p>
                <?php } ?>
            </div>

        </div>
    </body>
</html>
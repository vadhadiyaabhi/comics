<?php

    $var = false;
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include 'dbconnect.php';
        

        $email = mysqli_real_escape_string($con,$_POST['email']);
        $fname = mysqli_real_escape_string($con,$_POST['fname']);
        $lname = mysqli_real_escape_string($con,$_POST['lname']);

        $otp = rand(100000,999999);
        $_SESSION['otp'] = $otp;

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

            if(mail($to, $subject, $body, $headers)){
                $_SESSION['email'] = $email;
                $_SESSION['email_sent'] = true;
            }
            else
                $_SESSION['email'] = "unsent";

            header('location: verification.php');
            exit;
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
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <label for="email">First Name:</label><br>
                <input type="text" name="fname" id="inputField" autocomplete="on" placeholder="Enter Your Fisrt name" required> <br>
                <label for="email">Last Name:</label><br>
                <input type="text" name="lname" class="inputField" autocomplete="on" placeholder="Enter Your Last name" required> <br>
                <label for="email">Email address:</label><br>
                <input type="text" name="email" class="inputField" autocomplete="on" placeholder="Enter Your Valid email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required> <br>
                <input type="submit" value="submit" name="submit">
            </form>

            <a href="unsubscribe.php">Click here to Unsubscribe!!</a>

        </div>
    </body>
</html>
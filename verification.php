<!-- <?php

    session_start();
    include 'dbconnect.php';
    $status = false;
    $err = false;
    if(!isset($_SESSION['otp']) || $_SESSION['email_sent'] != true)
    {
        header('location: index.php');
    }
    else
    {
        $email = $_SESSION['email'];
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $otp = mysqli_real_escape_string($con,$_POST['otp']);
            if($otp == $_SESSION['otp']){
                $q = "UPDATE email_info SET status = 'active' where email = '$email'";
                $result = mysqli_query($con,$q);
                if($result){
                    $status = true;
                }
            }
            else
            {
                $err = true;
            }
        }

        
    }

?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html
        {
            width: 100vw;
            height: 100vh;
        }
        body{
            box-sizing: border-box;
            height: 100%;
            overflow: hidden;
        }
        @media screen and (min-width: 768px)
        {
            .container
            {
                width: 60%;
                /* border: 2px solid lightblue; */
                /* margin: auto; */
            }
        }
        @media screen and (max-width: 767px)
        {
            .container
            {
                width: 60%;
                /* border: 2px solid lightblue; */
                /* margin: auto; */
            }
        }
        @media screen and (max-width: 360px)
        {
            .container
            {
                width: 100%;
                /* border: 2px solid lightblue; */
                /* margin: auto; */
            }
        }

        div.container
        {
            text-align: center;
            margin: 70px auto 0px auto;
        }
        .title
        {
            color: rgb(88, 146, 255);;
        }
        .container>form>input[type='number']
        {
            /* width: 90%; */
            padding: 10px 12px;
            border: 1px solid rgb(135, 167, 255);
            border-radius: 5px;
            margin: 5px 0px 20px 0px;
        }
        input[type='submit']
        {
            padding: 8px 12px;
            font-size: large;
            border: 1px solid blue;
            border-radius: 5px;
            background-color: rgb(88, 155, 255);
            color: white;
            width: 100px;
        }

        input[type='submit']:hover
        {
            background-color: white;
            color: blue;
            cursor: pointer;
        }
        input[type='submit']:active
        {
            background-color: white;
            color: red;
            cursor: pointer;
        }

        .success{
            display: inline-block;
            background-color: rgb(0, 189, 0);
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 20px auto;
        }
        .fail{
            display: inline-block;
            background-color: red;
            color: white;
            border-radius: 10px;
            padding: 10px;
            margin: 20px auto;
        }
    </style>
    <title>Verification Page</title>
</head>
<body>
    <div class="container">
        <div class="title">
            <h3>Verify Your Email</h3>
        </div>
        <p>Enter verification code that has been already sent to your email</p>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
            <label for="otp">Enter OTP</label><br>
            <input type="number" name="otp" id=""><br>
            <input type="submit" value="verify" name="submit">
        </form>

        <div class="status">
            
                <?php if($status == true){ ?>
                    <p class="success">
                        You've subscribed to TheGreatComis successfuly...,<br>
                        Check your email at every 5 minutes to enjoy different Comics!!!
                    </p>
                <?php } ?>
            
                <?php if($err == true){ ?>
                    <p class="fail">
                        OTP that you've entered is wrong!!!
                    </p>
                <?php } ?>
        </div>

    </div>
</body>
</html>
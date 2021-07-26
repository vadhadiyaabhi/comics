<?php

    session_start();
    $subscribe = false;
    if(isset($_POST['submit']))
    {
        require 'dbconnect.php';
        $email = isset($_POST['email']) ? mysqli_real_escape_string($con,$_POST['email']) : '';   

        $que = "SELECT email FROM email_info WHERE email = '$email'";
        $result = mysqli_query($con, $que);
        $num = mysqli_num_rows($result);

        if($num == 1)
        {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            $to = $email;
            $subject = "Verification email";
            $body = "Please enter this verification code to unsubscribe TheGreatComis " . $otp;
            $headers = "From:vadhadiyaabhishek@gmail.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";

            $mail = mail($to, $subject, $body, $headers);
            if($mail)
            {
                $_SESSION['unsub_email_sent'] = true;
                $_SESSION['email'] = $email;
                header('location: unsubscribeVerification.php');
                exit;
            }
            else{
                $_SESSION['email'] = "unsent";
                echo "Opps!! verification email cannot be sent...";
            }

            
        }
        else
        {
            $subscribe = true;
        }



    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html
        {
            margin: 0%;
            padding: 0%;
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
            margin: 30px auto 0px auto;
        }
        .title
        {
            text-align: center;
            color: rgb(88, 146, 255);;
        }
        .container>form>input[type='email']
        {
            width: 200px;
            padding: 10px 12px;
            border: 1px solid rgb(135, 167, 255);
            border-radius: 5px;
            margin: 5px 0px 20px 0px;
        }
        input[type='submit']
        {
            padding: 8px 12px;
            font-size: lsmall;
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
        .fail{
            display: inline-block;
            background-color: rgb(0, 119, 255);
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 20px auto;
        }
        .fail>a
        {
            color: black;
        }

    </style>
    <title>Unsubscribe page</title>
</head>
<body>
    <br>
    <hr>
    <div class="title">
        <h2>Unsubscribe from TheGreatComics</h2>
    </div>
    <hr>
    <div class="container">
        <p>Enter mail which you want to Unsubscribe</p>
        <form action="<?php if(isset($_SERVER['PHP_SELF'])){echo htmlentities($_SERVER['PHP_SELF']); } ?>" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="" placeholder="Enter email..." required><br>
            <input type="submit" value="Unsubscribe" name="submit">
        </form>

        <div class="status">
            <?php if($subscribe == true){ ?>
                <p class="fail">
                    You are already unsubscribed to TheGreatComics <br>
                    <a href="index.php">Goto home page</a>
                </p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
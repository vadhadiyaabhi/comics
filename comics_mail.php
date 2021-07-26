<?php

    require 'dbconnect.php';
    $random = rand(1,999);

    $file = 'https://xkcd.com/'. $random . '/info.0.json';
    $data = file_get_contents($file);
    $json_data = json_decode($data);

    $que = "SELECT email,fname,lname FROM email_info WHERE status = 'active';";
    $result = mysqli_query($con, $que);
    $num = mysqli_num_rows($result);

    $to = '';
    if($num>0)
    {
        for($i = 0; $i < $num-1; $i++)
        {
            $row = mysqli_fetch_array($result);
            $to .= $row['email'] . ',';
            
        }
        $row = mysqli_fetch_array($result);
        $to .= $row['email'];

        $subject = "The Great Comics";
        $body = "<h3> $json_data->title </h3> <br>
        <img src=' $json_data->img ' alt='Random Comic Image' height='250px' width='250px'> <br><br> <a href='http://localhost/git-file/php-vadhadiyaabhi/unsubscribe.php'>Unsubscribe to TheGreatComics </a> ";
        $headers = "From:vadhadiyaabhishek@gmail.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";

        $mail = mail($to, $subject, $body, $headers);
    }


?>


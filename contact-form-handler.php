<?php
    $name = $_POST['name'];
    $visitor_email = $__POST['email'];
    $message = $__POST['message'];


    $email_from = 'EasyTutorials@avinashkr.com';

    $email_subject = "New Form Submission";

    $email_ body = "User Name: $name./n".
                      "User Email: $visitor_email.\n".
                           "User Message: $message.\n";


    $to = "mahaveer0suthar@gmail.com";

    $headers = "From: $email_from \r\n0";

    $headers .= "Reply-To: $visitor_email \r\n";

    mail($to,$email_email_subject,$email_body,$headers);

    header("Location: index.html");


?>
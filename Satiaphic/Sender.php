<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

function sanitizeInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateCSRFToken()
{
    return bin2hex(random_bytes(32));
}

function isSpam($subject, $message, $email, $name)
{
    // Read spam keywords from the file
    $spamKeywords = file('assets/spam.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($spamKeywords === false) {
        // Handle the case when reading the file fails
        return false;
    }

    // Combine all input variables into a single string for spam checking
    $combinedInput = $subject . ' ' . $message . ' ' . $email . ' ' . $name;

    foreach ($spamKeywords as $keyword) {
        if (stripos($combinedInput, $keyword) !== false) {
            return true;
        }
    }

    return false;
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = sanitizeInput($_POST['your-name']);
    $email   = sanitizeInput($_POST['your-email']);
    $subject = sanitizeInput($_POST['your-subject']);
    $message = sanitizeInput($_POST['your-message']);

    $errorMessage = '';
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $errorMessage = 'Please fill in all fields.';
    } elseif (!isValidEmail($email)) {
        $errorMessage = 'Invalid email address.';
    } elseif (strlen($message) < 10) {
        $errorMessage = 'Message TOO short';
    } elseif (isSpam($subject, $message, $email, $name)) {
        $errorMessage = 'Your message contains prohibited content.';
    }

    if (!empty($errorMessage)) {
?>
    
                <?php echo $errorMessage; ?>

        <?php
    } else {


        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'brbo.brothers@gmail.com';
            $mail->Password   = 'qmmdlpcmpidhlnyc';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('info@satiaphic.com');

            $mail->isHTML(false);
            $mail->Subject = $subject;

            $body = "Name: $name\n";
            $body .= "Email: $email\n";
            $body .= "Subject: $subject\n\n";
            $body .= "Message:\n$message";

            $mail->Body    = $body;

            $mail->send();
            $name = $email = $subject = $message = '';



        ?>
                    Message has been sent successfully!
        <?php
        } catch (Exception $e) {
        ?>

                    Something wentwrong...
      
<?php
        }
    }
} else {
}
?>
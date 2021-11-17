<?php

include 'config.php';

function pdo_connect_mysql()
{
    $DATABASE_HOST = DBHOST;
    $DATABASE_USER = DBUSER;
    $DATABASE_PASS = DBPWD;
    $DATABASE_NAME = DBNAME;

    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }
}

// Template header, feel free to customize this
function template_header($title, $userFirstName, $userName)
{
    echo <<<EOT
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>$title</title>
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
         <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link href="/Chat-App/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Fontawesome core CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <!-- Custom styles for this template -->
        <link href="/Chat-App/assets/dist/css/navbar-top-fixed.css" rel="stylesheet">
        <link href="/Chat-App/assets/dist/css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">
	</head>

	<body>
     <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Message-App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="index.php?page=home">Inbox<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="index.php?page=outbox">Outbox<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                 <a class="nav-link" href="index.php?page=new-message">New message</a>
                </li>
                <li class="nav-item">
                 <a class="nav-link" href="index.php?page=contact-list">Contact list</a>
                </li>
            </ul>  
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <a class="nav-link" href="index.php?page=user-profile&username=$userName">Welcome $userFirstName </a>
        </div>
      </nav>
    </header>
        <main role="main" class="container">
EOT;
}
// Template footer
function template_footer()
{
    $year = date('Y');
    echo <<<EOT
        </main>
        <footer class="footer">
        <div class="container">
          <span class="text-muted">&copy; $year, Message App by Luis Monzón.</span>
        </div>
      </footer>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/Chat-App/assets/dist/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="/Chat-App/assets/dist/js/popper.min.js"></script>
    <script src="/Chat-App/assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
EOT;
}

// Template error page
function template_error($title, $errorMessage)
{
    echo <<<EOT
    <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="/Chat-App/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="/Chat-App/assets/dist/css/navbar-top-fixed.css" rel="stylesheet">
        <link href="/Chat-App/assets/dist/css/sticky-footer-navbar.css" rel="stylesheet">
	</head>

	<body>
     <div class="alert alert-danger" role="alert">
      $errorMessage
     </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/Chat-App/assets/dist/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="/Chat-App/assets/dist/js/popper.min.js"></script>
    <script src="/Chat-App/assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
EOT;
    die();
}
// Template error in page
function template_error_inpage($title, $errorMessage)
{
    echo <<<EOT
     <div class="alert alert-danger" role="alert">
      $errorMessage
     </div>

EOT;
}
// Template success in page
function template_success_inpage($title, $successMessage)
{
    echo <<<EOT
     <div class="alert alert-success" role="alert">
      $successMessage
     </div>

EOT;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Function to send emails
function send_email($toUserMail, $toUserName, $subject, $content)
{
    require '../../vendor/autoload.php';
    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'pepeperez4609@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'Pepe1234';
    $mail->setFrom('pepeperez4609@gmail.com', 'First Last');
    $mail->addReplyTo('replyto@example.com', 'First Last');
    //Set who the message is to be sent to
    $mail->addAddress($toUserMail, $toUserName);
    //Set the subject line
    $mail->Subject =  $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->MsgHTML($content);
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}

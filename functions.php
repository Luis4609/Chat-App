<?php

switch (getenv('PROFILE')) {
    case 'DEVELOPMENT':
        include 'config-dev.php';
        break;
    case 'HEROKU':
        include 'config-heroku.php';
        break;
    default:
        include 'config.php';
        break;
}

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

// Template header
function template_header($title, $userFirstName, $userName, $userAvatar)
{
    $APP_ROOT_FOLDER = APPROOT;
    echo <<<EOT
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>$title</title>
        <link rel="icon" type="image/png" sizes="32x32" href="$APP_ROOT_FOLDER/assets/Favicon/favicon-32x32.png">
         <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fontawesome core CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <!-- Custom styles for this template -->
        <link href="$APP_ROOT_FOLDER/assets/dist/css/navbar-top-fixed.css" rel="stylesheet">
        <link href="$APP_ROOT_FOLDER/assets/dist/css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="$APP_ROOT_FOLDER/assets/dist/css/list-groups.css" rel="stylesheet">
        
        
	</head>

	<body>
     <header>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
       <div class="container-fluid d-grid row"  style="grid-template-columns: 1fr 4fr 1fr">
        <a class="navbar-brand" href="#">Message-App</a>  
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="index.php?page=home">Inbox<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="index.php?page=outbox">Outbox<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?page=groups-list">Groups</a>
               </li>
                <li class="nav-item">
                 <a class="nav-link" href="index.php?page=contact-list">Contacts</a>
                </li>
                <li class="nav-item">
                 <a class="nav-link" href="index.php?page=friends-list">Friends</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php?page=friends-request">Friend Requests</a>
               </li>
               <li class="nav-item">
               <a class="nav-link" href="index.php?page=new-message">New message</a>
              </li>
            </ul>  
        </div>
         <div class="d-flex " >
          <div class="flex-shrink-0 dropdown mx-auto">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img src="$userAvatar" alt="mdo" width="32" height="32" class="rounded-circle" />
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="index.php?page=user-profile&username=$userName">Profile</a></li>
              <li><a class="dropdown-item" href="index.php?page=edit-user-profile">Settings</a></li>
              <li>
                <hr class="dropdown-divider"/>
              </li>
              <li><a class="dropdown-item" href="index.php">Sign out</a></li>
            </ul>
           </div>
          </div>
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
        <!-- Bootstrap core JavaScript -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
EOT;
}

// Template error page
function template_error($title, $errorMessage)
{
    $APP_ROOT_FOLDER = APPROOT;
    echo <<<EOT
    <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="$APP_ROOT_FOLDER/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="$APP_ROOT_FOLDER/assets/dist/css/navbar-top-fixed.css" rel="stylesheet">
        <link href="$APP_ROOT_FOLDER/assets/dist/css/sticky-footer-navbar.css" rel="stylesheet">
	</head>

	<body>
     <div class="alert alert-danger" role="alert">
      $errorMessage
     </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="$APP_ROOT_FOLDER/assets/dist/js/popper.min.js"></script>
    <script src="$APP_ROOT_FOLDER/assets/dist/js/bootstrap.bundle.min.js"></script>
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
    //Configure logs for testing Set off(recomended on production)
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
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
    $mail->Username = 'luismonped4609@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = 'LuisMon4609';
    $mail->setFrom('luismonped4609@gmail.com', 'Confirmation link');
    //$mail->addReplyTo('replyto@example.com', 'First Last');
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
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        $sentMessageError = "There was an error, please check your information";
        header('location: index.php?page=login&messageError=' . $sentMessageError);
    } else {
        // echo 'Message sent!';
        $sentMessageCorrect = "The confirmation link was sent to your email";
        header('location: index.php?page=login&messageSuccess=' . $sentMessageCorrect);
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}

function upload_file($allowOnlyImg)
{

    if (empty($_FILES["fileToUpload"]["name"])) {
        return "";
    }
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($allowOnlyImg) {
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        $target_file = null;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    //return the route of the uploaded file
    return  $target_file;
}

function is_user_in_role($role)
{
    if (isset($role)) {
        $getUserRole = $_SESSION['userrole'];
        if (strcmp($role, $getUserRole) === 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_all_users($pdo)
{
    //Get all the users for the SEARCH
    $stmtUsersList = $pdo->prepare('SELECT * FROM users WHERE UserName != :username');
    $stmtUsersList->execute(
        array(
            'username'  =>  $_SESSION["username"]
        )
    );
    //Verify the respond data from DB
    if ($stmtUsersList == null) {
        //Error
        $errorcontact = "There was an error in the database, please wait here";
        template_error('Error', $errorcontact);
    }
    return $stmtUsersList->fetchAll(PDO::FETCH_ASSOC);
}

function get_all_active_users($pdo)
{
    //Get all the users for the SEARCH
    $stmtActiveUsersList = $pdo->prepare('SELECT * FROM users WHERE UserName != :username AND IsActive = 1');
    $stmtActiveUsersList->execute(
        array(
            'username'  =>  $_SESSION["username"]
        )
    );
    //Verify the respond data from DB
    if ($stmtActiveUsersList == null) {
        //Error
        $errorcontact = "There was an error in the database, please wait here";
        template_error('Error', $errorcontact);
    }
    return $stmtActiveUsersList->fetchAll(PDO::FETCH_ASSOC);
}

function insert_participant_in_group($pdo, $groupId, $userId)
{
    $stmtInsterParticipants = $pdo->prepare('INSERT INTO group_participants (GroupId, UserId) VALUES
    (:groupId, :userId)');
    $stmtInsterParticipants->execute(
        array(
            'groupId' => $groupId,
            'userId' => $userId
        )
    );
    $count = $stmtInsterParticipants->rowCount();
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function get_user_by_id($pdo, $userId)
{
    // Get the user data
    $stmtUserData = $pdo->prepare('SELECT * FROM users Where UserId = :userid');
    $stmtUserData->execute(
        array(
            'userid' => $userId
        )
    );
    if ($stmtUserData == null) {
        //Error
        $errorMessage = "There was an error in the database, please wait here";
        template_error('Error', $errorMessage);
    }
    return $stmtUserData->fetch(PDO::FETCH_ASSOC);
}

function get_user_by_userName($pdo, $userName)
{
    // Get the user data
    $stmtUserData = $pdo->prepare('SELECT * FROM users Where UserName = :userName');
    $stmtUserData->execute(
        array(
            'userName' => $userName
        )
    );
    if ($stmtUserData == null) {
        //Error
        $errorMessage = "There was an error in the database, please wait here";
        template_error('Error', $errorMessage);
    }
    return $stmtUserData->fetch(PDO::FETCH_ASSOC);
}

function get_group_by_groupId($pdo, $groupId)
{
    $stmtGroup = $pdo->prepare('SELECT * FROM user_groups Where GroupId = :groupid');
    $stmtGroup->execute(
        array(
            'groupid'     =>      $groupId
        )
    );
    return $stmtGroup->fetch(PDO::FETCH_ASSOC);
}

function get_group_message_by_messageId($pdo, $messageId)
{
    $stmtGroupMessage = $pdo->prepare('SELECT * FROM group_messages Where MessageId = :messageId');
    $stmtGroupMessage->execute(
        array(
            'messageId'     =>      $messageId
        )
    );
    return $stmtGroupMessage->fetch(PDO::FETCH_ASSOC);
}

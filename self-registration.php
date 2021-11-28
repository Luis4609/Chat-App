<?php
//
$APP_ROOT_FOLDER = APPROOT;
//Error handling
if (isset($_GET["messageError"])) {
  $messageError = $_GET["messageError"];
}
//Success registration
if (isset($_GET["messageError"])) {
  $messageError = $_GET["messageError"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //information of the new user sent from register form
  $myusername =  $_POST['username'];
  $mypassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $myuserFirstName =  $_POST['firstname'];
  $myuserLastName =  $_POST['lastname'];

  //Data from form registration
  $data = [
    'userName' => $myusername,
    'userPassword' => $mypassword,
    'userFirstName' => $myuserFirstName,
    'userLastName' => $myuserLastName
  ];
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //Verify if the user exists
  $sqlGetUserId = "SELECT  UserId,UserName FROM users WHERE UserName  = :username";
  $statementUserId = $pdo->prepare($sqlGetUserId);
  $statementUserId->execute(
    array(
      'username'     =>     $myusername
    )
  );
  $count = $statementUserId->rowCount();
  // $checkUserExists = get_user_by_userName($pdo, $myusername);
  if ($count > 0) {
    $messageError = "The user already exists";
    header('location: index.php?page=self-registration&messageError=' . $messageError);
    die();
  }
  //Insert the new user
  $sql = "INSERT INTO users (UserName, UserPassword, UserFirstName, UserLastName) VALUES
(:userName, :userPassword, :userFirstName, :userLastName)";
  $statement = $pdo->prepare($sql);
  $statement->execute($data);

  //Get the new user id from DB
  $statementUserId->execute(
    array(
      'username'     =>     $myusername
    )
  );
  $count = $statementUserId->rowCount();
  if (!($count > 0)) {
    $messageError = "This failed";
    header('location: index.php?page=self-registration&messageError=' . $messageError);
    die();
  }
  $result = $statementUserId->fetch(PDO::FETCH_ASSOC);
  //Get the user id
  $userId = $result['UserId'];

  //TO-DO INSERT TOKEN
  //Genero un token, lo inserto en DB
  $token = password_hash($myusername, PASSWORD_DEFAULT);
  //Get current time, and add 1 day(for the validation link)
  $date = date('Y-m-d H:i:s');
  // $date = date('m/d/Y h:i:s a', time());
  $getValidationDate = date('Y-m-d H:i:s', strtotime($date . "+1 days"));
  //Insert token in DB
  $sql = "INSERT INTO usertokens (UserId, Token, Valid) VALUES
  (:userId, :token, :valid)";
  $statement = $pdo->prepare($sql);
  $statement->execute(
    array(
      'userId'  =>     $userId,
      'token'     =>     $token,
      'valid'  =>     $getValidationDate
    )
  );
  //SEND AN EMAIL TO STAR THE VERIFICATION PROCESS
  $subject = "Verification email";
  if ($APP_ROOT_FOLDER == "HEROKU") {
    $content = "<a href='https://ljmp-message-app.herokuapp.com/index.php?page=self-registration-verification&userId=$userId&token=$token'>Pls click this link to finish your registration process.</a>";
  }
  $content = "<a href='http://localhost/Chat-App/index.php?page=self-registration-verification&userId=$userId&token=$token'>Pls click this link to finish your registration process.</a>";

  send_email($myusername, $myuserFirstName, $subject, $content);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" />
  <title>Sign Up</title>
  <!-- Bootstrap core CSS -->
  <link href="<?= $APP_ROOT_FOLDER ?>/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?= $APP_ROOT_FOLDER ?>/assets/dist/css/signin.css" rel="stylesheet" />
</head>

<body class="text-center">
  <main class="form-signin">
    <form action="" method="post">
      <img class="mb-4" src="<?= $APP_ROOT_FOLDER ?>/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57" />
      <h1 class="h3 mb-3 fw-normal">Sign Up</h1>

      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="" name="username" required />
        <label for="floatingInput">User name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingFirstName" placeholder="" name="firstname" required />
        <label for="floatingFirstName">First name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingLastName" placeholder="" name="lastname" required />
        <label for="floatingLastName">Last name</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="" name="password" onkeyup='check();' required />
        <label for="password">Password</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="repeat-password" placeholder="" name="repeat-password" onkeyup='check();' required />
        <label for="repeat-password" id="message-password">Repeat password</label>
      </div>
      <!-- <div class="form-floating">
        <input type="email" class="form-control" id="floatingEmail" placeholder="" name="email" />
        <label for="floatingEmail">Email</label>

      </div> -->
      <?php if (isset($messageError)) {
        template_error_inpage('Error', $messageError);
      } ?>
      <?php if (isset($messageError)) {
        template_error_inpage('Error', $messageError);
      } ?>
      <?php if (isset($messageError)) {
        template_error_inpage('Error', $messageError);
      } ?>

      <button class="w-100 btn btn-lg btn-primary" type="submit" style="margin-top: 5px;">
        Sign Up
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
    </form>

    <!--Validation script for the password-->
    <script>
      var check = function() {
        if (document.getElementById('password').value ==
          document.getElementById('repeat-password').value) {
          document.getElementById('message-password').style.color = 'green';
          document.getElementById('message-password').innerHTML = 'matching';
        } else {
          document.getElementById('message-password').style.color = 'red';
          document.getElementById('message-password').innerHTML = 'not matching';
        }
      }
    </script>
  </main>
</body>

</html>
<?php
//Error handling
if (isset($_GET["messageError"])) {
  $messageError = $_GET["messageError"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 
  $myusername =  $_POST['username'];
  $mypassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

  //$query = "SELECT * FROM users WHERE username = :username AND password = :password";  
  $sql = "SELECT  UserId,UserName, UserPassword, UserFirstName FROM Users WHERE UserName  = :username AND IsActive = 1";
  $statement = $pdo->prepare($sql);
  $statement->execute(
    array(
      'username'     =>     $myusername
    )
  );

  //Look if we had a user
  $count = $statement->rowCount();
  if ($count > 0) {
    $_SESSION["username"] = $_POST["username"];
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION["userid"] = $result['UserId'];
    $_SESSION["userFirstName"] = $result["UserFirstName"];
    //Verify the hashed password
    if (password_verify($_POST["password"], $result['UserPassword'])) {
      header('location: index.php?page=home');
    } else {
      $messageError = "The user or password are incorrect, please verify your information";
      header('location: index.php?page=login&messageError=' . $messageError);
    }
  } else {
    $messageError = "The user or password are incorrect, please verify your information";
    header('location: index.php?page=login&messageError=' . $messageError);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <title>Signin</title>
  <!-- Fontawesome core Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="/Chat-App/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/Chat-App/assets/dist/css/signin.css" rel="stylesheet" />
</head>

<body class="text-center">
  <main class="form-signin">
    <form action="" method="post">
      <img class="mb-4" src="/Chat-App/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57" />
      <!--LOGO-->
      <!-- <span style="font-size: 48px; color: Dodgerblue;">
        <i class="fas fa-comments"> Chat</i>
      </span> -->
      <h1 class="h3 mb-3 fw-normal">Sign in</h1>

      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="" name="username" require />
        <label for="floatingInput">User name</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="" name="password" require />
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" /> Remember me
        </label>
      </div>
      <?php if (isset($messageError)) {
        template_error_inpage('Error', $messageError);
      } ?>
      <button class="w-100 btn btn-lg btn-primary" type="submit">
        Sign in
      </button>
      <a class="w-100 btn btn btn-secondary" href="index.php?page=self-registration" role="button" style="margin-top: 5px;">Register now</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
    </form>
  </main>
</body>

</html>
<?php
//Error handling
if (isset($_GET["messageError"])) {
  $messageError = $_GET["messageError"];
} else {
  //Parameters from URL
  if (isset($_GET["userId"])) {
    $userId = $_GET["userId"];
  }
  if (isset($_GET["token"])) {
    $token = $_GET["token"];
  }
  //CHECK THE USER AND THE TOKEN
  $data = [
    'userId' => $userId,
    'token' => $token
  ];
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //Verify if the user exists
  $sql = "SELECT  UserId FROM UserTokens WHERE UserId  = :userId AND Token = :token AND Valid > curdate()";
  $statement = $pdo->prepare($sql);
  $statement->execute(
    array(
      'userId' => $userId,
      'token' => $token
    )
  );
  $count = $statement->rowCount();
  if ($count > 0) {
    //Activate the user
    $sql = "UPDATE  Users SET IsActive = 1 WHERE UserId  = :userId ";
    $statement = $pdo->prepare($sql);
    $statement->execute(
      array(
        'userId' => $userId,
      )
    );
    //Login the new user
    $sql = "SELECT  UserName, UserFirstName FROM Users WHERE UserId  = :userId";
    $statement = $pdo->prepare($sql);
    $statement->execute(
      array(
        'userId' => $userId,
      )
    );
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION["username"] = $result['UserName'];
    $_SESSION["userid"] = $userId;
    $_SESSION["userFirstName"] = $result["UserFirstName"];
    //TODO DELETE THE USER TOKEN ROW
    header('location: index.php?page=home');
  } else {
    $messageError = "Error with the verification";
    header('location: index.php?page=self-registration-verification&messageError=' . $messageError);
    die();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <title>Sign Up</title>
  <!-- Bootstrap core CSS -->
  <link href="/Chat-App/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/Chat-App/assets/dist/css/signin.css" rel="stylesheet" />
</head>

<body class="text-center">
  <?php if (isset($messageError)) {
    template_error_inpage('Error', $messageError);
  } ?>
</body>

</html>
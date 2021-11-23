<?php
//Handle the actions from the admin zone
//Edit user
//Delete user
//Change active 
$data = [
    'userId' => $_GET['userId']
];
if (isset($_GET['changeActive'])) {
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Verify if the user exists
    $sql = "SELECT * FROM Users WHERE UserId  = :userId";
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    $userChangeActive = $statement->fetch(PDO::FETCH_ASSOC);
    $count = $statement->rowCount();
    if ($count > 0) {
        if ($userChangeActive['IsActive'] == 0) {
            //Activate the user
            $sql = "UPDATE  Users SET IsActive = 1 WHERE UserId  = :userId ";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
        } else {
            $sql = "UPDATE  Users SET IsActive = 0 WHERE UserId  = :userId ";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
        }
        header('location: index.php?page=admin-zone');
    } else {
        $messageError = "Error with the operation";
        header('location: index.php?page=admin-zone&messageError=' . $messageError);
    }
}

//Change role of a user
if (isset($_GET['changeRole'])) {
    // Verify if the user exists
    //Verify if the user exists
    $sql = "SELECT * FROM Users WHERE UserId  = :userId";
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    $userChangeRole = $statement->fetch(PDO::FETCH_ASSOC);
    $count = $statement->rowCount();
    if ($count > 0) {
        //Make the user -> admin
        if ($userChangeRole['Role'] == 0) {
            $sql = "UPDATE  Users SET Role = 1 WHERE UserId  = :userId ";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
        } else {
            $sql = "UPDATE  Users SET Role = 0 WHERE UserId  = :userId ";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
        }
        header('location: index.php?page=admin-zone');
    } else {
        $messageError = "Error with the operation";
        header('location: index.php?page=admin-zone&messageError=' . $messageError);
    }
}

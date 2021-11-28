<?php
$class = "";
$text = "";
//Check the friend request
if ($_GET['friend'] == 0) {
    //Friend request denied
    $stmtDelete = $pdo->prepare('DELETE FROM friends Where UserId = :userid AND UserId2 = :userid2');
    $stmtDelete->execute(
        array(
            'userid' => $_GET['userId1'],
            'userid2' => $_GET['userId2']
        )
    );
    $class = "alert alert-danger";
    $text = "You ignore the request";
    header('location: index.php?page=friends-request&messageError=' . $text);
} else {

    $stmtUpdate = $pdo->prepare('UPDATE friends SET AreFriend = 1 Where UserId = :userid AND UserId2 = :userid2');
    $stmtUpdate->execute(
        array(
            'userid' => $_GET['userId1'],
            'userid2' => $_GET['userId2']
        )
    );

    $class = "alert alert-danger";
    $text = "You accept the request succesfuly";
    header('location: index.php?page=friends-request&messageError=' . $text);
}

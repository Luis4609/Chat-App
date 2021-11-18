<?php
$class = "";
$text = "";
//Check the friend request
if ($_GET['friend'] == 0) {
    //Friend request denied
    $stmtDelete = $pdo->prepare('DELETE FROM Friends Where FriendsId = :friendsid');
    $stmtDelete->execute(
        array(
            'friendsid' => $_GET['requestId']
        )
    );
    $class = "alert alert-danger";
    $text = "You ignore the request";
    header('location: index.php?page=friends-request&messageError=' . $text);
      
} else {

    $stmtUpdate = $pdo->prepare('UPDATE Friends SET AreFriend = 1 Where FriendsId = :friendsid');
    $stmtUpdate->execute(
        array(
            'friendsid' => $_GET['requestId']
        )
    );

    $class = "alert alert-danger";
    $text = "You accept the request succesfuly";
    header('location: index.php?page=friends-request&messageError=' . $text);
}
?>



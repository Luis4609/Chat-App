<?php
//Info of the log user
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

// Get the latest friends requests to loged user
$stmt = $pdo->prepare('SELECT * FROM Friends Where UserId2 = :userid AND AreFriend = 0 ORDER BY Timestamp DESC ');
$stmt->execute(
    array(
        'userid'     =>      $_SESSION["userid"]
    )
);
//Verify the respond data from DB
if ($stmt == null) {
    //Error
    $errorrequest = "There was an error in the database, please wait here";
    template_error('Error', $errorrequest);
}
$recently_added_friends_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the log user
$stmtUser = $pdo->prepare('SELECT * FROM Users Where UserName = :userName ');
$stmtUser->execute(
    array(
        'userName'     =>     $userName
    )
);
//Verify the respond data from DB
if ($stmtUser == null) {
    //Error
    $errorrequest = "There was an error in the database, please wait here";
    template_error('Error', $errorrequest);
}
$info_user = $stmtUser->fetch(PDO::FETCH_ASSOC);

?>
<?= template_header('Home', $firstName, $userName) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2>Pending friends requests <i class="fas fa-user-friends"></i></h2>
    <div class="requests">
        <?php foreach ($recently_added_friends_requests as $request) : ?>
            <?php
            // Get the info of the user that sent the request
            $stmtFromUser = $pdo->prepare('SELECT * FROM Users Where UserId = :userid ');
            $stmtFromUser->execute(
                array(
                    'userid'     =>     $request['UserId']
                )
            );
            //Verify the respond data from DB
            if ($stmtFromUser == null) {
                //Error
                $errorrequest = "There was an error in the database, please wait here";
                template_error('Error', $errorrequest);
            }
            $info_from_user = $stmtFromUser->fetch(PDO::FETCH_ASSOC);
            // Get the id of the friend request
            $stmtFriend = $pdo->prepare('SELECT * FROM Friends Where UserId = :userid AND UserId2 = :userid2');
            $stmtFriend->execute(
                array(
                    'userid'     =>     $request['UserId'],
                    'userid2'     =>     $_SESSION["userid"]
                )
            );
            //Verify the respond data from DB
            if ($stmtFriend == null) {
                //Error
                $errorrequest = "There was an error in the database, please wait here";
                template_error('Error', $errorrequest);
            }
            $info_friend_request = $stmtFriend->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= $info_from_user['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0"> <?= $info_from_user['UserFirstName'] . " " . $info_from_user['UserLastName'] ?></h6>
                    </div>
                </div>
                <a type="button" class="btn btn-success" href="index.php?page=friends-requests-handler&friend=1&requestId=<?= $info_friend_request['FriendsId'] ?>">Accept</a>
                <a type="button" class="btn btn-danger" href="index.php?page=friends-requests-handler&friend=0&requestId=<?= $info_friend_request['FriendsId'] ?>">Ignore</a>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?= template_footer() ?>
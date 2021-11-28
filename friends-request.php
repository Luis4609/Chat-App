<?php
//Info of the log user
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];
//Message of the operation ACEPT OR IGNORE
if (isset($_GET["messageError"])) {
    $messageError = $_GET["messageError"];
}
// Get the log user
$info_user = get_user_by_userName($pdo, $userName);
// Get the latest friends requests to loged user
$stmt = $pdo->prepare('SELECT * FROM friends Where UserId2 = :userid AND AreFriend = 0 ORDER BY Timestamp DESC ');
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

?>
<?= template_header('Friends requests', $firstName, $userName, $info_user['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2>Pending friends requests <i class="fas fa-user-friends"></i></h2>
    <div class="requests">
        <?php foreach ($recently_added_friends_requests as $request) : ?>
            <?php
            // Get the info of the user that sent the request
            $stmtFromUser = $pdo->prepare('SELECT * FROM users Where UserId = :userid ');
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
            $stmtFriend = $pdo->prepare('SELECT * FROM friends Where UserId = :userid AND UserId2 = :userid2');
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
                <a type="button" class="btn btn-success" href="index.php?page=friends-requests-handler&friend=1&userId1=<?= $info_friend_request['UserId'] ?>&userId2=<?= $info_friend_request['UserId2'] ?>">Accept</a>
                <a type="button" class="btn btn-danger" href="index.php?page=friends-requests-handler&friend=0&userId1=<?= $info_friend_request['UserId'] ?>&userId2=<?= $info_friend_request['UserId2'] ?>">Ignore</a>
            </div>

        <?php endforeach; ?>
        <?php if (isset($messageError)) {
            template_success_inpage('Error', $messageError);
        } ?>
    </div>

</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
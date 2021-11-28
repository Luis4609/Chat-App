<?php
//Get the session variables
$userId = $_SESSION['userid'];
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

$user = get_user_by_id($pdo, $_SESSION["userid"]);
// Get the friends list of the logged user
$stmtFriendList = $pdo->prepare('SELECT * FROM friends WHERE (UserId = :userid OR UserId2 = :userid) AND AreFriend = 1');
$stmtFriendList->execute(
    array(
        'userid'     =>     $userId
    )
);
//Verify the respond data from DB
if ($stmtFriendList == null) {
    //Error
    $errorcontact = "There was an error in the database, please wait here";
    template_error('Error', $errorcontact);
}
$friends = $stmtFriendList->fetchAll(PDO::FETCH_ASSOC);

?>
<?= template_header('Friend list', $firstName, $userName, $user['UserAvatar']) ?>
<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2><?= $firstName ?>'s Friends List <i class="fas fa-inbox"></i></h2>
    <div class="contacts">
        <?php foreach ($friends as $friend) : ?>
            <?php
            // Get the friends ids
            if ($friend['UserId'] == $userId) {
                $myFriend = $friend['UserId2'];
            } else {
                $myFriend = $friend['UserId'];
            }
            $stmtRealFriend = $pdo->prepare('SELECT * FROM users WHERE UserId = :friendid');
            $stmtRealFriend->execute(
                array(
                    'friendid'     =>     $myFriend
                )
            );
            //Verify the respond data from DB
            if ($stmtRealFriend == null) {
                //Error
                $errorcontact = "There was an error in the database, please wait here";
                template_error('Error', $errorcontact);
            }
            $realFriend = $stmtRealFriend->fetch(PDO::FETCH_ASSOC);
            ?>
            <a href="index.php?page=user-profile&username=<?= $realFriend['UserName'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <!-- <a href="index.php?page=new-message&tousername=<?= $realFriend['UserName'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true"> -->
                <img src="<?= $realFriend['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0"> <?= $realFriend['UserName'] ?></h6>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>


</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
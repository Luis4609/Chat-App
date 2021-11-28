<?php
//Info of the log user
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

// Get the latest messages from the logged in user
$stmt = $pdo->prepare('SELECT * FROM messages Where ToUserId = :userid ORDER BY Timestamp DESC ');
$stmt->execute(
    array(
        'userid'     =>      $_SESSION["userid"]
    )
);
//Verify the respond data from DB
if ($stmt == null) {
    //Error
    $errorMessage = "There was an error in the database, please wait here";
    template_error('Error', $errorMessage);
}
$recently_added_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the log user info
$info_user = get_user_by_userName($pdo, $userName);

?>
<?= template_header('Inbox', $firstName, $userName, $info_user['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2><?= $firstName ?>'s Inbox <i class="fas fa-inbox"></i></h2>
    <div class="messages">
        <?php foreach ($recently_added_messages as $message) : ?>
            <?php
            // Get the info of the FromUser(user that send the message)
            $info_from_user = get_user_by_id($pdo, $message['FromUserId']);
            ?>
            <a href="index.php?page=message&id=<?= $message['MessageId'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= $info_from_user['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0"> <?= $info_from_user['UserFirstName'] . " " . $info_from_user['UserLastName'] ?></h6>
                        <p class="mb-0 opacity-75">
                            <?= substr($message['Text'], 0, 50) ?>
                        </p>
                    </div>
                    <small class="opacity-50 text-nowrap"><?= $message['Timestamp'] ?></small>
                </div>
                <?php if ($message['IsRead'] == 0) {
                    $isReadClass = "far fa-check-square";
                } else {
                    $isReadClass = "fas fa-check-square";
                } ?>
                <p>
                    <i class="<?= $isReadClass ?>"></i>
                </p>
                <?php if ($message['AttachFile'] == null || $message['AttachFile'] == "uploads/") {
                    $isAttached = "";
                } else {
                    $isAttached = "fas fa-paperclip";
                } ?>
                <p>
                    <i class="<?= $isAttached ?>"></i>
                </p>

            </a>
        <?php endforeach; ?>
    </div>
    <hr class="mb-4">
    <a href="index.php?page=new-message" class="btn btn-primary btn-lg btn-block">New message</a>

</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
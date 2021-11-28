<?php
//Get the session data
$userId = $_SESSION["userid"];
$userName = $_SESSION["username"];
$userFirstName = $_SESSION["userFirstName"];

$user = get_user_by_userName($pdo, $_SESSION["username"]);

// Get the message
$stmt = $pdo->prepare('SELECT * FROM messages  INNER JOIN users ON messages.FromUserId = users.UserId AND messages.MessageId = :messageid');
$stmt->execute(
    array(
        'messageid' => $_GET["id"]
    )
);
$message = $stmt->fetch(PDO::FETCH_ASSOC);
// Get the user data
$fromUser =  get_user_by_id($pdo, $message["FromUserId"]);
// Get the reciver data
$toUser =  get_user_by_id($pdo, $message["ToUserId"]);
//Mark as readed
$stmtUpdate = $pdo->prepare('UPDATE messages SET IsRead = 1 Where messages.MessageId = :messageid');
$stmtUpdate->execute(
    array(
        'messageid' => $_GET["id"]
    )
);
?>
<?= template_header('View message', $userFirstName, $userName, $user['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h3><?= $fromUser['UserFirstName'] . " " . $fromUser['UserLastName'] ?>'s Message</h3>
    <div class="messages">
        <a href="index.php?page=message&id=<?= $message['MessageId'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
            <img src="<?= $fromUser['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">To: <?= $toUser['UserFirstName'] ?> <?= $toUser['UserName'] ?></h6>
                    <p class="mb-0 opacity-75">
                        <?= $message['Text'] ?>
                    </p>
                </div>
                <small class="opacity-50 text-nowrap"><?= $message['Timestamp'] ?></small>
            </div>
        </a>
    </div>
    <!--Logic for show the attach file -->
    <?php if ($message['AttachFile'] == null) {
        $isAttached = "";
        $isDisplayedImg = "d-none";
        $isDisplayedFile = "d-none";
    } else {
        $extension = substr($message['AttachFile'], -3, 3);
        $isAttached = $message['AttachFile'];
        if (
            $extension == "jpg" || $extension == "png" || $extension == "jpeg"
            || $extension == "gif"
        ) {
            $isDisplayedImg = "";
            $isDisplayedFile = "d-none";
        } else {
            $isDisplayedFile = "";
            $isDisplayedImg = "d-none";
        }
    } ?>
    <div class="ratio ratio-16x9 <?= $isDisplayedImg ?>">
        <img src="<?= $isAttached ?>" class="img-fluid img-thumbnail rounded-3 w-100 <?= $isDisplayedImg ?>" alt="...">
    </div>
    <div class="ratio ratio-1x1 <?= $isDisplayedFile ?>">
        <embed src="<?= $isAttached ?>" width="800px" height="210px" class="<?= $isDisplayedFile ?> embed-responsive-item" />
    </div>
    <hr class="mb-4">
    <!--Logic for control the reply information-->
    <?php if ($message['FromUserId'] != $userId) {
        $respond = $message['FromUserId'];
        $respondName = $message['UserName'];
    } else {
        $respond = $message['ToUserId'];
        $respondName = $toUser['UserName'];
    }
    ?>
    <a href="index.php?page=new-message&touserid=<?= $respond ?>&tousername=<?= $respondName ?>" class="btn btn-primary btn-lg btn-block">Reply</a>
</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
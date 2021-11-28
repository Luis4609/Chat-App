<?php
//Get the session data
$userId = $_SESSION["userid"];
$userName = $_SESSION["username"];
$userFirstName = $_SESSION["userFirstName"];

$user = get_user_by_id($pdo, $userId);

//Get the message to show
if (isset($_GET['messageId'])) {
    $myMessage = $_GET['messageId'];
}

//Get the group info
$stmtGroupMessage = $pdo->prepare('SELECT * FROM group_messages Where MessageId = :messageId');
$stmtGroupMessage->execute(
    array(
        'messageId'     =>      $myMessage
    )
);
$info_group_message = $stmtGroupMessage->fetch(PDO::FETCH_ASSOC);

//get group name
$stmtGroup = $pdo->prepare('SELECT * FROM user_groups Where GroupId = :groupId');
$stmtGroup->execute(
    array(
        'groupId'     =>      $info_group_message['ToGroupId']
    )
);
$info_group = $stmtGroup->fetch(PDO::FETCH_ASSOC);

// get message info
$stmt = $pdo->prepare('SELECT * FROM group_messages WHERE MessageId = :messageid');
$stmt->execute(
    array(
        'messageid' => $myMessage
    )
);
$message = $stmt->fetch(PDO::FETCH_ASSOC);

// Get the user data
$fromUser =  get_user_by_id($pdo, $message["FromUserId"]);

//Mark as readed
$stmtUpdate = $pdo->prepare('UPDATE group_messages SET IsRead = 1 Where MessageId = :messageid');
$stmtUpdate->execute(
    array(
        'messageid' => $_GET["messageId"]
    )
);
?>
<?= template_header('Home', $userFirstName, $userName, $user['UserAvatar']) ?>

<div class="list-group">
    <h3><?= $fromUser['UserFirstName'] . " " . $fromUser['UserLastName'] ?>'s Message</h3>
    <div class="messages">
        <a href="" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
            <img src="<?= $fromUser['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">To: <?= $info_group['GroupName'] ?></h6>
                    <p class="mb-0 opacity-75">
                        <?= $message['Text'] ?>
                    </p>
                </div>
                <small class="opacity-50 text-nowrap"><?= $message['Timestamp'] ?></small>
            </div>
            <!-- <?php if ($message['AttachFile'] == null) {
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
            <img src="<?= $isAttached ?>" class="img-fluid img-thumbnail rounded-3 w-100 <?= $isDisplayedImg ?>" alt="...">
            <embed src="<?= $isAttached ?>" width="800px" height="210px" class="<?= $isDisplayedFile ?>" /> -->
        </a>
    </div>
    <hr class="mb-4">
    <!-- <a href="index.php?page=new-message&touserid=<?= $message['FromUserId'] ?>&tousername=<?= $message['UserName'] ?>" class="btn btn-primary btn-lg btn-block">Reply</a> -->
</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
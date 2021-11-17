<?php
//Get the session data
$userName = $_SESSION["username"];
$userFirstName = $_SESSION["userFirstName"];

// Get the message
$stmt = $pdo->prepare('SELECT * FROM Messages  INNER JOIN Users ON Messages.FromUserId = Users.UserId AND Messages.MessageId = :messageid');
$stmt->execute(
    array(
        'messageid' => $_GET["id"]
    )
);
$message = $stmt->fetch(PDO::FETCH_ASSOC);
// Get the user data
$stmtFromUserData = $pdo->prepare('SELECT * FROM Users Where UserId = :userid');
$stmtFromUserData->execute(
    array(
        'userid' => $message["FromUserId"]
    )
);
$fromUser = $stmtFromUserData->fetch(PDO::FETCH_ASSOC);

//Mark as readed
$stmtUpdate = $pdo->prepare('UPDATE Messages SET IsRead = 1 Where Messages.MessageId = :messageid');
$stmtUpdate->execute(
    array(
        'messageid' => $_GET["id"]
    )
);
?>
<?= template_header('Home', $userFirstName, $userName) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h3><?= $fromUser['UserFirstName'] . " " . $fromUser['UserLastName'] ?>'s Message</h3>
    <div class="messages">
        <a href="index.php?page=message&id=<?= $message['MessageId'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
            <img src="<?= $fromUser['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Asunto del mensaje</h6>
                    <p class="mb-0 opacity-75">
                        <?= $message['Text'] ?>
                    </p>
                </div>
                <small class="opacity-50 text-nowrap"><?= $message['Timestamp'] ?></small>
            </div>
        </a>
    </div>
    <hr class="mb-4">
    <a href="index.php?page=new-message&touserid=<?= $message['FromUserId'] ?>&tousername=<?= $message['UserName'] ?>" class="btn btn-primary btn-lg btn-block">Reply</a>
</div>

<?= template_footer() ?>
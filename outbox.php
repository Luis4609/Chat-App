<?php
// Get the latest sent messages from the logged in user
$stmt = $pdo->prepare('SELECT * FROM Messages Where FromUserId = :userid ORDER BY Timestamp DESC ');
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
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];
?>
<?= template_header('Home', $firstName, $userName) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2><?= $firstName ?>'s Outbox <i class="fas fa-inbox"></i></h2>
    <div class="messages">
        <?php foreach ($recently_added_messages as $message) : ?>
            <?php
            // Get the info of the FromUser
            $stmtFromUser = $pdo->prepare('SELECT * FROM Users Where UserId = :userid ');
            $stmtFromUser->execute(
                array(
                    'userid'     =>     $message['ToUserId']
                )
            );
            //Verify the respond data from DB
            if ($stmtFromUser == null) {
                //Error
                $errorMessage = "There was an error in the database, please wait here";
                template_error('Error', $errorMessage);
            }
            $info_from_user = $stmtFromUser->fetch(PDO::FETCH_ASSOC);
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
            </a>
        <?php endforeach; ?>
    </div>
    <hr class="mb-4">
    <a href="index.php?page=new-message" class="btn btn-primary btn-lg btn-block">New message</a>

</div>

<?= template_footer() ?>
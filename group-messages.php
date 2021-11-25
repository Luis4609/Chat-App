<?php
//Get session variables
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

// Get the log user
$info_user = get_user_by_userName($pdo, $userName);

//Check if there are parameters
if (isset($_GET["groupid"])) {
    $showGroup = $_GET["groupid"];
}
// Get the group
$info_group = get_group_by_groupId($pdo, $showGroup);

// Get the latest messages from the group
$stmtGroupMessages = $pdo->prepare('SELECT * FROM group_messages Where ToGroupId = :groupid ORDER BY Timestamp ASC ');
$stmtGroupMessages->execute(
    array(
        'groupid'     =>      $_GET["groupid"]
    )
);
$info_group_messages = $stmtGroupMessages->fetch(PDO::FETCH_ASSOC);

//Verify the respond data from DB
if ($stmtGroupMessages == null) {
    //Error
    $errorMessage = "There was an error in the database, please wait here";
    template_error('Error', $errorMessage);
}
$recently_added_messages = $stmtGroupMessages->fetchAll(PDO::FETCH_ASSOC);

//Send a message to the group
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mymessage =  $_POST['message'];
    $date = date('Y-m-d H:i:s');
    $data = [
        'fromuserid' => $info_user['UserId'],
        'togroupid' =>  $showGroup,
        'mymessage' => $mymessage,
        'newdate' => $date
        // 'attachfile'  => upload_file(false)
    ];
    //Check that the user is not sending messages to himself
    if ($userName != $tousername) {
        try {
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO group_messages (FromUserId, ToGroupId, Text, Timestamp) VALUES
            (:fromuserid, :togroupid, :mymessage, :newdate)";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
            header('location: index.php?page=group-messages&groupid=' . $showGroup);
        } catch (Exception $e) {
            $messageError = "There is not user register with that name";
        }
    } else {
        $messageError = "You cant send message to yourself, please verify the information";
        try {
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO group_messages (FromUserId, ToGroupId, Text, Timestamp) VALUES
            (:fromuserid, :togroupid, :mymessage, :newdate)";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
            header('location: index.php?page=group-messages&groupid=' . $showGroup);
        } catch (Exception $e) {
            $messageError = "There is not user register with that name";
        }
    }
}
?>
<?= template_header('Messages', $firstName, $userName, $info_user['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<!-- <div class="list-group"> -->
<h2>Group: <?= $info_group['GroupName'] ?></h2>
<div class="d-flex flex-column">
    <?php foreach ($recently_added_messages as $message) : ?>
        <?php
        //
        $stmt = $pdo->prepare('SELECT * FROM group_messages Where FromUserId = :fromUserId ORDER BY Timestamp DESC ');
        $stmt->execute(
            array(
                'fromUserId'     =>      $message['FromUserId']
            )
        );
        $messagesFromUser = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get the info of the FromUser
        $info_from_user = get_user_by_id($pdo, $message['FromUserId']);
        if (strcmp($messagesFromUser['FromUserId'], $info_user['UserId']) === 0) {
            $positionFlex = "align-self-end";
        } else {
            $positionFlex = "align-self-start";
        }
        ?>
        <div class="mb-auto <?= $positionFlex ?> ">
            <a href="index.php?page=group-message&messageId=<?= $message['MessageId'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3 " aria-current="true">
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
                <!-- <?php if ($message['AttachFile'] == null || $message['AttachFile'] == "uploads/") {
                            $isAttached = "";
                        } else {
                            $isAttached = "fas fa-paperclip";
                        } ?>
                <p>
                    <i class="<?= $isAttached ?>"></i>
                </p> -->
            </a>
        </div>
    <?php endforeach; ?>
    <hr class="mb-4">
    <form class="needs-validation" method="post" novalidate enctype="multipart/form-data">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="message" placeholder="New message" value="" name="message" required autofocus>
            <div class="input-group-append">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Send</button>
                <!-- <a href="index.php?page=group-messages&groupid=<?= $showGroup ?>" class="btn btn-primary btn-lg btn-block">Send</a> -->
            </div>
        </div>
    </form>

</div>

<!-- </div> -->

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
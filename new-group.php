<?php
//Get session variables
$userName = $_SESSION["username"];
$userId = $_SESSION['userid'];
//Error handling
if (isset($_GET["messageError"])) {
    $messageError = $_GET["messageError"];
}
// Get the user
$user = get_user_by_userName($pdo, $_SESSION["username"]);
$userFirstName = $user['UserFirstName'];
$userLastName = $user['UserLastName'];

// //Get all the active users for the SEARCH
$users = get_all_active_users($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newGroupAvatar =   upload_file(true);
    if (!isset($newGroupAvatar)) {
        $messageError = "Error uploading file";
        header('location: index.php?page=edit-user-profile&messageError=' . $messageError);
        die;
    }
    if (empty($newGroupAvatar)) {
        //Update DB without avatar
        $stmtUpdate = $pdo->prepare('INSERT INTO user_groups (GroupName) VALUES
        (:groupName)');
        $stmtUpdate->execute(
            array(
                'groupName' => $_POST['groupName'],
            )
        );
    } else {
        //Update DB with the new Avatar
        $stmtUpdate = $pdo->prepare('INSERT INTO user_groups (GroupName, GroupAvatar) VALUES
        (:groupName, :groupAvatar)');
        $stmtUpdate->execute(
            array(
                'groupName' => $_POST['groupName'],
                'groupAvatar' => $newGroupAvatar
            )
        );
    }
    // $count = $stmtUpdate->rowCount();
    // if ($count > 0) {
    //     header('location: index.php?page=groups-list');
    // } else {
    //     $messageError = "Please verify your information";
    //     header('location: index.php?page=new-group&messageError=' . $messageError);
    // }
    // Get the groupId from the new Group
    $stmtGroupId = $pdo->prepare('SELECT * FROM user_groups WHERE GroupName = :groupName');
    $stmtGroupId->execute(
        array(
            'groupName'     =>    $_POST['groupName']
        )
    );
    //Verify the respond data from DB
    if ($stmtGroupId == null) {
        //Error
        $errorcontact = "There was an error in the database, please wait here";
        template_error('Error', $errorcontact);
    }
    $groupId = $stmtGroupId->fetch(PDO::FETCH_ASSOC);

    //Insert the logged user
    $resultInsertParticipant = insert_participant_in_group($pdo, $groupId['GroupId'], $userId);
    if (!$resultInsertParticipant) {
        $messageError = "Please verify your information";
        header('location: index.php?page=new-group&messageError=' . $messageError);
    }
    //Inster selected participants
    foreach ($_POST['groupParticipants'] as $participant) {
        $resultInsertParticipant = insert_participant_in_group($pdo, $groupId['GroupId'], $participant);
        //CONTROL DE ERRORES
        if (!$resultInsertParticipant) {
            $messageError = "Please verify your information";
            header('location: index.php?page=new-group&messageError=' . $messageError);
        }
    }
    header('location: index.php?page=groups-list');
}
?>
<?= template_header('Home', $userFirstName, $userName, $user['UserAvatar']) ?>

<main class="form-signin">
    <div class="col-md-6">
        <h4 class="mb-3">New Group</h4>
        <form class="form-control-file" novalidate action="" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="groupName" class="form-label">Group name</label>
                    <input type="text" class="form-control" id="groupName" placeholder="" value="" name="groupName" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="groupParticipants" class="form-label">Group participants</label>
                    <select class="form-select" multiple aria-label="multiple select example" name="groupParticipants[]" id="groupParticipants">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['UserId'] ?>"><?= $user['UserName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="fileToUpload" class="form-label">Group avatar</label>
                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                </div>
                <?php if (isset($messageError)) {
                    template_error_inpage('Error', $messageError);
                } ?>
            </div>
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
        </form>
    </div>
    </div>
    </div>
</main>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
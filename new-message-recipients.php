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

//Check that the user is not sending messages to himself
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['messageParticipants'])) {

    $mymessage =  $_POST['message'];
    $date = date('Y-m-d H:i:s');
    $attachFile = upload_file(false);
    foreach ($_POST['messageParticipants'] as $user) {
        //Info for the message
        $data = [
            'fromuserid' => $userId,
            'touserid' => $user,
            'mymessage' => $mymessage,
            'newdate' => $date,
            'attachfile'  => $attachFile
        ];
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Messages (FromUserId, ToUserId, Text, Timestamp, AttachFile) VALUES
        (:fromuserid, :touserid, :mymessage, :newdate, :attachfile)";
        $statement = $pdo->prepare($sql);
        $statement->execute($data);
        header('location: index.php?page=home');
    }
}
?>
<?= template_header('Home', $userFirstName, $userName, $user['UserAvatar']) ?>

<main class="form-signin">
    <div class="col-md-6">
        <h4 class="mb-3">New message</h4>
        <form class="form-control-file" novalidate action="" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="message" class="form-label">Text</label>
                    <textarea type="text" class="form-control" id="message" placeholder="" value="" name="message" required></textarea>
                    <div class="invalid-feedback">
                        Valid text required.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="messageParticipants" class="form-label">Messages participants</label>
                    <select class="form-select" multiple aria-label="multiple select example" name="messageParticipants[]" id="messageParticipants">
                        <!-- <input type="text" class="form-control" id="groupParticipants" name="groupParticipants" list="contacts" placeholder="Search:" value="" required multiple> -->
                        <!--  <datalist id="contacts"> -->
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['UserId'] ?>"><?= $user['UserName'] ?></option>
                        <?php endforeach; ?>
                        <!-- </datalist> -->
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="fileToUpload" class="form-label">Attach file</label>
                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                    <!-- <input type="submit" value="Upload Image" name="submit"> -->
                </div>
                <?php if (isset($messageError)) {
                    template_error_inpage('Error', $messageError);
                } ?>
            </div>
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>
        </form>
    </div>
</main>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
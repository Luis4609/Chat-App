<?php
//Get session variables
$userName = $_SESSION["username"];
$userId = $_SESSION["userid"];
$userFirstName = $_SESSION["userFirstName"];
//Get the info user
$user = get_user_by_id($pdo, $userId);
//Get all the users for the SEARCH
$users = get_all_active_users($pdo);

//Check if there are parameters
if (isset($_GET["touserid"])) {
    $touserid = $_GET["touserid"];
} else {
    $touserid = "";
}

if (isset($_GET["tousername"])) {
    $tousernameurl = $_GET["tousername"];
    $isDisabled = "readonly";
} else {
    $tousernameurl = "";
    $isDisabled = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tousername = $_POST['username'];

    if (empty($touserid)) {
        $touserid = get_user_by_userName($pdo, $tousername);
        $touserid = $touserid['UserId'];
    }

    $mymessage =  $_POST['message'];
    $date = date('Y-m-d H:i:s');
    $data = [
        'fromuserid' => $userId,
        'touserid' => $touserid,
        'mymessage' => $mymessage,
        'newdate' => $date,
        'attachfile'  => upload_file(false)
    ];
    //Check that the user is not sending messages to himself
    if ($userName != $tousername) {
        try {
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO Messages (FromUserId, ToUserId, Text, Timestamp, AttachFile) VALUES
        (:fromuserid, :touserid, :mymessage, :newdate, :attachfile)";
            $statement = $pdo->prepare($sql);
            $statement->execute($data);
            header('location: index.php?page=home');
        } catch (Exception $e) {
            $messageError = "There is not user register with that name";
        }
    } else {
        $messageError = "You cant send message to yourself, please verify the information";
    }
}
?>
<?= template_header('New message', $userFirstName, $userName, $user['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">
<!--Form for sending a message-->
<form class="needs-validation" method="post" novalidate enctype="multipart/form-data">
    <div class="col-md-6 mb-3">
        <label for="username">To: </label>
        <!-- <input type="text" class="form-control" id="username" name="username" placeholder="" value="<?= $touseridurl ?>" required hidden> -->
        <input type="text" class="form-control" id="username" name="username" list="contacts" placeholder="" value="<?= $tousernameurl ?>" <?= $isDisabled ?> required>
        <div class="invalid-feedback">
            Valid user name is required.
        </div>
        <datalist id="contacts">
            <?php foreach ($users as $user) : ?>
                <option value="<?= $user['UserName'] ?>">
                <?php endforeach; ?>
        </datalist>
    </div>
    <div class="col-md-6 mb-3">
        <label for="message">Message</label>
        <textarea type="text" class="form-control" id="message" name="message" placeholder="New message" value="" required></textarea>
        <div class="invalid-feedback">
            Valid message is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="fileToUpload" class="form-label">Attach file or image</label>
        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
    </div>
    <?php if (isset($messageError)) {
        template_error_inpage('Error', $messageError);
    } ?>
    <div class="col-md-6 mb-3">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Send</button>
        <a href="index.php?page=new-message-recipients" class="btn btn-primary btn-lg btn-block">Send message to multiple users</a>
    </div>
</form>

<!--Validation script for the form-->
<script>
    //JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
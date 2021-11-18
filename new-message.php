<?php
//Get session variables
$userName = $_SESSION["username"];
$userId = $_SESSION["userid"];
$userFirstName = $_SESSION["userFirstName"];
//Check if there are parameters
if (isset($_GET["touserid"])) {
    $touserid = $_GET["touserid"];
} else {
    $touserid = "";
}

if (isset($_GET["tousername"])) {
    $tousernameurl = $_GET["tousername"];
    $isDisabled = "readonly";  //LE HE CAMBIADO A READONLY PORQUE CON DISABLED, SE PODIA MODIFICAR LA ENTRADA
} else {
    $tousernameurl = "";
    $isDisabled = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tousername = $_POST['username'];

    if (empty($touserid)) {
        $dataUserId = [
            'userName' => $tousername,
        ];
        //Query to get UserId by Name
        $sqlUserId = "SELECT UserId FROM Users where UserName = :userName";
        $statementUserId = $pdo->prepare($sqlUserId);
        $statementUserId->execute($dataUserId);

        $touserid = $statementUserId->fetch(PDO::FETCH_ASSOC);
        $touserid = $touserid['UserId'];
    }

    $mymessage =  $_POST['message'];
    $date = date('Y-m-d H:i:s');
    $data = [
        'fromuserid' => $userId,
        'touserid' => $touserid,
        'mymessage' => $mymessage,
        'newdate' => $date
    ];
    //Check that the user is not sending messages to 
    if ($userName != $tousername) {
        try {
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO Messages (FromUserId, ToUserId, Text, Timestamp) VALUES
        (:fromuserid, :touserid, :mymessage, :newdate)";
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
<?= template_header('Home', $userFirstName, $userName) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">
<!--Form for sending a message-->
<form class="needs-validation" method="post" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="username">To: </label>
            <!-- <input type="text" class="form-control" id="username" name="username" placeholder="" value="<?= $touseridurl ?>" required hidden> -->
            <input type="text" class="form-control" id="username" name="username" placeholder="" value="<?= $tousernameurl ?>" <?= $isDisabled ?> required>
            <div class="invalid-feedback">
                Valid user name is required.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="message">Message</label>
            <input type="text" class="form-control" id="message" name="message" placeholder="New message" value="" required>
            <div class="invalid-feedback">
                Valid message is required.
            </div>
        </div>
    </div>
    <?php if (isset($messageError)) {
        template_error_inpage('Error', $messageError);
    } ?>
    <button class="btn btn-primary btn-lg btn-block" type="submit">Send</button>
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
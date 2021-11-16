<?php
//Get session variables
$userName = $_SESSION["username"];
$userId = $_SESSION["userid"];
$userFirstName = $_SESSION["userFirstName"];
//Get the list of users
$stmt = $pdo->prepare('SELECT * FROM Users');
$stmt->execute();
if ($stmt == null) {
    //Error
    $errorcontact = "There was an error in the database, please wait here";
    template_error('Error', $errorcontact);
}
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

$stmt = $pdo->prepare('SELECT * FROM Messages Where ToUserId = :userid ORDER BY Timestamp DESC ');
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

//Send a friend request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newFriend = $_POST['username'];

    if (empty($newFriend)) {
        $dataUserId = [
            'userName' => $newFriend,
        ];
        //Query to get UserId by Name
        $sqlUserId = "SELECT UserId FROM Users where UserName = :userName";
        $statementUserId = $pdo->prepare($sqlUserId);
        $statementUserId->execute($dataUserId);

        $newFriend = $statementUserId->fetch(PDO::FETCH_ASSOC);
        $newFriend = $newFriend['UserId'];
    }
    $date = date('Y-m-d H:i:s');
    $data = [
        'fromuserid' => $userId,
        'newFriend' => $newFriend,
    ];
}
?>
<?= template_header('Home', $userFirstName, $userName) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">
<!--Form for sending a message-->
<form class="needs-validation" method="post" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
            <!-- <label for="username">Search:</label> -->
            <!-- <input type="text" class="form-control" id="username" name="username" placeholder="" value="<?= $touseridurl ?>" required hidden> -->
            <input type="text" class="form-control" id="username" name="username" list="contacts" placeholder="Search:" value="" required>
            <div class="invalid-feedback">
                Valid user name is required.
            </div>
            <datalist id="contacts">
                <!--OBTENER AQUI LA LISTA DE CONTACTOS DEL USUARIO-->
                <?php foreach ($users as $user) : ?>
                    <option value="<?php $user['UserName'] ?>">
                    <?php endforeach; ?>
            </datalist>
        </div>
    </div>
    <button class="btn btn-primary btn-lg btn-block" type="submit">Send friend request</button>
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
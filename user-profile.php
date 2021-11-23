<?php
//Get the session variables
$userNameSession = $_SESSION["username"];
$userFirstName = $_SESSION["userFirstName"];
$userSession = get_user_by_userName($pdo, $userNameSession);

// Get info of the user
$user = get_user_by_userName($pdo, $_GET["username"]);


//If the user is looking his own profile, the SEND A MESSAGE button dont apear.
if ($_GET['username'] == $userNameSession) {
    $isDisabled = "d-none";
} else {
    $isDisabled = "";
}
//If the user is looking his own profile, HE CAN EDIT HIS PROFILE.
if ($_GET['username'] != $userNameSession) {
    $isDisabledEdit = "d-none";
} else {
    $isDisabledEdit = "";
}

?>
<?= template_header('Home', $userFirstName, $userNameSession, $userSession['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <div class="card mb-3 border-light" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= $user['UserAvatar'] ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['UserFirstName'] . " " .  $user['UserLastName'] ?></h5>
                    <p class="card-text">Email: <?= $user['UserName'] ?></p>
                    <p class="card-text">Age: <?= $user['Age'] ?></p>
                    <p class="card-text">Address: <?= $user['Address'] ?></p>
                </div>

            </div>
        </div>
    </div>
    <hr class="mb-4">
    <a href="index.php?page=edit-user-profile" class="btn btn-primary btn-lg btn-block <?= $isDisabledEdit ?>">
        Edit profile
    </a>
    <a href="index.php?page=new-message&touserid=<?= $user['UserId'] ?>&tousername=<?= $user['UserName'] ?>" class="btn btn-primary btn-lg btn-block <?= $isDisabled ?>">Send a message</a>
</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
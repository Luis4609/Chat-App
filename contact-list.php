<?php
//Get the session variables
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];
//Get the info of the log user
$user = get_user_by_userName($pdo, $userName);
// Get the contact list of a user
$stmt = $pdo->prepare('SELECT * FROM Users WHERE UserName != :username AND IsActive = 1');
$stmt->execute(
    array(
        'username'  =>  $_SESSION["username"]
    )
);
//Verify the respond data from DB
if ($stmt == null) {
    //Error
    $errorcontact = "There was an error in the database, please wait here";
    template_error('Error', $errorcontact);
}
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">
<?= template_header('Home', $firstName, $userName, $user['UserAvatar']) ?>

<div class="list-group">
    <h2><?= $firstName ?>'s Contact List <i class="fas fa-inbox"></i></h2>
    <div class="contacts">
        <?php foreach ($contacts as $contact) : ?>
            <a class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <!-- <a href="index.php?page=new-message&tousername=<?= $contact['UserName'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true"> -->
                <img src="<?= $contact['UserAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0"> <?= $contact['UserName'] ?></h6>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <hr class="mb-4">
    <a href="index.php?page=new-contact" class="btn btn-primary btn-lg btn-block">Add friend</a>

</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
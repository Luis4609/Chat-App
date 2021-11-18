<?php
//Get the session variables
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];
// Get the contact list of a user
$stmt = $pdo->prepare('SELECT * FROM Users WHERE UserName != :username');
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
<?= template_header('Home', $firstName, $userName) ?>
<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2><?= $firstName ?>'s Contact List <i class="fas fa-inbox"></i></h2>
    <div class="contacts">
        <?php foreach ($contacts as $contact) : ?>
            <a href="index.php?page=user-profile&username=<?= $contact['UserName'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
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
    <a href="index.php?page=new-contact" class="btn btn-primary btn-lg btn-block">New contact</a>

</div>

<?= template_footer() ?>
<?php
//Get the session variables
$userId = $_SESSION['userid'];
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

//Get 
$user = get_user_by_userName($pdo, $userName);
// Get the group list of the logged user
$stmtGroupList = $pdo->prepare('SELECT * FROM group_participants WHERE UserId = :userid');
$stmtGroupList->execute(
    array(
        'userid'     =>     $userId
    )
);
//Verify the respond data from DB
if ($stmtGroupList == null) {
    //Error
    $errorcontact = "There was an error in the database, please wait here";
    template_error('Error', $errorcontact);
}
$groups = $stmtGroupList->fetchAll(PDO::FETCH_ASSOC);
// Get the group info
$stmtGroup = $pdo->prepare('SELECT * FROM group_participants WHERE UserId = :userid');
$stmtGroup->execute(
    array(
        'userid'     =>     $userId
    )
);
//Verify the respond data from DB
if ($stmtGroup == null) {
    //Error
    $errorcontact = "There was an error in the database, please wait here";
    template_error('Error', $errorcontact);
}
$friends = $stmtGroup->fetchAll(PDO::FETCH_ASSOC);
?>
<?= template_header('Groups', $firstName, $userName, $user['UserAvatar']) ?>
<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<div class="list-group">
    <h2><?= $firstName ?>'s Group List <i class="fas fa-inbox"></i></h2>
    <div class="contacts">
        <?php foreach ($groups as $group) : ?>
            <?php
            // Get the group name
            $stmtGroupName = $pdo->prepare('SELECT * FROM user_groups WHERE GroupId = :groupid');
            $stmtGroupName->execute(
                array(
                    'groupid'     =>    $group['GroupId']
                )
            );
            //Verify the respond data from DB
            if ($stmtGroupName == null) {
                //Error
                $errorcontact = "There was an error in the database, please wait here";
                template_error('Error', $errorcontact);
            }
            $groupName = $stmtGroupName->fetch(PDO::FETCH_ASSOC);
            ?>
            <a href="index.php?page=group-messages&groupid=<?= $groupName['GroupId'] ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="<?= $groupName['GroupAvatar'] ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" />
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0"> <?= $groupName['GroupName'] ?></h6>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <hr class="mb-4">
    <a href="index.php?page=new-group" class="btn btn-primary btn-lg btn-block">New group</a>
</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
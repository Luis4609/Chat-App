<?php
//Get session variables
$userName = $_SESSION["username"];
$userId = $_SESSION["userid"];
$userFirstName = $_SESSION["userFirstName"];
$user = get_user_by_id($pdo, $userId);
//Get all the users for the SEARCH
$stmt = $pdo->prepare('SELECT * FROM users WHERE UserName != :username');
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
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Send a friend request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newFriend = $_POST['username'];

    if (!empty($newFriend)) {
        $dataUserId = [
            'userName' => $newFriend,
        ];
        //Query to get UserId by Name
        $sqlUserId = "SELECT UserId FROM users where UserName = :userName";
        $statementUserId = $pdo->prepare($sqlUserId);
        $statementUserId->execute($dataUserId);

        $newFriendStmt = $statementUserId->fetch(PDO::FETCH_ASSOC);
        $newFriendId = $newFriendStmt['UserId'];
    }
    //Data for the friend request
    $date = date('Y-m-d H:i:s');
    $data = [
        'fromuserid' => $userId,
        'newFriend' => $newFriendId,
        'dateRequest' => $date
    ];
    //Send a friend request
    //Check that the user is not sending messages to 
    if ($userId != $newFriendId) {
        try {
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlFriendRequest = "INSERT INTO friends (UserId, UserId2, Timestamp) VALUES
            (:fromuserid, :newFriend, :dateRequest)";
            $statementUserId = $pdo->prepare($sqlFriendRequest);
            $statementUserId->execute($data);
            header('location: index.php?page=contact-list');
        } catch (Exception $e) {
            $messageError = "You are already friends";
            template_error_inpage('Error', $messageError);
        }
    } else {
        $messageError = "You cant send message to yourself, please verify the information";
        template_error('Error', $messageError);
    }
}
?>
<?= template_header('Home', $userFirstName, $userName, $user['UserAvatar']) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

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
                <?php foreach ($users as $user) : ?>
                    <option value="<?= $user['UserName'] ?>">
                    <?php endforeach; ?>
            </datalist>
        </div>
    </div>
    <button class="btn btn-primary btn-lg btn-block" type="submit">Send friend request</button>
</form>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
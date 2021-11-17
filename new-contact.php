<?php
//Get session variables
$userName = $_SESSION["username"];
$userId = $_SESSION["userid"];
$userFirstName = $_SESSION["userFirstName"];

//Get all the users for the SEARCH
$stmt = $pdo->prepare('SELECT * FROM Users');
$stmt->execute();
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
    //Data for the friend request
    $date = date('Y-m-d H:i:s');
    $data = [
        'fromuserid' => $userId,
        'newFriend' => $newFriend,
        'dateRequest' => $date
    ];
    //Send a friend request
    $sqlFriendRequest = "INSERT INTO Friends (UserName, UserName2, Timestamp ) VALUES
    (:userName, :newFriend, :dateRequest)";
    $statementUserId = $pdo->prepare($sqlUserId);
    $statementUserId->execute($data);
}
?>
<?= template_header('Home', $userFirstName, $userName) ?>

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
                <!--OBTENER AQUI LA LISTA DE CONTACTOS DEL USUARIO-->
                <?php foreach ($users as $user) : ?>
                    <option value="<?= $user['UserName'] ?>">
                    <?php endforeach; ?>
            </datalist>
        </div>
    </div>
    <button class="btn btn-primary btn-lg btn-block" type="submit">Send friend request</button>
</form>

<?= template_footer() ?>
<?php
// Get the message
$stmt = $pdo->prepare('SELECT * FROM Users Where UserName = :username');
$stmt->execute(
    array(
        'username' => $_GET["username"]
    )
);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userName = $_SESSION["username"];
$userFirstName = $user['UserFirstName'];

?>
<?= template_header('Home', $userFirstName, $userName) ?>

<link href="/Chat-App/assets/dist/css/list-groups.css" rel="stylesheet">

<!-- <div class="featured">
    <h2> <?= $userName ?></h2>
</div> -->
<!-- <div class="list-group">
    <h2>Profile of <?= $user['UserFirstName'] ?></h2>
    <div class="user">
        <img src="/Chat-App/uploads/user_defualt_avatar.jpg" alt="twbs" width="60" height="60" class="rounded-circle flex-shrink-0" />
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0"> <?= $user['UserName'] ?></h6>
            </div>
        </div>

    </div>
    <form action="upload-file.php" method="post" enctype="multipart/form-data">
         <label for="fileToUpload">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div> -->
<div class="list-group">
    <div class="card mb-3 border-light" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/Chat-App/uploads/user_defualt_avatar.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <a href="index.php?page=edit-user-profile">
                    <div class="card-header">Editar perfil</div>
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?= $user['UserFirstName'] . " " .  $user['UserLastName'] ?></h5>
                    <p class="card-text"><?= $user['UserName'] ?></p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
        <!-- <form action="upload-file.php" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">New avatar:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form> -->
    </div>
</div>

<?= template_footer() ?>
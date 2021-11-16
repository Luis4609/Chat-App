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
<!-- Look if we need to display de current user name or some info on the message page -->
<!-- <div class="featured">
    <h2> <?= $userName ?></h2>
</div> -->
<div class="list-group">
    <h2>Profile of <?= $user['UserFirstName'] ?></h2>
    <div class="user">
        <!-- <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0" /> -->
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0"> <?= $user['UserName'] ?></h6>
            </div>
            <!-- <small class="opacity-50 text-nowrap"><?= $user['Timestamp'] ?></small> -->
        </div>

    </div>
    <form action="upload-file.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>
<div class="card" style="width: 18rem;">
    <img src="/uploads/Dva x Lucio.jpg" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>

<?= template_footer() ?>
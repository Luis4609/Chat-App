<?php
// Get the message
$stmt = $pdo->prepare('SELECT * FROM Users Where UserName = :getusername');
$stmt->execute(
    array(
        'getusername' => $_GET["username"]
    )
);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userNameSession = $_SESSION["username"];
$userFirstName = $user['UserFirstName'];

?>
<?= template_header('Home', $userFirstName, $userNameSession) ?>

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
                    <p class="card-text">Age:</p>
                    <p class="card-text">Direccion:</p>
                    <p class="card-text">Hobbies:</p>

                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
                <a href="index.php?page=edit-user-profile" class="card-link">
                    <div class="card-header">Editar perfil</div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= template_footer() ?>
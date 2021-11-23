<?php
//Get session variables
$userName = $_SESSION["username"];
//Error handling
if (isset($_GET["messageError"])) {
    $messageError = $_GET["messageError"];
}
// Get the user
$user = get_user_by_userName($pdo, $_SESSION["username"]);

$userFirstName = $user['UserFirstName'];
$userLastName = $user['UserLastName'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // //Update the user AVATAR
    // if (isset($fileToUpload)) {
    //     $newUserAvatar =   upload_file();
    //     echo $newUserAvatar;
    // }

    $newUserAvatar =   upload_file(true);

    if (!isset($newUserAvatar)) {
        $messageError = "Error uploading file";
        header('location: index.php?page=edit-user-profile&messageError=' . $messageError);
        die;
    }

    if (empty($newUserAvatar)) {
        //Update DB without avatar
        $stmtUpdate = $pdo->prepare('UPDATE Users SET Age = :age, Address = :address Where UserName = :userName');
        $stmtUpdate->execute(
            array(
                'age' => $_POST['age'],
                'address' => $_POST['address'],
                'userName' => $userName
            )
        );
    } else {
        //Update DB with the new Avatar
        $stmtUpdate = $pdo->prepare('UPDATE Users SET Age = :age, Address = :address, UserAvatar = :userAvatar Where UserName = :userName');
        $stmtUpdate->execute(
            array(
                'userAvatar' => $newUserAvatar,
                'age' => $_POST['age'],
                'address' => $_POST['address'],
                'userName' => $userName
            )
        );
    }


    $count = $stmtUpdate->rowCount();
    if ($count > 0) {
        header('location: index.php?page=user-profile&username=' . $userName);
    } else {
        $messageError = "Please verify your information";
        header('location: index.php?page=edit-user-profile&messageError=' . $messageError);
    }
}
?>

<?= template_header('Edit user profile', $userFirstName, $userName, $user['UserAvatar']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <main class="form-signin ">
                <div class="col-md-7 col-lg-7">
                    <h4 class="mb-3">Edit profile</h4>
                    <form class="form-control-file" novalidate action="" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="<?= $userFirstName ?>" name="firstName" required readonly>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="<?= $userLastName ?>" name="lastName" required disabled>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="<?= $userName ?>" placeholder="you@example.com" name="email" readonly>
                                <!--Change the READONLY -->
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" placeholder="" name="age" min="1" max="120" value="<?= $user['Age'] ?>">
                                <div class="invalid-feedback">
                                    Please enter your age.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" value="<?= $user['Address'] ?>">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="fileToUpload" class="form-label">New avatar</label>
                                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                            </div>
                            <?php if (isset($messageError)) {
                                template_error_inpage('Error', $messageError);
                            } ?>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
                    </form>
                </div>

            </main>
        </div>
        <div class="col">
            <img src=" <?= $user['UserAvatar'] ?>" class="img-fluid img-thumbnail rounded float-end" alt="...">
        </div>
    </div>
</div>

<?= template_footer() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
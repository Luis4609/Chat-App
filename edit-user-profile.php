<?php
//Get session variables
$userName = $_SESSION["username"];

// Get the user
$stmt = $pdo->prepare('SELECT * FROM Users Where UserName = :username');
$stmt->execute(
    array(
        'username' => $_SESSION["username"]
    )
);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userFirstName = $user['UserFirstName'];
$userLastName = $user['UserLastName'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'upload-file.php';
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $newUserAvatar = $target_file;
    //  echo $newUserAvatar;
    // //Update DB with the new Avatar
    // //Mark as readed
    // $stmtUpdate = $pdo->prepare('UPDATE Users SET UserAvatar = :userAvatar Where UserName = :userName');
    // $stmtUpdate->execute(
    //     array(
    //         'userAvatar' => $newUserAvatar,
    //         'userName' => $userName
    //     )
    // );
    // $count = $stmtUpdate->rowCount();
    // if ($count > 0) {
    //     header('location: index.php?page=home');
    // }else {
    //     $messageError = "Please verify your information";
    //     header('location: index.php?page=edit-user-profile&messageError=' . $messageError);
    //   }
}
?>
<?= template_header('Home', $userFirstName, $userName) ?>
<style>
    .container {
        max-width: 960px;
    }
</style>
<div class="container">
    <main>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Profile</h4>
            <form class="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" id="age" placeholder="" name="age" required>
                        <div class="invalid-feedback">
                            Please enter your age.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" required>
                            <option value="">Choose...</option>
                            <option>United States</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" required>
                            <option value="">Choose...</option>
                            <option>California</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="zip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="fileToUpload" class="form-label">New avatar</label>
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                        <!-- <input type="submit" value="Upload Image" name="submit"> -->
                    </div>
                </div>
                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-lg" type="submit">Edit</button>
            </form>
        </div>
</div>
</div>
</main>
</div>

<?= template_footer() ?>
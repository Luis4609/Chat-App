<?php
// Get the user
$stmt = $pdo->prepare('SELECT * FROM Users Where UserName = :username');
$stmt->execute(
    array(
        'username' => $_SESSION["username"]
    )
);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userName = $_SESSION["username"];
$userFirstName = $user['UserFirstName'];
$userLastName = $user['UserLastName'];


?>
<?= template_header('Home', $userFirstName, $userName) ?>
<style>
    .container {
        max-width: 960px;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
<div class="container">
    <main>
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/Chat-App/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h2>Editar perfil</h2>
        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Profile</h4>
            <form class="needs-validation" action="" novalidate action="upload-file.php" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="<?= $userFirstName ?>" required readonly>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="<?= $userLastName ?>" required disabled>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
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
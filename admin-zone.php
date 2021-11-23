<?php

//Get the session variables
$userName = $_SESSION["username"];
$firstName = $_SESSION["userFirstName"];

//Verify user role
if (!is_user_in_role(ADMINROLE)) {
  //Error
  $errorMessage = "Unauthorized";
  template_error('Error', $errorMessage);
}
// // Get the user list for the admin
$users = get_all_users($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Zone</title>
  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="/Chat-App/assets/dist/css/dashboard.css" rel="stylesheet" />
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Message App</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" />
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="index.php">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=home">
                <span data-feather="file"></span>
                Go to message-app
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrapalign-items-center pt-3pb-2mb-3border-bottom">
          <h1 class="h2">Users List</h1>
        </div>
        <div class="table-responsive">
          <table class="table table-dark table-striped table-hover table-sm">
            <thead>
              <tr>
                <th scope="col">UserId</th>
                <th scope="col">Email</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Active</th>
                <th scope="col">Role</th>
                <th scope="col">Avatar</th>
                <th scope="col">Buttons</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user) : ?>
                <tr>
                  <td> <?= $user['UserId'] ?></td>
                  <td><?= $user['UserName'] ?></td>
                  <td><?= $user['UserFirstName'] ?></td>
                  <td><?= $user['UserLastName'] ?></td>
                  <td><?= $user['IsActive'] ?></td>
                  <td><?= $user['Role'] ?></td>
                  <td><?= $user['UserAvatar'] ?></td>
                  <td>
                    <!-- <a class="btn btn-sm btn-outline-secondary" href="index.php?page=admin-zone-actions&editUser=1&userId=<?= $user['UserId'] ?>">
                      Edit
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="index.php?page=admin-zone-actions&deleteUser=1&userId=<?= $user['UserId'] ?>">
                      Delete
                    </a> -->
                    <a class="btn btn-sm btn-outline-secondary" href="index.php?page=admin-zone-actions&changeActive=1&userId=<?= $user['UserId'] ?>">
                      <?php if ($user['IsActive'] == 0) {
                        $isActive = "Activete user";
                      } else {
                        $isActive = "Desactivate user";
                      }
                      ?>
                      <?= $isActive ?>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="index.php?page=admin-zone-actions&changeRole=1&userId=<?= $user['UserId'] ?>">
                      <?php if ($user['Role'] == 0) {
                        $getRole = "Make to admin";
                      } else {
                        $getRole = "Make user";
                      }
                      ?>
                      <?= $getRole ?>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="assets/dist/js/dashboard.js"></script>
</body>

</html>
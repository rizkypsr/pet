<?php

include_once('../src/database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $sql = "SELECT * FROM users WHERE username='" . $username . "'";
    $result = $conn->query($sql);
    $user = mysqli_fetch_object($result);

    if ($result->num_rows > 0) {
        header("location: register.php?error=Username sudah terdaftar");
    } else {
        $sql = "INSERT INTO users (username, name, password) VALUES ('" . $username . "', '" . $name . "', '" . $password . "')";

        if ($conn->query($sql)) {
            header("location: register.php?success=Berhasil mendaftarkan akun.");
        } else {
            die("Error: " . $conn->error);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Main -->
    <div class="d-flex flex-column align-items-center justify-content-center h-100">
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_GET['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_GET['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="card" style="width: 50%;">
            <div class="card-body p-0 m-0">
                <div class="row">
                    <div class="col d-none d-md-block">
                        <img src="/public/images/giphy2.gif" alt="">
                    </div>
                    <div class="col d-flex flex-column justify-content-center me-4">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="name" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn text-light" style="background-color: #F9AB5C;">Buat Akun</button>
                            <a href="login.php" class="btn btn-link" style="color: #F9AB5C;">Masuk</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
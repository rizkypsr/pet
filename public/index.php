<?php

include_once('../src/database/database.php');
include_once('../src/helper/helper.php');

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}

$sql = "SELECT * FROM animal";
$results = $conn->query($sql);

$animals = $results->num_rows;

$sql = "SELECT * FROM customer";
$results = $conn->query($sql);

$customers = $results->num_rows;

$sql = "SELECT * FROM transaction";
$results = $conn->query($sql);

$transactions = $results->num_rows;

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
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f9f1ed;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="<?php echo getBaseUrl() ?>images/logo.jpg" alt="" width="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-4">
                        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link" href="customer.php">Pelanggan</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link" href="animal.php">Hewan</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link" href="transaction.php">Transaksi</a>
                    </li>
                </ul>
                <form class="d-flex align-items-center" action="logout.php" method="POST">
                    <?php if (isset($_SESSION['auth'])) { ?>
                        <div class="me-3">Selamat Datang, Senja</div>
                        <button type="submit" class="btn text-light" style="background-color: #F9AB5C;">Logout</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->

    <!-- Main -->
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="card" style="background-color: #F9AB5C;">
                        <div class="card-body">
                            <h2><?php echo $customers ?></h2>
                            <p>Total Pelanggan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="border-color: #F9AB5C;">
                        <div class="card-body">
                            <h2><?php echo $animals ?></h2>
                            <p>Total Hewan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="background-color: #F9AB5C;">
                        <div class="card-body">
                            <h2><?php echo $transactions ?></h2>
                            <p>Total Transaksi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <img class="mt-3" src="<?php echo getBaseUrl() ?>/images/giphy.gif" alt="">
            </div>
        </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hewan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f9f1ed;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="/public/images/logo.jpg" alt="" width="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-4">
                        <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link active" href="customer.php">Pelanggan</a>
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
            <div class="card" style="background-color: rgba(255, 242, 237, 0.1);">
                <h4 class="card-header">Ubah Data User</h4>
                <div class="card-body">
                    <form action="store_customer.php" method="POST">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
                        </div>
                        <button type="submit" class="btn text-light" style="background-color: rgba(0, 91, 192, 0.7);">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
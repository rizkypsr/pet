<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    include_once('../src/database/database.php');

    $id = $_GET["id"];

    $sql = "SELECT * FROM animal where id=" . $id;
    $result = $conn->query($sql);

    $sql = "SELECT * FROM customer";
    $customers = $conn->query($sql);
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
                        <a class="nav-link" href="customer.php">Pelanggan</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link active" href="animal.php">Hewan</a>
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
                <h4 class="card-header">Ubah Data Hewan</h4>
                <div class="card-body">
                    <form action="update_animal.php" method="POST" enctype="multipart/form-data">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <div class="mb-3">
                                <label for="owner" class="form-label">Owner</label>
                                <select id="owner" name="owner" class="form-select" required>
                                    <?php while ($customer = $customers->fetch_assoc()) { ?>
                                        <option <?php echo ($row['owner_id'] == $customer['id']) ? 'selected' : '' ?> value="<?php echo $customer['id'] ?>"><?php echo $customer['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Jenis Hewan</label>
                                <input type="text" class="form-control" id="type" name="type" value="<?php echo $row['type'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto Hewan</label>
                                <input class="form-control" type="file" id="photo" name="photo">
                            </div>
                            <button type="submit" class="btn text-light" style="background-color: rgba(0, 91, 192, 0.7);">Simpan Perubahan</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
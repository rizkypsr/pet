<?php

include_once('../src/database/database.php');

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}


$sql = "SELECT customer.name as cname, customer.address as caddress, animal.* FROM customer INNER JOIN animal ON customer.id = animal.owner_id WHERE customer.id = " . $_GET['id'];
$results = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f9f1ed;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="/public/images/logo.jpg" alt="" width="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
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
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main>
        <div class="container mt-5">
            <?php if ($results->num_rows > 0) { ?>
                <div class="row">
                    <div class="col">
                        <div class="card" style="background-color: rgba(255, 242, 237, 0.1);">
                            <h4 class="card-header">Detail Pelanggan</h4>
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <?php if ($row = mysqli_fetch_assoc($results)) { ?>
                                            <tr>
                                                <th>Nama</th>
                                                <td><?php echo $row['cname'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td><?php echo $row['caddress'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tgl Daftar</th>
                                                <td><?php echo $row['created_at'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="background-color: rgba(255, 242, 237, 0.1);">
                            <h4 class="card-header">Detail Hewan</h4>
                            <div class="card-body">
                                <ol class="list-group list-group-numbered">
                                    <?php foreach ($results as $result) { ?>
                                        <li class="list-group-item" style="background-color: rgba(255, 242, 237, 0.1);"><?php echo $result['name'] . " (" . $result["type"] . ")" ?></li>
                                    <?php }  ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {  ?>
                <div class="div d-flex justify-content-center">
                    <h2>Tidak Ada Hewan yang terdaftar</h2>
                </div>
            <?php } ?>

        </div>


    </main>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
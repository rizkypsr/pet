<?php

include_once('../src/database/database.php');

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}


$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
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
            <div class="row">
                <div class="col-2">
                    <a class="btn text-light mb-3" href="create_customer.php" style="background-color: rgba(28, 125, 49, 0.7);">Tambah Pelanggan</a>
                </div>
                <div class="col-10">
                    <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </div>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_GET['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <div class="card" style="background-color: rgba(255, 242, 237, 0.1);">
                <h4 class="card-header">Data Pelanggan</h4>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Tgl Daftar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <?php $index = 1 ?>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <th scope="row"><?php echo $index++ ?></th>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['created_at'] ?></td>
                                    <td style="width: 30rem;">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 py-1">
                                                <a class="btn w-100" href="user_detail.php?id=<?php echo $row['id'] ?>" style="background-color: rgba(249, 171, 92, 0.7);">Lihat Hewan</a>
                                            </div>
                                            <div class="col-sm-12 col-md-4 py-1">
                                                <a class="btn w-100 text-light" href="edit_customer.php?id=<?php echo $row['id'] ?>" style="background-color: rgba(0, 91, 192, 0.7);">Ubah</a>
                                            </div>
                                            <div class="col-sm-12 col-md-4 py-1">
                                                <button type="button" class="delete btn btn w-100 text-light" style="background-color: rgba(165, 38, 49, 0.7);" data-id="<?php echo $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menghapus user ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="delete_customer.php" method="POST">
                            <input id="inputId" type="hidden" name="id">
                            <button type="submit" class="btn btn-danger" href="delete_user.php">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".delete").click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                $("#inputId").val(id);
            });

            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'search_customer.php',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#data').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>
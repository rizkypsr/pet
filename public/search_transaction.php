<?php
if (isset($_POST['search'])) {
    include_once('../src/database/database.php');

    $search = $_POST['search'];

    $sql = "SELECT customer.name as cname, transaction.* FROM customer INNER JOIN transaction ON customer.id = transaction.customer_id WHERE customer.name LIKE '%" . $search . "%'";
    $result = $conn->query($sql);

    $index = 1;

    while ($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <th scope="row"><?php echo $index++ ?></th>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['cname'] ?></td>
            <td><?php echo $row['total'] ?></td>
            <td><?php echo $row['created_at'] ?></td>
            <td style="width: 30rem;">
                <div class="row">
                    <div class="col-sm-12 col-md-4 py-1">
                        <a class="btn w-100 text-light" href="edit_transaction.php?id=<?php echo $row['id'] ?>" style="background-color: rgba(0, 91, 192, 0.7);">Ubah</a>
                    </div>
                    <div class="col-sm-12 col-md-4 py-1">
                        <button id="delete" type="button" class="btn btn w-100 text-light" style="background-color: rgba(165, 38, 49, 0.7);" data-id="<?php echo $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Hapus
                        </button>
                    </div>
                </div>
            </td>
        </tr>
<?php }
} ?>
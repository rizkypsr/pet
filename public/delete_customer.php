<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    var_dump($_POST["id"]);

    $sql = "SELECT * FROM animal WHERE owner_id=" . $_POST["id"];
    $customerInAnimalTable = $conn->query($sql);

    $sql = "SELECT * FROM transaction WHERE customer_id=" . $_POST["id"];
    $customerInTransactionTable = $conn->query($sql);

    $validateCustomer = $customerInAnimalTable->num_rows > 0 || $customerInTransactionTable->num_rows > 0;

    if ($validateCustomer) {
        header("location: customer.php?error=Data pelanggan tidak dapat dihapus. Data digunakan di tabel lain");
    } else {
        $sql = "DELETE FROM customer WHERE id=" . $_POST["id"];

        if ($conn->query($sql)) {
            header("location: customer.php");
        }
    }
}

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $sql = "DELETE FROM transaction WHERE id=" . $_POST["id"];

    if ($conn->query($sql)) {
        header("location: transaction.php");
    } else {
        die("Error deleting record: " . $conn->error);
    }
}

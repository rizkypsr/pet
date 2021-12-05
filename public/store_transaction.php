<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $user = (int) $_POST["user"];
    $total = (int) $_POST["total"];

    $sql = "INSERT INTO transaction (customer_id, total) VALUES ('" . $user . "', '" . $total . "')  ";

    if ($conn->query($sql)) {
        header("location: transaction.php");
    } else {
        die("Error deleting record: " . $conn->error);
    }
}

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST['id'];
    $user = (int) $_POST["user"];
    $total = (int) $_POST["total"];

    $sql = "UPDATE transaction SET customer_id='" . $user . "', total='" . $total . "' WHERE id=" . $id;

    if ($conn->query($sql)) {
        header("location: transaction.php");
    } else {
        die("Error deleting record: " . $conn->error);
    }
}

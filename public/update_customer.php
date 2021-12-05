<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $address = $_POST["address"];

    $sql = "UPDATE customer SET name='" . $name . "', address='" . $address . "' WHERE id=" . $id;

    if ($conn->query($sql)) {
        header("location: customer.php");
    } else {
        die("Error deleting record: " . $conn->error);
    }
}

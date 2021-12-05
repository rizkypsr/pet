<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];

    $sql = "INSERT INTO customer (name, address) VALUES ('" . $name . "', '" . $address . "')  ";

    if ($conn->query($sql)) {
        header("location: customer.php");
    } else {
        die("Error deleting record: " . $conn->error);
    }
}

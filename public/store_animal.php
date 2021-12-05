<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $owner = $_POST["owner"];
    $name = $_POST["name"];
    $type = $_POST["type"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO animal (owner_id, name, type, photo) VALUES ('" . $owner . "', '" . $name . "', '" . $type . "', '" . $_FILES["photo"]["name"] . "')  ";

        if ($conn->query($sql)) {
            header("location: animal.php");
        } else {
            die("Error deleting record: " . $conn->error);
        }
    } else {
        echo "Error Saat Upload Gambar";
    }
}

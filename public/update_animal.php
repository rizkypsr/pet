<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $owner = $_POST["owner"];

    if (!is_uploaded_file($_FILES['photo']['tmp_name'])) {
        $sql = "UPDATE animal SET owner_id='" . $owner . "', type='" . $type . "', name='" . $name . "' WHERE id=" . $id;
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $sql = "UPDATE animal SET owner_id='" . $owner . "', type='" . $type . "', photo='" . $_FILES["photo"]["name"] . "', name='" . $name . "' WHERE id=" . $id;
        } else {
            echo "Error Saat Upload Gambar";
        }
    }

    if ($conn->query($sql)) {
        header("location: animal.php");
    } else {
        die("Error deleting record: " . $conn->error);
    }
}

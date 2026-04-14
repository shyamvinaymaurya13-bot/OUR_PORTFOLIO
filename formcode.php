<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$connection = mysqli_connect("localhost", "root", "", "portfolio");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($connection, "INSERT INTO form (name, email, message) VALUES (?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error inserting data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($connection);
}

mysqli_close($connection);

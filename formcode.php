<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Invalid request method. Please submit the form from the website.';
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

$connection = mysqli_connect('localhost', 'root', '', 'portfolio');
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}

$stmt = mysqli_prepare($connection, 'INSERT INTO form (name, email, message) VALUES (?, ?, ?)');
if (!$stmt) {
    die('Error preparing statement: ' . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $message);
if (!mysqli_stmt_execute($stmt)) {
    die('Execute error: ' . mysqli_stmt_error($stmt));
}

if (mysqli_stmt_affected_rows($stmt) > 0) {
    header('Location: index.html');
    exit();
}

echo 'No rows inserted. Please check that the form values are not empty.';

mysqli_stmt_close($stmt);
mysqli_close($connection);

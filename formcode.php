<?php
$name = $_POST['name'];
$email = $_POST['email'];   
$message = $_POST['message'];

$connection = mysqli_connect("localhost", "root", "", "portfolio");
$insert_query = "INSERT INTO form (name, email, message) VALUES ('$name', '$email', '$message')";
$result = mysqli_query($connection, $insert_query);
if ($result) {
    echo "Data inserted successfully.window.location.href = 'index.html';";
} else {
    echo "Error inserting data: " . mysqli_error($connection);
}
?>
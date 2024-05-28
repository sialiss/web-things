<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "animation_studios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$country = $_POST['country'];
$founded = $_POST['founded'];
$website = $_POST['website'];

$sql = "INSERT INTO studios (name, country, founded, website) VALUES ('$name', '$country', '$founded', '$website')";

if ($conn->query($sql) === TRUE) {
    echo "Новая студия успешно добавлена";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: ../data.php");
?>
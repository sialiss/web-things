<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "animation_studios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$release_year = $_POST['release_year'];
$genre = $_POST['genre'];
$studio_id = $_POST['studio_id'];

$sql = "INSERT INTO animations (title, release_year, genre, studio_id) VALUES ('$title', '$release_year', '$genre', '$studio_id')";

if ($conn->query($sql) === TRUE) {
    echo "Новая анимация успешно добавлена";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: ../data.php");
?>

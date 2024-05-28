<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "animation_studios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Удаляем все анимации, связанные со студией
$delete_animations_sql = "DELETE FROM animations WHERE studio_id=$id";
$conn->query($delete_animations_sql);

// Удаляем студию
$sql = "DELETE FROM studios WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Студия успешно удалена";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: ../data.php");
?>

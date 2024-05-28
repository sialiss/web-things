<?php
// Получаем данные из тела запроса
$data = json_decode(file_get_contents('php://input'), true);

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "animation_studios";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из запроса
$id = $data['id'];
$title = $data['title'];
$releaseYear = $data['release_year'];
$genre = $data['genre'];
$studioId = $data['studio_id'];

// Подготавливаем и выполняем SQL-запрос
$stmt = $conn->prepare("UPDATE animations SET title=?, release_year=?, genre=?, studio_id=? WHERE id=?");
$stmt->bind_param("ssssi", $title, $releaseYear, $genre, $studioId, $id);
$stmt->execute();

// Закрываем подключение
$stmt->close();
$conn->close();

// Отправляем успешный ответ клиенту
http_response_code(200);
?>

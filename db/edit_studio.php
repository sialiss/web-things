<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "animation_studios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $country = $_POST['country'];
    $founded = $_POST['founded'];
    $website = $_POST['website'];

    $sql = "UPDATE studios SET name='$name', country='$country', founded='$founded', website='$website' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно обновлена";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: ../data.php");
    exit();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM studios WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактировать студию</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Редактировать студию</h2>
    <form action="edit_studio.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>
        <label for="country">Страна:</label>
        <input type="text" id="country" name="country" value="<?php echo $row['country']; ?>"><br>
        <label for="founded">Основана:</label>
        <input type="text" id="founded" name="founded" value="<?php echo $row['founded']; ?>"><br>
        <label for="website">Вебсайт:</label>
        <input type="text" id="website" name="website" value="<?php echo $row['website']; ?>"><br>
        <input type="submit" value="Обновить">
    </form>
</body>
</html>

<?php
$conn->close();
?>

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
    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $studio_id = $_POST['studio_id'];

    $sql = "UPDATE animations SET title='$title', release_year='$release_year', genre='$genre', studio_id='$studio_id' WHERE id=$id";

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
    $sql = "SELECT * FROM animations WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактировать анимацию</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Редактировать анимацию</h2>
    <form action="edit_animation.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="title">Название:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>"><br>
        <label for="release_year">Год выпуска:</label>
        <input type="text" id="release_year" name="release_year" value="<?php echo $row['release_year']; ?>"><br>
        <label for="genre">Жанр:</label>
        <input type="text" id="genre" name="genre" value="<?php echo $row['genre']; ?>"><br>
        <label for="studio_id">Студия:</label>
        <select id="studio_id" name="studio_id">
            <?php
            $studios_sql = "SELECT id, name FROM studios";
            $studios_result = $conn->query($studios_sql);
            while($studio_row = $studios_result->fetch_assoc()) {
                $selected = $studio_row['id'] == $row['studio_id'] ? "selected" : "";
                echo "<option value='" . $studio_row["id"] . "' $selected>" . $studio_row["name"] . "</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Обновить">
    </form>
</body>
</html>

<?php
$conn->close();
?>

<?php
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

// Получение данных из таблиц
$studios_sql = "SELECT id, name, country, founded, website FROM studios";
$animations_sql = "SELECT id, title, release_year, genre, studio_id FROM animations";

$studios_result = $conn->query($studios_sql);
$animations_result = $conn->query($animations_sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Анимационные студии</title>
    <link rel="stylesheet" type="text/css" href="data.css">
</head>
<body>
    <nav>
        <div class="menucell"><a href="index.html">Главная</a></div>
        <div class="menucell"><a href="kyoto animation.html">Kyoto Animation</a></div>
        <div class="menucell"><a href="sources.html">Источники</a></div>
        <div class="menucell"><a href="forma.htm">Анкета</a></div>
        <div class="menucell"><a class="highlighted" href="data.html">Таблицы из базы данных</a></div>
        <div class="menucell"><a href="xml.htm">xml</a></div>
    </nav>
    <h1>Список анимационных студий</h1>
    <table border="1">
        <tr>
            <th>Название</th>
            <th>Страна</th>
            <th>Основана</th>
            <th>Вебсайт</th>
            <th>Действия</th>
        </tr>
        <?php
        if ($studios_result->num_rows > 0) {
            while($row = $studios_result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["country"] . "</td>
                        <td>" . $row["founded"] . "</td>
                        <td><a href='" . $row["website"] . "'>" . $row["website"] . "</a></td>
                        <td>
                            <a href='db/edit_studio.php?id=" . $row["id"] . "'>Редактировать</a>
                            <a href='db/delete_studio.php?id=" . $row["id"] . "' onclick=\"return confirm('Вы уверены, что хотите удалить эту студию?');\">Удалить</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Нет данных</td></tr>";
        }
        ?>
    </table>

    <h1>Список анимаций</h1>
    <table border="1">
        <tr>
            <th>Название</th>
            <th>Год выпуска</th>
            <th>Жанр</th>
            <th>Студия</th>
            <th>Действия</th>
        </tr>
        <?php
        if ($animations_result->num_rows > 0) {
            while($row = $animations_result->fetch_assoc()) {
                $studio_name_sql = "SELECT name FROM studios WHERE id=" . $row["studio_id"];
                $studio_name_result = $conn->query($studio_name_sql);
                $studio_name = $studio_name_result->fetch_assoc()["name"];
                echo "<tr>
                        <td>" . $row["title"] . "</td>
                        <td>" . $row["release_year"] . "</td>
                        <td>" . $row["genre"] . "</td>
                        <td>" . $studio_name . "</td>
                        <td>
                            <a href='db/edit_animation.php?id=" . $row["id"] . "'>Редактировать</a>
                            <a href='db/delete_animation.php?id=" . $row["id"] . "' onclick=\"return confirm('Вы уверены, что хотите удалить эту анимацию?');\">Удалить</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Нет данных</td></tr>";
        }
        ?>
    </table>

    <h2>Добавить новую студию</h2>
    <form action="db/add_studio.php" method="POST">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name"><br>
        <label for="country">Страна:</label>
        <input type="text" id="country" name="country"><br>
        <label for="founded">Основана:</label>
        <input type="text" id="founded" name="founded"><br>
        <label for="website">Вебсайт:</label>
        <input type="text" id="website" name="website"><br>
        <input type="submit" value="Добавить">
    </form>

    <h2>Добавить новую анимацию</h2>
    <form action="db/add_animation.php" method="POST">
        <label for="title">Название:</label>
        <input type="text" id="title" name="title"><br>
        <label for="release_year">Год выпуска:</label>
        <input type="text" id="release_year" name="release_year"><br>
        <label for="genre">Жанр:</label>
        <input type="text" id="genre" name="genre"><br>
        <label for="studio_id">Студия:</label>
        <select id="studio_id" name="studio_id">
            <?php
            $studios_result = $conn->query($studios_sql);
            while($row = $studios_result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Добавить">
    </form>

</body>
</html>

<?php
$conn->close();
?>

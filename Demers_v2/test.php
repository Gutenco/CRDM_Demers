<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Connection Test</title>
</head>
<body>
    <h1>Database Connection Test</h1>

    <?php
    require_once 'auth.php';
    require_once 'config/db_config.php';
    // Проверка соединения


    // SQL запрос для получения данных
    $sql = "SELECT * FROM account";

    $result = $conn->query($sql);

    // Проверка и отображение результатов запроса
    if ($result->num_rows > 0) {
        // Цикл по каждой полученной строке
        while ($row = $result->fetch_assoc()) {
            $id = $row["id_user"];
            $name = $row["username"];

            // Отображение данных на сайте
            echo "<p>ID: $id, Name: $name</p>";
        }
    } else {
        echo "<p>Нет результатов</p>";
    }

    // Закрытие подключения к базе данных
    $conn->close();
    ?>

</body>
</html>

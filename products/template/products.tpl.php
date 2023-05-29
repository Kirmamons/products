<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список товаров</title>

</head>
<body>
    <h1>Список товаров</h1>

    <div class="filter-form">
        <form method="get" action="">
            <input type="text" name="filter" placeholder="Фильтр по названию">
            <input type="submit" value="Фильтровать">
            <input type="button" onclick="document.location='?action=add_product'" value="Добавить">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Название товара</th>
                <th><a href="?sort=price_asc">↑    </a>
                <a href="?sort=price_desc">↓</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Подключение к базе данных
                $host = 'localhost';
                $username = 'root';
                $password = 'Kirmamon';
                $database = 'products';

                $conn = new mysqli($host, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Ошибка подключения: " . $conn->connect_error);
                }

// Фильтрация по названию
                $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                $filter = $conn->real_escape_string($filter);
                $filter_sql = !empty($filter) ? " WHERE `Name` LIKE '%$filter%'" : '';

                // Сортировка
                $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                $sort_sql = '';
                if ($sort === 'price_asc') {
                    $sort_sql = ' ORDER BY `Price` ASC';
                } elseif ($sort === 'price_desc') {
                    $sort_sql = ' ORDER BY `Price` DESC';
                }

                // Запрос к базе данных
                $sql = "SELECT * FROM `products`$filter_sql$sort_sql";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td class='price_color'>" . $row['Price'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Нет доступных товаров</td></tr>";
            }

            $conn->close();
        ?>
    </tbody>
</table>

<script>
    // Сортировка товаров по цене
    const priceAscLink = document.querySelector('th:nth-child(2) a');
    const priceDescLink = document.querySelector('th:nth-child(3) a');

    priceAscLink.addEventListener('click', () => {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sort', 'price_asc');
        window.location.search = urlParams.toString();
    });

    priceDescLink.addEventListener('click', () => {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sort', 'price_desc');
        window.location.search = urlParams.toString();
    });
</script>
</body>
</html>
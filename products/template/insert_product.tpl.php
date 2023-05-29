
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

// Получение данных из формы
$productName = $_POST['product_name'];
$productPrice = $_POST['product_price'];

// Запрос на добавление записи
$sql = "INSERT INTO `products` (`Name`, `Price`) VALUES ('$productName', '$productPrice')";

if ($conn->query($sql) === TRUE) {
    echo "Товар успешно добавлен";
} else {
    echo "Ошибка при добавлении товара: " . $conn->error;
}

$conn->close();
?>

<input type="button" onclick="document.location='?action=main'" value="К товарам">
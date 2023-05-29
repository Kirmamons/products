<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
</head>
<body>
    <h1>Добавить товар</h1>

    <div class="add-form">
        <form method="post" action="?action=insert_product">
            <label for="product_name">Название товара:</label>
            <input type="text" name="product_name" id="product_name" required>

            <label for="product_price">Цена:</label>
            <input type="text" name="product_price" id="product_price" required>

            <input type="submit" value="Добавить товар">
            <input type="button" onclick="document.location='?action=main'" value="Назад">
        </form>
    </div>
</body>
</html>
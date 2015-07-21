<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SEARCH</title>
</head>
<body>
    <p>The greatest variety of books you can find in <?php echo $shopWithMaxBookTitles[0]['name']; ?>.<br>
       There are <?php echo $shopWithMaxBookTitles[0]['COUNT(wheretofindbooks.book_id)'] ?> different titles!</p>

    <p>The greatest amount of books you can find in <?php echo $shopWithMaxBooks[0]['name']; ?>.<br>
       There are <?php echo $shopWithMaxBooks[0]['sum']; ?> books.</p>

    <p>Average cost of book in each shop is:
        <table>
            <tr>
                <th>SHOP</th><th>Average price</th>
            </tr>
            <?php
                for ($i = 0; $i < count($average); $i++) {
                    echo '<tr><td>' . $average[$i]['name'] . '</td><td>' . $average[$i]['avg'] . '</td></tr>';
                }
            ?>
        </table>
    </p>

    <p>Amount of books in each shop:
        <table>
            <tr>
                <th>SHOP</th><th>Amount of books</th>
            </tr>
        <?php
        for ($i = 0; $i < count($amountInShop); $i++) {
            echo '<tr><td>' . $amountInShop[$i]['name'] . '</td><td>' . $amountInShop[$i]['amount'] . '</td></tr>';
        }
        ?>
        </table>
    </p>

    <p>Search where you can find your favourite book:
        <form action="../controller/controller.php" method="post">
            <input type="text" name="id">
            <input type="submit" name="search" value="SEARCH">
        </form>
        <table>
            <?php
            if (isset($where) && !empty($where)) {
                echo 'You can find book ' . $_POST['id'] . ' in: ';
                echo '<tr><th>SHOP</th><th>Price</th></tr>';
                for ($i = 0; $i < count($where); $i++) {
                    echo '<tr><td>' . $where[$i]['name'] . '</td><td>' . $where[$i]['price'] . '</td></tr>';
                }
            }
            ?>
        </table>
    </p>
</body>
</html>

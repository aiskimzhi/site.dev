<?php

include 'bookClass.php';

$new = new Book();

/*
 * считаем колисчество наименований в каждом магазине
$query = "SELECT shops.name, COUNT(wheretofindbooks.book_id)
            FROM shops, wheretofindbooks
            WHERE (wheretofindbooks.shop_id = shops.id AND wheretofindbooks.amount > 0)
            GROUP BY shops.id";
echo $query;

$prepare = $new->prepare($query);
$prepare->execute();
$select = $prepare->fetchAll();
*/

$select = $new->getShopWithMaxBookTitles();


echo '<pre>';
print_r($select);
echo '</pre>';


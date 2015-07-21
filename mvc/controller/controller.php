<?php

include '../model/model.php';

$book = new Model();

$shopWithMaxBookTitles = $book->getShopWithMaxBookTitles();

$shopWithMaxBooks = $book->getShopWithMaxBooks();

$average = $book->getAveragePricesByShop();

$amountInShop = $book->getTotalBooksInShop();

if (isset($_POST['search'])) {
    $where = $book->getShopsByBookId($_POST['id']);
}

if (!isset($where) || empty($where)) {
    $no = 'Unfortunately there is no such book in any shop :-(';
}

include '../view/view.php';


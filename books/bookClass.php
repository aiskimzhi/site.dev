<?php

class Book extends PDO
{
    public function __construct()
    {
        $user = 'root';
        $password = '';
        $dsn = "mysql:host=localhost;dbname=bookshops;charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        parent::__construct($dsn, $user, $password, $opt);
    }

    public function getShopWithMaxBooks()
    {
        $query = "SELECT s.*, SUM(w.amount) as sum
                  FROM wheretofindbooks w JOIN shops s ON s.id = w.shop_id
                  GROUP BY w.shop_id
                  ORDER BY sum DESC
                  LIMIT 1";

        $prepare = $this->prepare($query);
        $prepare->execute();
        $select = $prepare->fetchAll();
        return $select;
    }

    public function getAveragePricesByShop()
    {
        $query = "SELECT shops.name, AVG(wheretofindbooks.price)
                  FROM shops, wheretofindbooks
                  WHERE (wheretofindbooks.shop_id = shops.id)
                  GROUP BY shops.id";

        $prepare = $this->prepare($query);
        $prepare->execute();
        $select = $prepare->fetchAll();
        return $select;
    }

    public function getTotalBooksInShop()
    {
        $query = "SELECT shops.name, SUM(wheretofindbooks.amount)
                  FROM shops, wheretofindbooks
                  WHERE (wheretofindbooks.shop_id = shops.id)
                  GROUP BY shops.id";

        $prepare = $this->prepare($query);
        $prepare->execute();
        $select = $prepare->fetchAll();
        return $select;
    }

    public function getShopsByBookId($id)
    {
        $query = "SELECT shops.name, wheretofindbooks.price
                  FROM shops, wheretofindbooks
                  WHERE (wheretofindbooks.shop_id = shops.id AND wheretofindbooks.book_id = :id
                  AND wheretofindbooks.amount > 0)
                  GROUP BY shops.id";

        $prepare = $this->prepare($query);
        $prepare->execute(array('id' => $id));
        $select = $prepare->fetchAll();
        return $select;
    }

    public function getShopWithMaxBookTitles()
    {
        $query = "SELECT shops.name, COUNT(wheretofindbooks.book_id)
                  FROM shops, wheretofindbooks
                  WHERE (wheretofindbooks.shop_id = shops.id AND wheretofindbooks.amount > 0)
                  GROUP BY shops.id
                  ORDER BY COUNT(wheretofindbooks.book_id) DESC
                  LIMIT 1";

        $prepare = $this->prepare($query);
        $prepare->execute();
        $select = $prepare->fetchAll();
        return $select;
    }

}

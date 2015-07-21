<?php
/**
 * Contain class Chat for operating with queries.
 */

require_once 'db-abstract-class.php';

class Advert extends DB_Abstract
{

    static $dateFormat = '%H:%i:%s  %d %M, %Y';

    /**
     * Insert advert.
     * @param string $email
     * @param string $city
     * @param string $title
     * @param string $text
     */
    public function insert ($email, $city, $title, $text)
    {
        $added = time();
        $sql = 'INSERT INTO content (email, city, title, text, added)
                      VALUES (%%email%%, %%city%%, %%title%%, %%text%%, %%added%%)';
        $this->execute($sql, array('email' => $email,
                                   'city' => $city,
                                   'title' => $title,
                                   'text' => $text,
                                   'added' => $added));
    }

    /**
     * Update advert.
     * @param int    $id
     * @param string $email
     * @param string $city
     * @param string $title
     * @param string $text
     */
    public function update ($id, $email, $city, $title, $text)
    {
        $sql = 'UPDATE content
                    SET email = %%email%%,
                        city = %%city%%,
                        title = %%title%%,
                        text = %%text%%
                    WHERE id = %%id%%';
        $this->execute($sql, array('email' => $email,
                                   'city' => $city,
                                   'title' => $title,
                                   'text' => $text,
                                   'id' => $id));
    }

    /**
     * Select adverts by city.
     * @param string $cityFilter
     * @return array
     */
    public function selectByCity ($cityFilter)
    {
        $sql = 'SELECT *, DATE_FORMAT(FROM_UNIXTIME(added), %%dateFormat%%) AS added
                  FROM content
                  WHERE city = %%cityFilter%%
                  ORDER BY id DESC';
        return $this->getArrayFromSQL($sql, array('cityFilter' => $cityFilter, 'dateFormat' => self::$dateFormat));
    }

    /**
     * Select all adverts from table.
     * @return array
     */
    public function selectAll ()
    {
        $sql = 'SELECT *, DATE_FORMAT(FROM_UNIXTIME(added), %%dateFormat%%) AS added
                  FROM content
                  ORDER BY id DESC';
        return $this->getArrayFromSQL($sql, array('dateFormat' => self::$dateFormat));
    }

    /**
     * Get cities array from database.
     * @return array
     */
    public function getCities ()
    {
        $sql = 'SELECT DISTINCT city FROM content ORDER BY city';
        return $this->getArrayFromSQL($sql);
    }

    /**
     *
     * Delete chosen advert from table.
     * @param int $id
     */
    public function delete ($id)
    {
    	$sql = 'DELETE FROM content WHERE id = %%id%%';
    	$this->execute($sql, array('id' => $id));
    }


}

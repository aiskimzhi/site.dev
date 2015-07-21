<?php
/**
 *  Contain class DB_Abstract for database connection and debugging MySQL queries and errors.
 */

require_once ROOT . '/applications/config/db.php';

define('DEBUG', FALSE);

abstract class DB_Abstract extends DB_connect
{
	protected $conn;
	protected $queries = array();
	protected $errors = array();

    /**
     * Creating database connection. Getting errors and queries.
     */
	public function __construct()
	{

		if (DEBUG && isset($_SESSION['queries'])) {
			$this->queries = $_SESSION['queries'];
			unset($_SESSION['queries']);
		}
		if (DEBUG && isset($_SESSION['errors'])) {
			$this->errors = $_SESSION['errors'];
			unset($_SESSION['errors']);
		}

		$this->conn = mysql_pconnect(
		parent::$db_host,
		parent::$db_user,
		parent::$db_pass
		);

		mysql_set_charset('utf8', $this->conn);
		mysql_select_db(parent::$db_name, $this->conn);

	}

    /**
     * Closing database connection and displaying errors and queries.
     */
	public function __destruct()
	{
		mysql_close($this->conn);
		if (DEBUG){
			echo '<br/>';
			foreach ($this->queries as $query) {
				echo $query . '<br/>';
			}
			foreach ($this->errors as $error) {
				echo $error . '<br/>';
			}
		}
	}

    /**
     * Execution of queries and screening sql query.
     * @param string $query
     * @param array $data
     * @return resource (result of sql query)
     */
	public function execute ($query, $data = array())
	{
		foreach ($data as $key => $value) {
			$query = str_replace('%%' . $key . '%%', '\'' . trim(mysql_real_escape_string($value)) . '\'', $query);
		}
		if (DEBUG) {
			$this->queries[] = $query;
		}
		$result = mysql_query ($query, $this->conn);
		if (DEBUG && ($error = mysql_error($this->conn))) {
			$this->errors[] = $error;
		}
		return $result;
	}

	/**
     * Acess to queries.
     * @return string
     */
	public function queries()
	{
		return $this->queries;
	}

    /**
     * Acess to errors.
     * @return string
     */
	public function errors()
	{
		return $this->errors;
	}

	/**
	 * Function create array from sql query SELECT.
	 * @param resource (result of sql query)
	 * @return array
	 */
	public function selectFromDB ($select)
	{
		$arr = array();
		$num_rows = mysql_num_rows($select);
		if ($num_rows > 0) {
			while($row = mysql_fetch_assoc($select)) {
				$arr[] = $row;
			}
		}
		return $arr;
	}

    /**
     * Function create array from SQL-query string.
     *
     * @param string $query
     * @param array $data
     * @return array
     */
	public function getArrayFromSQL ($query, $data = array())
	{
		$res = $this->execute($query, $data);
        return $this->selectFromDB($res);
	}

}

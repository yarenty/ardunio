<?php

class db
{
    // performance - no need to read file on each page request
    //  private $iniFile = "local.ini";

    var $prefix = "iot_";

    var $connection = null;

    function __construct()
    {
        $server = "127.0.0.1";
        $database = "iot";
        $user = "dbuser";
        $pass = "DBpassword";
        $this->connection = new mysqli($server, $user, $pass, $database);
    }

    /**
     * Insert single row - returns inserted ID.
     * @param $sql
     * @return mixed|null
     */
    function insertRow($sql)
    {
        $result = $this->connection->query($sql);
        if ($result != false) {
            $id = $this->connection->insert_id;
            //mysqli_free_result($result);
            return $id;
        }
        return null;
    }

    /**
     * Update.
     * @param $sql
     * @return int|null
     */
    function update($sql)
    {
        $result = $this->connection->query($sql);
        if ($result != false) {
            return $this->connection->affected_rows;
        }
        return null;
    }

    /**
     * REturns single row.
     * @param $sql
     * @return mixed|null
     */
    function getRow($sql)
    {

        $result = $this->connection->query($sql);
        if ($result != false) {
            $out = $result->fetch_row();
            mysqli_free_result($result);
            return $out;
        }
        return null;
    }

    /**
     * Returns 2-dimensional array of data (array[0][0]).
     * @param $sql
     * @return null
     */
    function getRowSet($sql)
    {
        $result = $this->connection->query($sql);
        if ($result != false) {
            $i = 0;
            while ($out[$i++] = $result->fetch_array(MYSQLI_BOTH)) {
            }
            mysqli_free_result($result);
            return $out;
        }
        return null;
    }

    /**
     * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
     * @link http://php.net/manual/en/mysqli.real-escape-string.php
     * @param $in
     * @return string
     */
    function escape($in)
    {
        return mysqli_real_escape_string($this->connection, $in);
    }
}

?>
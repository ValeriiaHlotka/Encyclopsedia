<?php


class Database
{
    protected mysqli|false $connection;

    public function __construct()
    {
        $con = mysqli_init();
        mysqli_ssl_set($con,NULL,NULL, "/var/www/html/DigiCertGlobalRootG2.crt.pem", NULL, NULL);
        mysqli_real_connect($con, "encyclopsedia.mysql.database.azure.com", "encycl0ps3d1a", "passw0rdL3ra", "encyclopsedia", 3306, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
        if (mysqli_connect_errno()) {
            die('Failed to connect to MySQL: '.mysqli_connect_errno().", - ".mysqli_connect_error());
        }
        $this->connection = $con;
    }

    function getConection(): bool|mysqli
    {
        return $this->connection;
    }

    function getTableColumns($table): bool|array
    {
        $columns = [];
        $result = $this->connection->query('SELECT column_name
            FROM information_schema.columns
            WHERE table_name=' . "'" . $table . "'");
        if (!is_bool($result)) {
            while ($row = $result->fetch_row()) {
                foreach ($row as $r) {
                    if ($r !== 'ID')
                        $columns[] = $r;
                }
            }
            if (!empty($columns)) {
                return ($columns);
            }
        }
        return false;
    }

    function PrepareColumns($columns): string
    {
        $result = '';
        if (is_array($columns)) {
            foreach ($columns as $column) {
                $result .= '`' . $column . '`,';
            }
            return substr($result, 0, strlen($result) - 1);
        }
        return '`' . $columns . '`';
    }

    function PrepareValues($values): string
    {
        $result = '';
        foreach ($values as $value) {
            if ($value === 'now()')
                $result .= $value . ",";
            else
                $result .= "'" . $value . "',";
        }
        return substr($result, 0, strlen($result) - 1);
    }

    function Insert($table, $values, $columns = null): mysqli_result|bool
    {
        if ($columns === null)
            $columns = $this->getTableColumns($table);
        if (count($columns) === count($values)) {
            $query = 'INSERT INTO ' . $table . ' (' . $this->PrepareColumns($columns) . ') VALUES (' . $this->PrepareValues($values) . ')';
            if (strlen($query)) {
                $result = $this->connection->query($query);
                return $result;
            }
            return false;
        }
        return false;
    }

    function Select($table, $columns = '*', $limit = null, $where = null, $sortColumn = null, $sortOrder = null, $groupBy = null) {
        $res = [];
        $query = 'SELECT ' . ($columns === '*' ? $columns : $this->PrepareColumns($columns)) . ' FROM ' . $table;
        if ($where !== null)
            $query .= ' WHERE ' . $where;
        if ($groupBy !== null)
            $query .= ' GROUP BY ' . $groupBy;
        if ($sortColumn !== null && $sortOrder !== null)
            $query .= ' ORDER BY ' . $this->PrepareColumns($sortColumn) . strtoupper($sortOrder);
        if ($limit !== null)
            $query .= ' LIMIT ' . $limit;
        if (strlen($query)) {
            $result = $this->connection->query($query);
            if (!is_bool($result)) {
                while ($row = $result->fetch_all()) {
                    $res[] = $row;
                }
            }
        }
        if (is_array($res) && !empty($res))
            if ($limit === 1)
                return($res[0][0]);
            else return($res[0]);
        else return false;
    }

    function Delete($table, $where) {
        $query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
        if (strlen($query))
            $result = $this->connection->query($query);
        return $result;
    }

    function Update($table, $values, $where, $columns = null) {
        $values = explode(',', $values);
        $query = 'UPDATE ' . $table . ' SET ';
        $braces = '`';
        if($columns === null) {
            $braces = '';
            $columns = $this->PrepareColumns($this->getTableColumns($table));
            $columns = explode(',', $columns);
        }
        if (count($columns) === count($values)) {
            for ($i = 0; $i < count($columns); $i++) {
                if ($values[$i] === 'now()' || strpos($values[$i], 'Account'))
                    $query .= $braces.$columns[$i].$braces."=" . $values[$i] . ",";
                else
                    $query .= $braces.$columns[$i].$braces."='" . $values[$i] . "',";
            }
        }
        $query = substr($query, 0, strlen($query) - 1);
        $query .= ' WHERE ' . $where;
        if (strlen($query))
            $result = $this->connection->query($query);
        return $result;
    }

    function Query($query) {
        $res = [];
        if (strlen($query)) {
            $result = $this->connection->query($query);

            if (!is_bool($result)) {
                while ($row = $result->fetch_all()) {
                    $res[] = $row;
                }
            } else return $result;
        }
        if (is_array($res) && !empty($res))
            if (str_contains($query, 'LIMIT 1'))
                return($res[0][0]);
            else return($res);
        else return false;

    }
}
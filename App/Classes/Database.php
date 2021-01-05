<?php

/**
 *
 * @class Database
 * @created 16.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Database
{
    private static $_instance = null;
    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;
    protected $dbName;
    protected $dbUser;
    protected $dbPwd;
    protected $dbHost;

    private function __construct()
    {
        $this->dbHost = Config::GET('mysql/host');
        $this->dbName = Config::GET('mysql/db');
        $this->dbUser = Config::GET('mysql/user');
        $this->dbPwd = Config::GET('mysql/password');
        try {
            $this->_pdo = new PDO("mysql:host=localhost;dbname=" . $this->dbName, $this->dbUser, $this->dbPwd, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ));
            //$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("<strong>Error:<br /></strong><div class=\"alert alert-danger\">" . $e->getMessage() . "</div>Please check your database connection settings.");
        }

    }


    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Database();
        }

        return self::$_instance;

    }


    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                print_r($this->_pdo->errorInfo());
                $this->_error = true;
            }


        }

        return $this;

    }

    public function createQuery($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_count = $this->_query->rowCount();
            } else {
                print_r($this->_pdo->errorInfo());
                $this->_error = true;
            }


        }

        return $this;

    }

    public function action($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=', '<>');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function deleteAction($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=', '<>');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if (!$this->createQuery($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function getWhereX($table, $value)
    {
        $sql = "SELECT * FROM {$table} WHERE {$value}";

        if (!$this->query($sql)->error()) {
            return $this;
        }
        return false;
    }

    public function onlineMembers($table, $value)
    {
        $sql = "SELECT DISTINCT session_id FROM {$table} WHERE {$value}";

        if (!$this->query($sql)->error()) {
            return $this;
        }
        return false;
    }

    public function delete($table, $where)
    {
        return $this->deleteAction('DELETE', $table, $where);
    }

    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach ($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }


        $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";

        if (!$this->createQuery($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";

            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if (!$this->createQuery($sql, $fields)->error()) {
            return true;
        }

        return false;
    }


    public function lastid()
    {
        return $this->_pdo->lastInsertId();
    }

    public function orderBy($table, $order, $limit)
    {
        $sql = "SELECT * FROM {$table} ORDER BY {$order} DESC LIMIT {$limit}";

        if (!$this->query($sql)->error()) {
            return $this;
        }
        return false;
    }

    public function orderAll($table, $order, $sort)
    {

        if (isset($sort)) {
            $sql = "SELECT * FROM {$table} ORDER BY {$order} {$sort}";
        } else {
            $sql = "SELECT * FROM {$table} ORDER BY {$order}";
        }

        if (!$this->query($sql)->error()) {
            return $this;
        }
        return false;
    }

    public function orderWhere($table, $where, $order, $sort)
    {

        if (isset($sort)) {
            $sql = "SELECT * FROM {$table} WHERE {$where} ORDER BY {$order} {$sort}";
        } else {
            $sql = "SELECT * FROM {$table} WHERE {$where} ORDER BY {$order}";
        }

        if (!$this->query($sql)->error()) {
            return $this;
        }
        return false;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        $results = $this->results();
        return $results[0];
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }

    public function getCount($id, $table, $sql)
    {
        $sql = "SELECT count({$id}) as total FROM {$table} {$sql}";

        if (!$this->query($sql)->error()) {
            return $this;
        }
        return false;
    }
}
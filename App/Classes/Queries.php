<?php

/**
 *
 * @class Queries
 * @created 16.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Queries
{
    private static $_instance = null;
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public static function dbp()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Queries ();
        }

        return self::$_instance;

    }

    public function getWhereX($table, $value)
    {
        $data = $this->_db->getWhereX($table, $value);
        return $data->results();
    }

    public function getWhere($table, $where)
    {
        $data = $this->_db->get($table, $where);
        return $data->results();
    }

    public function onlineMembers($table, $where)
    {
        $data = $this->_db->onlineMembers($table, $where);
        return $data->results();
    }

    public function getCount($id, $table, $sql)
    {
        $data = $this->_db->getCount($id, $table, $sql);
        return $data->results();
    }


    public function getAll($table, $where = array())
    {
        $data = $this->_db->get($table, $where);
        return $data->results();
    }

    public function orderAll($table, $order, $sort = null)
    {
        $data = $this->_db->orderAll($table, $order, $sort);
        return $data->results();
    }

    public function orderBy($table, $order, $limit)
    {
        $data = $this->_db->orderBy($table, $order, $limit);
        return $data->results();
    }

    public function orderWhere($table, $where, $order, $sort = null)
    {
        $data = $this->_db->orderWhere($table, $where, $order, $sort);
        return $data->results();
    }


    public function update($table, $id, $fields = array())
    {
        if (!$this->_db->update($table, $id, $fields)) {
            throw new Exception('There was a problem performing that action.');
        }
    }

    public function create($table, $fields = array())
    {
        if (!$this->_db->insert($table, $fields)) {
            throw new Exception('There was a problem performing that action.');
        }
    }

    public function delete($table, $where)
    {
        if (!$this->_db->delete($table, $where)) {
            throw new Exception('There was a problem performing that action.');
        }
    }

    public function getLastId()
    {
        return $this->_db->lastid();
    }
}
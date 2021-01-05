<?php

/**
 *
 * @class Role
 * @created 5.1.2021 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Role
{

    protected $db;

    /**
     * Servers constructor.
     */
    public function __construct()
    {
        $this->db = new Queries();
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->db->orderAll(Config::GET('prefixs/project') . '_users', 'id', 'DESC');
    }

    /**
     * @throws Exception
     */
    public function giveRole()
    {

        if (isset($_POST['role'])) {

            $this->db->update(Config::get('prefixs/project') . "_users", htmlspecialchars($_POST['user']), [
                'role' => 'Admin'
            ]);
            Redirect::msg("/admin/index", "success", "Успешно е добавена ролята към потребителя");
        }
    }

    /**
     * @throws Exception
     */
    public function removeRole()
    {
        if (isset($_POST['removerole'])) {

            $this->db->update(Config::get('prefixs/project') . "_users", htmlspecialchars($_POST['user']), [
                'role' => 'Member'
            ]);
            Redirect::msg("/admin/index", "success", "Успешно е премахната ролята от потребителя");
        }
    }

}
<?php

/**
 *
 * @class User
 * @created 31.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class User
{
    protected $db;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = new Queries();
    }

    public function settingsAction()
    {
        if (isset($_GET['action'])) {
            switch (htmlspecialchars($_GET['action'])) {
                case "edit":
                    return $this->EditServer();
                case "delete":
                    $this->RemoveServer();
                    break;
            }
        } else {
            return $this->getUserServers();
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function EditServer()
    {
        $id = htmlspecialchars($_GET['id']);
        if (isset($_POST['editServer'])) {

            if (empty($_POST['newip'])) {
                Redirect::msg("/settings/?action=edit&id=" . $id, "danger", "IP:Port е задължително поле.");
                die();
            } elseif (Servers::checkPort(htmlspecialchars($_POST['newip'])) === false) {
                Redirect::MSG('/settings/?action=edit&id=' . $id, 'danger', 'Сървърът трябва задължително да има порт.');
            } elseif (empty($_POST['newwebiste'])) {
                $website = "Няма добавен";
            } else {
                $website = $_POST['newwebiste'];
            }
            $this->db->update(Config::get('prefixs/project') . "_servers", $id, array(
                'ip' => htmlspecialchars($_POST['newip']),
                'website' => $website,
            ));
            Redirect::msg("/settings/", "primary", "Сървъра е променена успешно.");
            die();
        }

        if (!is_numeric($_GET['id'])) {
            Redirect::msg("/settings/", "primary", "Нещо се обърка, моля опитайте отново.");
            die();
        }

        $edit = $this->db->getWhere(Config::get('prefixs/project') . "_servers", ['id', '=', $id]);
        return [
            'ip' => $edit[0]->ip,
            'website' => $edit[0]->website,
        ];
    }

    /**
     * @throws Exception
     */
    public function RemoveServer()
    {
        if (isset($_GET['action'])) {

            if (empty($_GET['id'])) {
                Redirect::msg("/settings/", "primary", "Нещо се обърка при опита за премахване, моля опитай отново.");
            }
            if (!is_numeric($_GET['id'])) {
                Redirect::msg("/settings/", "primary", "Нещо се обърка при опита за премахване, моля опитай отново.");
            }

            $id = htmlspecialchars($_GET['id']);
            $this->db->delete(Config::get('prefixs/project') . "_servers", ['id', '=', $id]);
            Redirect::msg("/settings/", "success", "Сървъра е успешно премахнат от системата");
            die();
        }
    }

    /**
     *
     */
    public function UserLogin()
    {

        if (isset($_POST['UserLogin'])) {

            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);

            $login = $this->db->getWhere(Config::GET('prefixs/project') . '_users', ['username', '=', $username]);
            if (password_verify($password, $login[0]->password) && $login[0]->username == $username) {

                Session::put("acc", $login[0]->username);
                if ('Admin' == $login[0]->role) {
                    Session::put("admin", "1");
                } else {
                    Session::put("admin", "0");
                }
                Redirect::MSG("/", "success", "Успешно влязохте в акаунта си.");
            } else {
                Redirect::MSG('/', 'danger', 'Грешна парола или потребителско име');
            }

        }

    }

    /**
     * @throws Exception
     */
    public function RegSubmit()
    {
        if (isset($_POST['RegSubmit'])) {

            if (empty($_POST['username'])) {
                Redirect::MSG("/register", "danger", "Моля, въведете потребителското си име.");
            } elseif ($_POST['password'] != $_POST['pass']) {
                Redirect::MSG("/register", "danger", "Паролите не съвпадат.");
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                Redirect::MSG("/register", "danger", "E-Mail адреса не е валиден.");
            } elseif (!preg_match('/\w{6,}/', $_POST['password'])) {
                Redirect::MSG("/register", "danger", "Паролата трябва да бъде поне 6 символа.");
            } elseif ($this->db->getWhere(Config::get('prefixs/project') . '_users', ['Email', '=', $_POST['email']])) {
                Redirect::MSG("/register", "danger", "E-mail-а, които сте посочили вече се използва от друг потребител.");
            } else {

                $this->db->create(Config::get('prefixs/project') . "_users", [
                    "regdate" => time(),
                    "username" => htmlspecialchars($_POST['username']),
                    "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    "email" => htmlspecialchars($_POST['email']),
                    "role" => 'Member'
                ]);

                Redirect::msg("/register", "success", "Успешно се регистрирахте в сайта. Може да влезнете в акаунта си.");
            }

        }
    }

    /**
     * @return mixed
     */
    public function getUserInfo()
    {
        if (@$_SESSION['acc'] == TRUE) {
            return $this->db->getWhere(Config::get('prefixs/project') . '_users', ['username', '=', $_SESSION['acc']])[0];
        }

    }

    /**
     * @return mixed
     */
    public function getUserServers()
    {
        if (@$_SESSION['acc'] == TRUE) {
            return $this->db->getWhere(Config::get('prefixs/project') . '_servers', ['addedby', '=', $_SESSION['acc']]);

        }
    }

    /**
     * @param $email
     * @param int $s
     * @param string $d
     * @param string $r
     * @param false $img
     * @param array $atts
     * @return string
     */
    public
    static function get_gravatar($email, $s = 150, $d = 'mm', $r = 'pg', $img = false, $atts = array()): string
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&amp;d=$d&amp;r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}
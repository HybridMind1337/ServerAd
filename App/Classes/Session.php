<?php

/**
 *
 * @class Session
 * @created 16.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Session
{
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name)
    {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name);
        }
    }

    public static function showMessage()
    {
        if (self::exists('alert')) {
            $alert = $_SESSION['alert']['alert'];
            $message = $_SESSION['alert']['message'];
            echo "<div class=\"alert alert-$alert mt-1 mb-1\">";
            echo "<p class=\"card-text text-center\"> $message </p>";
            echo '</div>';
        }

    }
}
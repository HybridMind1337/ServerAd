<?php

/**
 *
 * @class Redirect
 * @created 16.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Redirect
{
    /**
     * @param null $location
     */
    public static function TO($location = null)
    {
        if ($location) {
            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include '404.php';
                        exit();
                        break;
                }
            }
            header('Location: ' . $location);
            exit();
        }
    }

    /**
     * @param null $location
     * @param $alert
     * @param $message
     */
    public static function MSG($location = null, $alert, $message)
    {

        $_SESSION['alert'] = array(
            'status' => true,
            'message' => $message,
            'alert' => $alert,
        );

        header('Location: ' . $location);
        exit();

    }
}
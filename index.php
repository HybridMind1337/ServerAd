<?php
/*
 *
 *  Project Name: Games Servers Monitoring (GamesSM)
 *  Author: HybridMind <www.webocean.info>
 *  Version: 0.0.1
 *  License:  GPL-3.0
 *  Discord: HybridMind#6095
 *
 */

session_start();

require_once __DIR__ . "/includes/Config.php";
require_once __DIR__ . "/App/init.php";
require_once __DIR__ . "/vendor/autoload.php";

$URL = explode("/", htmlspecialchars($_SERVER['QUERY_STRING']));


if (!$URL[0]) {
    Redirect::TO('/home/');
    die();
} else {
    if ($URL[0] == "admin") {
        if ($_SESSION['admin']) {
            if (file_exists("App/Admin/" . $URL[1] . ".php")) {
                require_once("App/Admin/" . $URL[1] . ".php");
            } else {
                echo "Страницата не е намерена";
            }
        } else {
            Redirect::TO("/home/");
        }
    } else {
        if (file_exists("App/Pages/" . $URL[0] . ".php")) {
            require_once("App/Pages/" . $URL[0] . ".php");
        } else {
            echo "Страницата не е намерена";
        }
    }
}

Session::delete('alert');
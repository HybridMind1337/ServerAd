<?php

spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $path = "Classes/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;
    if (file_exists('App/' . $fullPath)) {
        require_once($fullPath);
    }

}

require_once ("./vendor/autoload.php");

$UserLogin = (new User())->UserLogin();
$userinfo = (new User())->getUserInfo();

$getVIPServ = (new Servers())->getVIPServers();

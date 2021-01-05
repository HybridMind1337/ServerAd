<?php
$GLOBALS['project'] = [

    "mysql" => [
        'host' => 'localhost', // Хост, подразбиране е localhost
        'db' => 'gamemon', // Потребителско име
        'user' => 'gamemon', // Базаданни
        'password' => 'gamemon', // Парола
    ],

    "prefixs" => [
        'project' => 'gamessm' // Префикс на базата данни, подразбиране е gamessm
    ],

    "boost" => [
        "price" => "2.40лв", // Цена на услугата
        "nomer" => "1092",
        "text" => "smsvip", // Текст на съобщението
        "smsID" => 24796 // ServID-то от мобио за услугата
    ],

    "settings" => [
        "siteName" => "ServerAD", // Името на сайта/проекта
        "baseURL" => "http://localhost", // Линк на сайта без / накрая
    ]

];

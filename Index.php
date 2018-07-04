<?php 
//подключение файла класса БД
include_once 'config/DataBase.php';
//подключение файла класса  модели
include_once 'models/ModelPrice.php';
//подключение файла класса контроллера 
include 'controllers/MainController.php';

//подключение к БД
$db = new DataBase('localhost', 'root', '', 'pricelist');

//Передача управления контроллеру
$controller = new MainController($db);
$controller->Request();


<?php
session_start();
// Конфигурация приложения
require_once 'config.php';

// Загрузка ядра
require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/Router.php';


// Маршрутизация
$Router = new Router();
$Router->render();


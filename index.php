<?php

require 'DB.php';

//Array of links
class Link {
    public $href;   //Адрес
    public $text;   //Текст ссылки
    
    function __construct($href, $text) {
        $this->href = $href;
        $this->text = $text;
    }
}

$pageLinks = [ 
    new Link('index.php', 'Главная'), 
    new Link('index.php?p=about', 'О странице')
];

$pageName='index';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['p'])) {
    $pageName = filter_var($_GET['p'], FILTER_SANITIZE_STRING);
}

$db = new DB();

$page = $db->loadPage($pageName);
if (empty($page)) {
    header("Location: index.php"); //Если запрошеная страница не найдена в базе - редирект на главную
}

include 'template.html';

?>
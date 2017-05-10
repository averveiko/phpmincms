<?php

//TODO add auth

require 'DB.php';

$db = new DB();

$arrPages = $db->listOfPages();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['edit'])) {
    $editPage = filter_var($_GET['edit'], FILTER_SANITIZE_STRING);
    $page = $db->loadPage($editPage);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldName = filter_var($_POST['oldName'], FILTER_SANITIZE_STRING);
    $newName = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $newTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $newContent = $_POST['content'];
    
    $db->updatePage($oldName, $newName, $newTitle, $newContent);
}

include 'templateadm.html'

?>
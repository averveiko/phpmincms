<?php

//TODO add auth

require 'DB.php';

$db = new DB();

$arrPages = $db->listOfPages();

include 'templateadm.html'

?>
<?php

//TODO add auth

require 'DB.php';

$db = new DB();

$arrPages = $db->listOfPages();

print_r($arrPages);

include 'templateadm.html'

?>
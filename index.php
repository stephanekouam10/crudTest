<?php
	session_unset();
	require_once  'controller/contactsController.php';		
    $controller = new contactsController();	
    $controller->mvcHandler();
?>
<?php
	
	try 
	{
	  
		$con = new PDO('mysql:host=localhost:3307;
					   dbname=sistema', 
					   'root', 
					   'usbw');
					  
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch(PDOException $e) 
	{
		echo 'ERROR: ' . $e->getMessage();
	}
?>
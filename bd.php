<?php
	$dsn = "mysql:host=localhost;dbname=cursodb";
	$usuario = "root";
	$senha = "";
	$opcoes = array(PDO::ATTR_PERSISTENT => true,
	                PDO::ATTR_CASE => PDO::CASE_LOWER
	);
	$con = new PDO($dsn, $usuario, $senha, $opcoes);
	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>
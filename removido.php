<html>
<head>
	<title>Registro incluído</title>
</head>
<body>
<?php 
	$dsn = "mysql:host=localhost;dbname=cursodb";
	$usuario = "root";
	$senha = "";
	$opcoes = array(PDO::ATTR_PERSISTENT => true,
	                PDO::ATTR_CASE => PDO::CASE_LOWER
	);
	
	try {
		$con = new PDO($dsn, $usuario, $senha, $opcoes);
		$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		if(isset($_GET["id"])){		
			$con->beginTransaction();
			$stmt = $con->prepare("DELETE FROM aluno WHERE id_aluno = :id_aluno"); 
			$stmt->bindValue(':id_aluno',$_GET["id"]);			  
			$success=$stmt->execute();
			$con->commit();
		}
		if($success){
			echo '<script>alert("Aluno excluído com sucesso.");</script>';				
		} else {
			echo '<h1>Não foi possível excluir o aluno</h1>';
		} 			
		echo '<br/><a href="adicionado.php?voltar=true">Voltar</a>';	
	} catch(PDOException $e){
		echo '<table border="1"/>';
		echo '<tr>';
		echo '<th align="center"><b>Erro: ' . $e->getMessage(). '</b></th>';
		echo '</tr>';
		echo '</table>';
	}
?>
</body>
</html>
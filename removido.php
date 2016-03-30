<html>
<head>
	<title>Excluir registro</title>
</head>
<body>
<?php 
	include("bd.php");
	
	try {
		if(isset($_GET["id"])){		
			$con->beginTransaction();
			$stmt = $con->prepare("DELETE FROM aluno WHERE id_aluno = :id_aluno"); 
			$stmt->bindValue(':id_aluno',$_GET["id"]);			  
			$success=$stmt->execute();
			$con->commit();
			$con = null;
		}
		if($success){
			header('Location: index.php');				
		} else {
			echo '<h1>Não foi possível excluir o aluno</h1>';
		}			
	} catch(PDOException $e){
		echo '<table border="1"/>';
		echo '<tr>';
		if($e->getCode() == 23000){
			echo '<th align="center"><b>Este registro não pode ser removido pois está relacionado a um curso.</b></th>';
		} else {			
			echo '<th align="center"><b>Erro: ' . $e->getMessage(). '</b></th>';
		}
		echo '</tr>';
		echo '</table>';
	}
	echo '<br/><a href="index.php">Início</a>';
?>
</body>
</html>
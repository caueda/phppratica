<html>
<head>
	<title>Registro incluído</title>
</head>
<body>
<?php 
	include("bd.php");
	
	try {
		if(isset($_POST["nome"])){		
			$stmt = $con->prepare("INSERT INTO aluno(nome, matricula, idade) VALUES(:nome, :matricula, :idade)"); 
			$stmt->bindValue(':nome',$_POST["nome"]); 
			$stmt->bindValue(':matricula',$_POST["matricula"]);
			$stmt->bindValue(':idade',$_POST["idade"]);  
			$success=$stmt->execute();
			$con = null;
		}
		if($success){
			header('Location: index.php');
		}
	} catch(PDOException $e){
		echo '<table border="1"/>';
		echo '<tr>';		
		echo '<th align="center"><b>Erro: ' . $e->getMessage(). '</b></th>';
		echo '</tr>';
		echo '</table>';		
		echo '<br><a href="index.php>Início</a>"';
	}
?>
</body>
</html>
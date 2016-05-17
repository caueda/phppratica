<html>
<head>
	<title>Registro incluído</title>
</head>
<body>
<?php 
	include("bd.php");
	
	try {
		if(isset($_POST["nome"])){		
			$stmt = $con->prepare("INSERT INTO aluno(nome, matricula, idade, id_departamento) VALUES(:nome, :matricula, :idade, :iddepartamento)"); 
			$stmt->bindValue(':nome',$_POST["nome"]); 
			$stmt->bindValue(':matricula',$_POST["matricula"]);
			$stmt->bindValue(':idade',$_POST["idade"]);  
			if(!isset($_POST["departamento"]) || $_POST["departamento"]=='-1'){
				$stmt->bindValue(':iddepartamento', null);
			} else {
				$stmt->bindValue(':iddepartamento',$_POST["departamento"]);
			}
			$success=$stmt->execute();
			$con = null;
		}
		if($success){
			header('Location: index.php');
		}
	} catch(PDOException $e){
		echo 'Erro: ' . $e->getMessage();
	}
?>
</body>
</html>
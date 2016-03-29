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
		if(isset($_POST["nome"]) && !isset($_GET["voltar"])){		
			$stmt = $con->prepare("INSERT INTO aluno(nome, matricula, idade) VALUES(:nome, :matricula, :idade)"); 
			$stmt->bindValue(':nome',$_POST["nome"]); 
			$stmt->bindValue(':matricula',$_POST["matricula"]);
			$stmt->bindValue(':idade',$_POST["idade"]);  
			$success=$stmt->execute();
		}

		if($success || isset($_GET["voltar"])){
			$rs = $con->query("SELECT id_aluno, nome, matricula, idade FROM aluno");
			echo '<table border="1">'; 
			echo '<tr>'.
		           '<th>ID</th>'.
		           '<th>Nome</th>'.
		           '<th>Matrícula</th>'.
		           '<th>Idade</th>'.
			       '<th>Ação</th>'.
		         '</tr>';
			while($row = $rs->fetch(PDO::FETCH_OBJ)){
				echo '<tr>'; 
				echo '<td>' . $row->id_aluno . '</td>'; 
				echo '<td>' . $row->nome . '</td>'; 
				echo '<td>' . $row->matricula . '</td>';
				echo '<td>' . $row->idade . '</td>';
				echo '<td><a href="removido.php?id=' . $row->id_aluno . '">Remover</a></td>';
				echo '</tr>'; 
			}
			echo '</table>';
		} else {
			echo '<table border="1"/>';
			echo '<tr>';
			echo '<td align="center"><b>Erro na inclusão do usuário.</b></td>';
			echo '</tr>';
			echo '</table>';
		}
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
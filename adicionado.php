<?php 
	$dsn = "mysql:host=localhost;dbname=cursodb";
	$usuario = "root";
	$senha = "";
	$opcoes = array(PDO::ATTR_PERSISTENT => true,
	                PDO::ATTR_CASE => PDO::CASE_LOWER
	);
	
	try {
		$con = new PDO($dsn, $usuario, $senha, $opcoes);
		if(isset($_POST["nome"])){		
			$stmt = $con->prepare("INSERT INTO aluno(nome, matricula, idade) VALUES(:nome, :matricula, :idade)"); 
			$stmt->bindValue(':nome',$_POST["nome"]); 
			$stmt->bindValue(':matricula',$_POST["matricula"]);
			$stmt->bindValue(':idade',$_POST["idade"]);  
			$stmt->execute();
		}
		
		echo '<h1><p color="blue">Aluno incluído com sucesso.</p></h1>';
		echo '<br/>';
		
		$rs = $con->query("SELECT id_aluno, nome, matricula, idade FROM aluno");
		echo '<table border="1">'; 
		echo '<tr><th>ID</th><th>Nome</th><th>Matrícula</th><th>Idade</th></tr>';
		while($row = $rs->fetch(PDO::FETCH_OBJ)){
			echo '<tr>'; 
			echo '<td>' . $row->id_aluno . '</td>'; 
			echo '<td>' . $row->nome . '</td>'; 
			echo '<td>' . $row->matricula . '</td>';
			echo '<td>' . $row->idade . '</td>';
			echo '</tr>'; 
		}
		echo '</table>';
	} catch(PDOException $e){
		echo 'Erro: ' .$e->getMessage();
	}
?>
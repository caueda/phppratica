<html>
<title>
	<head>Lista de Alunos</head>
</title>
<body>
<h2>Página Inicial</h2>
<ul>
	<li style="display:inline;"><a href="cadastro.html">Incluir</a></li>
	<li style="display:inline;"><a href="index.php">Refresh</a></li>		
</ul>
<br>
<?php
	include("bd.php");
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
		echo '<td>';
		echo '<a href="removido.php?id=' . $row->id_aluno . '">Remover</a>&nbsp;/&nbsp;';
		echo '<a href="atualizar.php?idaluno='.$row->id_aluno . '&nome='. $row->nome.'&matricula='.$row->matricula.'&idade='.$row->idade.'">Atualizar</a>&nbsp;';
		echo '</td>';
		echo '</tr>'; 
	}
	echo '</table>';	
	$con = null;
?>	
	
</body>
</html>
<html>
<head>
	<title>Lista de Alunos</title>
	<?php include("header.php")?>	
    <script>
    $(document).ready(function(){
	    $('#menu').puimenubar();
    });
    </script>
</head>
<body>
	<div class="container">
		<h2>Página Inicial</h2>		
		<ul  id="menu">
			<li><a href="cadastro.php"><i class="icon-plus"></i>Incluir</a></li>
			<li><a href="index.php"><i class="icon-refresh"></i>Refresh</a></li>		
		</ul>
		<br>
		<?php
			include("bd.php");
			$rs = $con->query("SELECT id_aluno, nome, matricula, idade, id_departamento FROM aluno");
			echo '<div class="table-responsive">';
			echo '<table class="table table-bordered table-hover table-condensed">'; 
			echo '<thead><tr>'.
		           '<th>ID</th>'.
		           '<th>Nome</th>'.
		           '<th>Matrícula</th>'.
		           '<th>Idade</th>'.
			       '<th>Ação</th>'.
		         '</tr></thead>';
			while($row = $rs->fetch(PDO::FETCH_OBJ)){
				echo '<tr>'; 
				echo '<th scope="row">' . $row->id_aluno . '</th>'; 
				echo '<td>' . $row->nome . '</td>'; 
				echo '<td>' . $row->matricula . '</td>';
				echo '<td>' . $row->idade . '</td>';
				echo '<td>';
				echo '<a href="removido.php?id=' . $row->id_aluno . '"><i class="icon-trash"></i>&nbsp;Remover</a>&nbsp;/&nbsp;';
				echo '<a href="atualizar.php?idaluno='.$row->id_aluno . '&nome='. $row->nome.'&matricula='.$row->matricula.'&idade='.$row->idade.'&departamento='.$row->id_departamento.'"><i class="icon-pencil"></i>&nbsp;Atualizar</a>&nbsp;';
				echo '</td>';
				echo '</tr>'; 
			}
			echo '</table>';	
			echo '</div>';
			$con = null;
		?>	
	</div>
</body>
</html>
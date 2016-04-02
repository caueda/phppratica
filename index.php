<html>
<head>
    <?php header('Content-Type: text/html; charset=iso-8859-1'); ?>
	<title>Lista de Alunos</title>
	<?php include("header.php")?>	
    <script>
    $(document).ready(function(){
	    $('#menu').puimenubar();
    });
    function mensagem(){
        alert('Este aluno já está inscrito em um curso.');
    }
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
			$rs = $con->query("SELECT a.id_aluno, a.nome, a.matricula, a.idade, a.id_departamento, d.nome as nome_depto, c.nome as curso FROM aluno a LEFT JOIN departamento d ON a.id_departamento = d.id_departamento LEFT JOIN aluno_curso ac on ac.id_aluno = a.id_aluno LEFT JOIN curso c ON ac.id_curso = c.id_curso");
			echo '<div class="table-responsive">';
			echo '<table class="table table-bordered table-hover table-condensed">'; 
			echo '<thead><tr>'.
		           '<th>ID</th>'.
		           '<th>Nome</th>'.
		           '<th>Matrícula</th>'.
		           '<th>Idade</th>'.
                   '<th>Departamento</th>'.
                   '<th>Curso</th>'.
			       '<th>Ação</th>'.
		         '</tr></thead>';
			while($row = $rs->fetch(PDO::FETCH_OBJ)){
				echo '<tr>'; 
				echo '<th scope="row">' . $row->id_aluno . '</th>'; 
				echo '<td>' . $row->nome . '</td>'; 
				echo '<td>' . $row->matricula . '</td>';
				echo '<td>' . $row->idade . '</td>';
                echo '<td>' . $row->nome_depto . '</td>';
                echo '<td>' . $row->curso . '</td>';
				echo '<td>';
				echo '<a href="removido.php?id=' . $row->id_aluno . '"><i class="icon-trash"></i>&nbsp;Remover</a>&nbsp;/&nbsp;';				
                echo '<a href="atualizar.php?idaluno='.$row->id_aluno . '&nome='. $row->nome.'&matricula='.$row->matricula.'&idade='.$row->idade.'&departamento='.$row->id_departamento.'"><i class="icon-edit"></i>&nbsp;Atualizar&nbsp;/</a>&nbsp;';
                if(is_null($row->curso)){
                    echo '<a href="inscricao.php?idaluno='.$row->id_aluno . '&nome='. $row->nome.'&iddepartamento='.$row->id_departamento.'"><i class="icon-edit"></i>&nbsp;Inscrever</a>&nbsp;';
				} else {
                    echo '<a href="#" onclick="javascript:mensagem();"><i class="icon-edit"></i>&nbsp;Inscrever</a>';
                }
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
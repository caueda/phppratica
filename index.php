<html>
<head>
    <?php header('Content-Type: text/html; charset=iso-8859-1'); ?>
	<title>Lista de Alunos</title>
	<?php include("header.php")?>	
    <script>
    $(document).ready(function(){
	    $('#menu').puimenubar();
	    $(function() {
		    if($("#dialog p").html() != ''){
	        	$( "#dialog" ).dialog({
						        		   closeOnEscape: false,
						        		   open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
						        		   buttons: {
						        		        Fechar: function() {
						        		          $( this ).dialog( "close" );
						        		        }
						        		      }
						        		});
		    }
	    });
    });
    function mensagem(){
        alert('Este aluno já está inscrito em um curso.');
    }
    </script>
</head>
<body>
	<div class="container">
		<h2>Lista de alunos</h2>		
		<ul  id="menu">
			<li><a href="cadastro_curso.php?incluir=1"><i class="icon-plus"></i>Incluir</a></li>
			<li><a href="curso.php"><i class="icon-book"></i>Curso</a></li>
			<li><a href="departamento.php"><i class="icon-book"></i>Departamento</a></li>		
			<li><a href="index.php"><i class="icon-home"></i>Refresh</a></li>
		</ul>
		<br>
		<?php
			include("bd.php");
			if(isset($_GET["inativar_inscricao"])){
				$idcurso = $_GET["idcurso"];
				$idaluno = $_GET["idaluno"];
				
				$stmt = $con->prepare("UPDATE aluno_curso SET ativo=0 WHERE id_curso =:idcurso and id_aluno = :idaluno");
				$success=$stmt->execute(array(
						":idcurso"=>$idcurso,
						":idaluno"=>$idaluno
				));
				
				if($success){
					header('Location: index.php');
				}
				
			}
			
			$rs = $con->query("SELECT a.id_aluno, a.nome, a.matricula, a.idade, a.id_departamento, d.nome as nome_depto, c.nome as curso, c.id_curso
					FROM aluno a LEFT JOIN departamento d ON a.id_departamento = d.id_departamento 
					LEFT JOIN aluno_curso ac on ac.id_aluno = a.id_aluno and ac.ativo = 1 
					LEFT JOIN curso c ON ac.id_curso = c.id_curso
					ORDER BY a.id_aluno");
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
                echo '<a href="atualizar.php?idaluno='.$row->id_aluno . '&nome='. $row->nome.'&matricula='.$row->matricula.'&idade='.$row->idade.'&departamento='.$row->id_departamento.'"><i class="icon-edit"></i>&nbsp;Atualizar&nbsp;</a>/&nbsp;';
                if(is_null($row->curso)){
                    echo '<a href="inscricao.php?idaluno='.$row->id_aluno . '&nome='. $row->nome.'&iddepartamento='.$row->id_departamento.'"><i class="icon-check"></i>&nbsp;Inscrever</a>&nbsp;/&nbsp;';
				} else {
                    echo '<a href="#" onclick="javascript:mensagem();"><i class="icon-check"></i>&nbsp;Inscrever</a>&nbsp;/&nbsp;';
                }
                echo '<a href="index.php?inativar_inscricao=1&idcurso=' . $row->id_curso .'&idaluno='.$row->id_aluno.'"><i class="icon-remove-sign"></i>&nbsp;Cancelar Inscrição&nbsp;</a>';
                echo '</td>';
				echo '</tr>'; 
			}
			echo '</table>';	
			echo '</div>';
			$con = null;
		?>	
	</div>
	<div id="dialog" title="Mensagem">
  	<p><?php echo $_GET['mensagem'] ?></p>
	</div>
</body>
</html>
<html>
<head>
    <?php header('Content-Type: text/html; charset=iso-8859-1'); ?>
	<title>Lista de Cursos</title>
	<?php include("header.php")?>	
    <script>
    $(document).ready(function(){
	    $('#menu').puimenubar();
    });
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
    </script>
</head>
<body>
	<div class="container">
		<h2>Lista de cursos</h2>		
		<ul  id="menu">
			<li><a href="cadastro_curso.php?incluir=1"><i class="icon-plus"></i>Incluir</a></li>
			<li><a href="index.php"><i class="icon-book"></i>Aluno</a></li>
			<li><a href="departamento.php"><i class="icon-book"></i>Departamento</a></li>
			<li><a href="curso.php"><i class="icon-home"></i>Refresh</a></li>		
		</ul>
		<br>
		<?php
			include("bd.php");
			if(isset($_GET["remover_curso"])){
				$idcurso = $_GET["idcurso"];
				$stmt = $con->prepare("UPDATE curso SET ativo = 0 WHERE id_curso = :idcurso");
				$success=$stmt->execute(array(
						":idcurso"=>$idcurso
				));
				
				if($success){
					header('Location: curso.php?mensagem='. urlencode('Curso removido com sucesso!'));
				}
			}
			
			$rs = $con->query("SELECT c.id_curso, c.nome as curso, c.descricao, c.ano, c.valor, d.id_departamento, d.nome as departamento
					 FROM curso c
					 LEFT JOIN departamento d ON c.id_departamento = d.id_departamento
					WHERE c.ativo = 1
					ORDER BY c.nome");
			echo '<div class="table-responsive">';
			echo '<table class="table table-bordered table-hover table-condensed">'; 
			echo '<thead><tr>'.
		           '<th>ID</th>'.
		           '<th>Curso</th>'.  
		           '<th>Ano</th>'.
		           '<th>Valor</th>'.
                   '<th>Departamento</th>'.                   
			       '<th>Ação</th>'.
		         '</tr></thead>';
			while($row = $rs->fetch(PDO::FETCH_OBJ)){
				echo '<tr>'; 
				echo '<th scope="row">' . $row->id_curso . '</th>'; 
				echo '<td>' . $row->curso . '</td>';
				echo '<td>' . $row->ano . '</td>';
				echo '<td>' . number_format($row->valor,2,'.',','). '</td>';
				echo '<td>' . $row->departamento . '</td>';
				echo '<td>';
				echo '<a href="curso.php?remover_curso=1&idcurso=' . $row->id_curso . '"><i class="icon-trash"></i>&nbsp;Remover</a>&nbsp;/&nbsp;';				
                echo '<a href="cadastro_curso.php?idcurso='.$row->id_curso . '&curso='. $row->curso.'&descricao='.$row->descricao.'&departamento='.$row->id_departamento.'&ano='.$row->ano.'&valor='.urlencode(number_format($row->valor,2,'.',',')).'"><i class="icon-edit"></i>&nbsp;Atualizar&nbsp;</a>&nbsp;';
                echo '</td>';
				echo '</tr>'; 
			}
			echo '</table>';	
			echo '</div>';
			$con = null;
		?>	
	</div>
	<?php include 'mensagem.php';?>
</body>
</html>
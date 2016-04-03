<html>
<head>
    <?php header('Content-Type: text/html; charset=iso-8859-1'); ?>
	<title>Lista de Departamentos</title>
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
		<h2>Lista de departamentos</h2>		
		<ul  id="menu">
			<li><a href="cadastro_departamento.php?incluir=1"><i class="icon-plus"></i>Incluir</a></li>
			<li><a href="index.php"><i class="icon-book"></i>Aluno</a></li>
			<li><a href="curso.php"><i class="icon-book"></i>Curso</a></li>
			<li><a href="departamento.php"><i class="icon-home"></i>Refresh</a></li>		
		</ul>
		<br>
		<?php
			include("bd.php");
			if(isset($_GET["remover_departamento"])){
				$departamento = $_GET["departamento"];
				$stmt = $con->prepare("UPDATE departamento SET ativo = 0 WHERE id_departamento = :departamento");
				$success=$stmt->execute(array(
						":departamento"=>$departamento
				));
				
				if($success){
					header('Location: departamento.php?mensagem='. urldecode('Departamento removido com sucesso!'));
				}
			}
			
			$rs = $con->query("SELECT d.id_departamento, d.nome, d.descricao
					             FROM departamento d
					            WHERE d.ativo = 1
				 				ORDER BY d.nome");
			echo '<div class="table-responsive">';
			echo '<table class="table table-bordered table-hover table-condensed">'; 
			echo '<thead><tr>'.
		           '<th>ID</th>'.
		           '<th>Departamento</th>'.         
                   '<th>Descrição</th>'.                   
			       '<th>Ação</th>'.
		         '</tr></thead>';
			while($row = $rs->fetch(PDO::FETCH_OBJ)){
				echo '<tr>'; 
				echo '<th scope="row">' . $row->id_departamento . '</th>'; 
				echo '<td>' . $row->nome . '</td>'; 
				echo '<td>' . $row->descricao . '</td>';
				echo '<td>';
				echo '<a href="departamento.php?remover_departamento=1&departamento=' . $row->id_departamento . '"><i class="icon-trash"></i>&nbsp;Remover</a>&nbsp;/&nbsp;';				
                echo '<a href="cadastro_departamento.php?departamento='.$row->id_departamento . '&nome='. $row->nome.'&descricao='.$row->descricao.'"><i class="icon-edit"></i>&nbsp;Atualizar&nbsp;</a>&nbsp;';
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
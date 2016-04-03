<html>
<head>
	<title>Inscrição</title>
	<?php include("header.php")?>
	<script>
		function validar(){
			return true;
		}
		$(document).ready(function(){
			$("#atualizar").click(function(){
				return validar();
			});
			$("#cancelar").click(function(){
				window.location.href='index.php';
			});				 
		});		
        $(function() {
            $( "#datacadastro" ).datepicker({ "dateFormat": "dd/mm/yy"});
        });
	</script>
</head>
<body>
<?php 
	include("bd.php");
	try {		
		if(isset($_POST["inscrever"])){
			$idcurso=$_POST["idcurso"];
			$idaluno=$_POST["idaluno"];
			$datacadastro=$_POST["datacadastro"];
			$iddepartamento=$_POST["iddepartamento"];
            
			$stmt = $con->prepare("INSERT INTO aluno_curso (id_aluno,id_curso,data_cadastro) VALUES(:idaluno, :idcurso, STR_TO_DATE(:datacadastro,'%d/%m/%Y'))");						
			$success=$stmt->execute(array(
			    ":idaluno"=>$idaluno,
				":idcurso"=>$idcurso,
				":datacadastro"=>$datacadastro
			));
			$con = null;
			if($success){
				header('Location: index.php');
			} 
		}
	} catch(PDOException $e){
		echo '<table border="1"/>';
		echo '<tr>';		
		echo '<th align="center"><b>Erro: ' . $e->getMessage(). '</b></th>';
		echo '</tr>';
		echo '</table>';
		exit();
	}
?>
	<div class="container">	
		<h3>Atualizar Aluno</h3>
		<form class="form-inline" action="inscricao.php" method="post">
			<input type="hidden" name="idaluno" value='<?= $_GET["idaluno"] ?>'/>
			
			<div class="form-group">
				<label for="nome" class="col-sm-2 control-label">Nome:</label>
				<div class="col-sm-10">
                    <input type="text" id="nome" name="nome" value='<?= $_GET["nome"] ?>' readonly="readonly">
				</div>
			</div>
			<div class="form-group">
				<label for="datacadastro" class="col-sm-2 control-label">Data de cadastro:</label>
				<div class="col-sm-10">
					<input id="datacadastro" type="text" name="datacadastro">
				</div>
			</div>
			<div class="form-group">
				<label for="departamento" class="col-sm-2 control-label">Curso:</label>
				<div class="col-sm-10">
					<select id="idcurso" name="idcurso" class="form-control">
						<option value="-1">Selecione</option>
						<?php 					
                            include("bd.php");                            
                            try {
                                $rs = $con->query("SELECT id_curso, nome FROM curso WHERE id_departamento = '" . $_GET['iddepartamento']  .  "' ORDER BY nome");							
                                while($row = $rs->fetch(PDO::FETCH_OBJ)){								 
                                    echo '<option value="' . $row->id_curso . '">' . $row->nome .'</option>';															
                                }		
                            } catch(PDOException $e){
                                echo '<table border="1"/>';
                                echo '<tr>';		
                                echo '<th align="center"><b>Erro: ' . $e->getMessage(). '</b></th>';
                                echo '</tr>';
                                echo '</table>';
                                exit();
                            }
							$con = null;
						?>
					</select>
				</div>
			</div>			
			<br>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
			    	<button id="inscrever" name="inscrever" type="submit" class="btn btn-primary">Inscrever</button>
			    	<button id="cancelar" name="cancelar" type="button" class="btn btn-primary">Cancelar</button>
			   	</div>			   	
			</div>	
		</form>
	</div>		
	</form>

</body>
</html>
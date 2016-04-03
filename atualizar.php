<html>
<head>
	<title>Inclusão de Aluno</title>
	<meta http-equiv="Content-type" content="text/html; charset=uiso-8859-1" />
	<?php include("header.php")?>
	<script>
		function validar(){
			var campo;
			campo = document.getElementById("nome");
			if(campo.value == ''){
				alert('O nome é obrigatório.');
				campo.focus();
				return false;
			}
			campo = document.getElementById("matricula");
			if(campo.value == ''){
				alert('A matrícula é obrigatória.');
				campo.focus();
				return false;
			}
			campo = document.getElementById("matricula");
			if(campo.value == ''){
				alert('A matrícula é obrigatória.');	
				campo.focus();
				return false;
			}
			campo = document.getElementById("idade");
			if(campo.value == ''){
				alert('A idade é obrigatória.');	
				campo.focus();
				return false;
			}
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
	</script>
</head>
<body>
<?php 
	include("bd.php");
	try {		
		if(isset($_POST["atualizar"])){
			$nome=$_POST["nome"];
			$idade=$_POST["idade"];
			$idaluno=$_POST["idaluno"];		
			$iddepartamento=$_POST["departamento"];
			if($iddepartamento == "-1"){
				$iddepartamento = null;
			}
			$stmt = $con->prepare("UPDATE aluno SET nome=:nome, idade=:idade, id_departamento=:iddepartamento WHERE id_aluno =:idaluno");						
			$success=$stmt->execute(array(
			    ":idaluno"=>$idaluno,
				":nome"=>$nome,
				":idade"=>$idade,
			    ":iddepartamento"=>$iddepartamento
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
		<form class="form-inline" action="atualizar.php" method="post">
			<input type="hidden" name="idaluno" value='<?= $_GET["idaluno"] ?>'/>
			
			<div class="form-group">
				<label for="nome" class="col-sm-2 control-label">Nome:</label>
				<div class="col-sm-10">
					<input type="text" id="nome" class="form-control" name="nome" value='<?= $_GET["nome"] ?>' >
				</div>
			</div>
			<div class="form-group">
				<label for="matricula" class="col-sm-2 control-label">Matrícula:</label>
				<div class="col-sm-10">
					<input type="text" id="matricula" class="form-control" name="matricula" value='<?= $_GET["matricula"]?>' readonly="readonly">
				</div>
			</div>
			<div class="form-group">
				<label for="idade" class="col-sm-2 control-label">Idade:</label>
				<div class="col-sm-10">
					<input type="text" id="idade" class="form-control" name="idade" value='<?= $_GET["idade"]?>'>
				</div>
			</div>			
			<div class="form-group">
				<label for="departamento" class="col-sm-2 control-label">Departamento:</label>
				<div class="col-sm-10">
					<select id="departamento" name="departamento" class="form-control">
						<option value="-1">Selecione</option>
						<?php 
							include("bd.php");
							$rs = $con->query("SELECT id_departamento, nome FROM departamento ORDER BY nome");							
							while($row = $rs->fetch(PDO::FETCH_OBJ)){								 
								echo '<option value="' . $row->id_departamento . '">' . $row->nome .'</option>';															
							}							
							$con = null;
						?>
					</select>
				</div>
			</div>			
			<br>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
			    	<button id="atualizar" name="atualizar" type="submit" class="btn btn-primary">Gravar</button>
			    	<button id="cancelar" name="cancelar" type="button" class="btn btn-primary">Cancelar</button>
			   	</div>			   	
			</div>	
		</form>
	</div>		
	</form>
	<script>
		var selectedDepartment = '<?=$_GET["departamento"]?>';
		for(var i=0; i<document.forms[0].departamento.options.length; i++){
			if(document.forms[0].departamento.options[i].value == selectedDepartment){
				document.forms[0].departamento.options[i].selected = true;
			}
		}
	</script>
</body>
</html>
<html>
<head>
	<title>Inclusão de Aluno</title>
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
	<form name="form" action="atualizar.php" method="post">
		<input type="hidden" name="idaluno" value='<?= $_GET["idaluno"] ?>'/>
		<table width="500px" align="center">			
			<tr>
				<td align="right">Nome:</td>
				<td align="left"><input id="nome" type="text" name="nome" value='<?= $_GET["nome"] ?>'></td>
			</tr>
			<tr>
				<td align="right">Matrícula:</td>
				<td align="left"><input type="text" id="matricula" name="matricula" value='<?= $_GET["matricula"]?>' readonly="readonly"></td>
			</tr>
			<tr>
				<td align="right">Idade:</td>
				<td align="left"><input type="text" name="idade" value='<?= $_GET["idade"]?>'></td>
			</tr>
			<tr>
				<td align="right">Departamento:</td>
				<td align="left">
					<select name="departamento" id="departamento">
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
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="atualizar" value="Gravar" align="middle" onclick="javascript: return validar();"/>
				</td>
			</tr>
		</table>
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
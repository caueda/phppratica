<html>
<head>
	<title>Inclus�o de Aluno</title>
	<script>
		function validar(){
			var campo;
			campo = document.getElementById("nome");
			if(campo.value == ''){
				alert('O nome � obrigat�rio.');
				campo.focus();
				return false;
			}
			campo = document.getElementById("matricula");
			if(campo.value == ''){
				alert('A matr�cula � obrigat�ria.');
				campo.focus();
				return false;
			}
			campo = document.getElementById("matricula");
			if(campo.value == ''){
				alert('A matr�cula � obrigat�ria.');	
				campo.focus();
				return false;
			}
			campo = document.getElementById("idade");
			if(campo.value == ''){
				alert('A idade � obrigat�ria.');	
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
			$stmt = $con->prepare("UPDATE aluno SET nome=:nome, idade=:idade WHERE id_aluno =:idaluno");						
			$success=$stmt->execute(array(
			    ":idaluno"=>$idaluno,
				":nome"=>$nome,
				":idade"=>$idade
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
	<form action="atualizar.php" method="post">
		<input type="hidden" name="idaluno" value='<?= $_GET["idaluno"] ?>'/>
		<table width="500px" align="center">			
			<tr>
				<td align="right">Nome:</td>
				<td align="left"><input id="nome" type="text" name="nome" value='<?= $_GET["nome"] ?>'></td>
			</tr>
			<tr>
				<td align="right">Matr�cula:</td>
				<td align="left"><input type="text" id="matricula" name="matricula" value='<?= $_GET["matricula"]?>' readonly="readonly"></td>
			</tr>
			<tr>
				<td align="right">Idade:</td>
				<td align="left"><input type="text" name="idade" value='<?= $_GET["idade"]?>'></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="atualizar" value="Gravar" align="middle" onclick="javascript: return validar();"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
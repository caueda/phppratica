<html>
	<head>
		<title>Inclusão de Aluno</title>
		<?php include("header.php")?>
		<script>
			function validar(){
				var campo;
				campo = document.getElementById("nome");
				if(campo.value == ''){
					alert('O nome do departamento é obrigatório.');
					campo.focus();
					return false;
				}
				campo = document.getElementById("descricao");
				if(campo.value == ''){
					alert('A descrição é obrigatória.');
					campo.focus();
					return false;
				}
				return true;
			}
		</script>
		<script>
			$(document).ready(function(){
				$("#atualizar").click(function(){
					return validar();
				});			
				$("#cancelar").click(function(){
					window.location.href='departamento.php';
				});		 
			});
		</script>
	</head>
	<?php 
	include("bd.php");
	try {		
		if(isset($_POST["atualizar"])){
			$departamento=$_POST["departamento"];
			$nome=$_POST["nome"];
			$descricao=$_POST["descricao"];		
			
			$stmt = $con->prepare("UPDATE departamento SET nome=:nome,descricao=:descricao WHERE id_departamento=:departamento");						
			$success=$stmt->execute(array(
			    ":nome"=>$nome,
				":descricao"=>$descricao,
				":departamento"=>$departamento
			));
			$con = null;
			if($success){
				header('Location: departamento.php?mensagem=' . urldecode('Departamento atualizado com sucesso!'));
			} 
		} elseif (isset($_POST["incluir"])){
			$nome=$_POST["nome"];
			$departamento=$_POST["departamento"];
			$descricao=$_POST["descricao"];
				
			$stmt = $con->prepare("INSERT INTO departamento(nome,descricao) VALUES(:nome, :descricao)");
			$success=$stmt->execute(array(
					":nome"=>$nome,
					":descricao"=>$descricao
			));
			$con = null;
			if($success){
				header('Location: departamento.php?mensagem=' . urldecode('Departamento incluído com sucesso!'));
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
	<body>
	<div class="container">	
		<h3>Cadastrar Departamento</h3>
		<form class="form-inline" action="cadastro_departamento.php" method="post">
			<?php if(isset($_GET["departamento"])) { ?>
			<input type="hidden" name="departamento" id="departamento" value='<?= $_GET["departamento"] ?>'>
			<?php } ?>
			<div class="form-group">
				<label for="nome" class="col-sm-2 control-label">Nome:</label>
				<div class="col-sm-10">
					<input type="text" id="nome" class="form-control" name="nome" value='<?= $_GET["nome"] ?>'>
				</div>
			</div>
			<div class="form-group">
				<label for="descricao" class="col-sm-2 control-label">Descrição:</label>
				<div class="col-sm-10">
					<textarea name="descricao" id="descricao" rows="3" cols="80"><?php  echo $_GET["descricao"] ?></textarea>
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<?php 
						if(isset($_GET["incluir"])){						
					?>
			    	<button id="incluir" name="incluir" type="submit" class="btn btn-primary">Incluir</button>
			    	<?php
						} else {			    	
			    	?>
			    	<button id="atualizar" name="atualizar" type="submit" class="btn btn-primary">Atualizar</button>
			    	<?php } ?>
			    	<button id="cancelar" name="cancelar" type="button" class="btn btn-primary">Cancelar</button>
			   	</div>
			</div>	
		</form>
	</div>
	<script>
	</script>
	</body>
</html>
<html>
	<head>
		<title>Inclusão de curso</title>
		<?php include("header.php")?>
		<script>
			function validar(){
				var campo;
				campo = document.getElementById("curso");
				if(campo.value == ''){
					alert('O curso é obrigatório.');
					campo.focus();
					return false;
				}
				campo = document.getElementById("descricao");
				if(campo.value == ''){
					alert('A descrição é obrigatória.');
					campo.focus();
					return false;
				}
				campo = document.getElementById("ano");
				if(campo.value == ''){
					alert('O ano do curso é obrigatória.');
					campo.focus();
					return false;
				}
				campo = document.getElementById("departamento");
				if(campo.value == ''){
					alert('O departamento é obrigatória.');	
					campo.focus();
					return false;
				}
				campo = document.getElementById("valor");
				if(campo.value == ''){
					alert('O valor é obrigatório.');	
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
					window.location.href='curso.php';
				});		 
				$('#valor').maskMoney();
			});
		</script>
	</head>
	<?php 
	include("bd.php");
	try {		
		if(isset($_POST["atualizar"])){
			$idcurso=$_POST["idcurso"];
			$curso=$_POST["curso"];
			$departamento=$_POST["departamento"];
			$ano=$_POST["ano"];
			$descricao=$_POST["descricao"];		
			$valor=urldecode($_POST["valor"]);
			$stmt = $con->prepare("UPDATE curso SET nome=:curso,descricao=:descricao,id_departamento=:departamento,ano=:ano,valor=:valor WHERE id_curso=:idcurso");						
			$success=$stmt->execute(array(
			    ":curso"=>$curso,
				":descricao"=>$descricao,
				":departamento"=>$departamento,
				":ano"=>$ano,
				":valor"=>str_replace(",", "", $valor),
				":idcurso"=>$idcurso
			));
			$con = null;
			if($success){
				header('Location: curso.php?mensagem=' . urlencode('Curso atualizado com sucesso! '));
			} 
		} elseif (isset($_POST["incluir"])){
			$curso=$_POST["curso"];
			$departamento=$_POST["departamento"];
			$descricao=$_POST["descricao"];
			$valor=$_POST["valor"];	
			$stmt = $con->prepare("INSERT INTO curso(nome,descricao,id_departamento,valor) VALUES(:curso, :descricao, :iddepartamento,:valor)");
			$success=$stmt->execute(array(
					":curso"=>$curso,
					":descricao"=>$descricao,
					":iddepartamento"=>$departamento,
					":valor"=>str_replace(",", "", $valor),
			));
			$con = null;
			if($success){
				header('Location: curso.php?mensagem=' . urldecode('Curso incluído com sucesso!'));
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
		<?php 
			$curso=(isset($_GET["curso"])?$_GET["curso"]:'');
			$idcurso=(isset($_GET["idcurso"])?$_GET["idcurso"]:'');
			$descricao=(isset($_GET["descricao"])?$_GET["descricao"]:'');
			$ano=(isset($_GET["ano"])?$_GET["ano"]:'');
			$departamento=(isset($_GET["departamento"])?$_GET["departamento"]:'');
			$valor=(isset($_GET["valor"])?$_GET["valor"]:'0.0');
		?>
		<h3>Cadastrar Aluno</h3>
		<form class="form-inline" action="cadastro_curso.php" method="post">
			<?php if(isset($_GET["idcurso"])){ ?>
			<input type="hidden" name="idcurso" id="idcurso" value='<?= $_GET["idcurso"] ?>'>
			<?php } ?>
			<div class="form-group">
				<label for="curso" class="col-sm-2 control-label">Nome:</label>
				<div class="col-sm-10">
					<input type="text" id="curso" class="form-control" name="curso" value='<?= $curso ?>'>
				</div>
			</div>
			<div class="form-group">
				<label for="descricao" class="col-sm-2 control-label">Descrição:</label>
				<div class="col-sm-10">
					<textarea rows="3" cols="100" id="descricao" name="descricao"><?php echo $descricao ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="ano" class="col-sm-2 control-label">Ano:</label>
				<div class="col-sm-10">
					<input type="text" id="ano" oclass="form-control" name="ano" value='<?= $ano ?>'>
				</div>
			</div>
			<div class="form-group">
				<label for="valor" class="col-sm-2 control-label">Valor:</label>
				<div class="col-sm-10">
					<input type="text" id="valor" class="form-control" name="valor" value='<?= $valor ?>'>
				</div>
			</div>
			<div class="form-group">
				<label for="departamento" class="col-sm-2 control-label">Departamento:</label>
				<div class="col-sm-10">
					<select id="departamento" name="departamento" class="form-control">
						<option value="-1">Selecione</option>
						<?php 
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
		var selectedDepartment = '<?= $departamento ?>';
		for(var i=0; i<document.forms[0].departamento.options.length; i++){
			if(document.forms[0].departamento.options[i].value == selectedDepartment){
				document.forms[0].departamento.options[i].selected = true;
			}
		}
	</script>
	</body>
</html>
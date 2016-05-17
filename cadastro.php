<html>
	<head>
		<title>Inclusão de Aluno</title>
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
		</script>
		<script>
			$(document).ready(function(){
				$("#gravar").click(function(){
					return validar();
				});				 
			});
		</script>
	</head>
	<body>
	<div class="container">	
		<form class="form-inline" action="adicionado.php" method="post">
			<div class="form-group">
				<label for="nome" class="col-sm-2 control-label">Nome:</label>
				<div class="col-sm-10">
					<input type="text" id="nome" class="form-control" name="nome" placeholder="Digite seu nome...">
				</div>
			</div>
			<div class="form-group">
				<label for="matricula" class="col-sm-2 control-label">Matrícula:</label>
				<div class="col-sm-10">
					<input type="text" id="matricula" class="form-control" name="matricula" placeholder="Matrícula">
				</div>
			</div>
			<div class="form-group">
				<label for="idade" class="col-sm-2 control-label">Idade:</label>
				<div class="col-sm-10">
					<input type="text" id="idade" class="form-control" name="idade" placeholder="Idade">
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
			    	<button id="gravar" type="submit" class="btn btn-primary">Gravar</button>
			   	</div>
			</div>	
		</form>
	</div>
	</body>
</html>
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
		<form action="adicionado.php" method="post">
			<table width="500px" align="center">
				<tr>
					<td align="right">Nome:</td>
					<td align="left"><input id="nome" type="text" name="nome"></td>
				</tr>
				<tr>
					<td align="right">Matr�cula:</td>
					<td align="left"><input type="text" id="matricula" name="matricula"></td>
				</tr>
				<tr>
					<td align="right">Idade:</td>
					<td align="left"><input type="text" name="idade" name="idade"></td>
				</tr>
				<tr>
					<td align="right">Departamento:</td>
					<td align="left">
						<select id="departamento" name="departamento">
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
						<input type="submit" value="Gravar" align="middle" onclick="javascript: return validar();"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
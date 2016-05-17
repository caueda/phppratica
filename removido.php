<html>
<head>
	<title>Excluir registro</title>
	<link rel="stylesheet" href="themes/default/style.min.css" />
	<script src="scripts/jquery-1.12.0.js"></script>
	<script src="scripts/jstree.js"></script>
	<script src="scripts/jquery-ui.js"></script>	
	<!-- Bootstrap -->
    <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="style/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="style/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
	include("bd.php");
	
	try {
		if(isset($_GET["id"])){		
			$con->beginTransaction();
			$stmt = $con->prepare("DELETE FROM aluno WHERE id_aluno = :id_aluno"); 
			$stmt->bindValue(':id_aluno',$_GET["id"]);			  
			$success=$stmt->execute();
			$con->commit();
			$con = null;
		}
		if($success){
			header('Location: index.php');				
		} else {
			echo '<h1>N�o foi poss�vel excluir o aluno</h1>';
		}			
	} catch(PDOException $e){
		echo '<table border="1"/>';
		echo '<tr>';
		if($e->getCode() == 23000){
			echo '<th align="center"><b>Este registro n�o pode ser removido pois est� relacionado a um curso.</b></th>';
		} else {			
			echo '<th align="center"><b>Erro: ' . $e->getMessage(). '</b></th>';
		}
		echo '</tr>';
		echo '</table>';
	}
	echo '<br/><a href="index.php">In�cio</a>';
?>
</body>
</html>
<?php
	$mensagem='';
	if(isset($_GET["mensagem"])){
		$mensagem=$_GET["mensagem"];
	}
	echo '<div id="dialog" title="Mensagem">';
  	echo '<p>'.$mensagem.'</p>';
	echo '</div>';
?>
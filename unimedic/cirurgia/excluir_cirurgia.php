<!DOCTYPE html>
<html>
	<head>
		<title>Página de Exclusão</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<?php	
			header("content-type: text/html;charset=utf-8");

			$codigo = $_GET['c'];	
			
			$url 	= 'localhost';
			$usuario='root';
			$senha	='';
			
			$con = mysqli_connect($url, $usuario,$senha);
			
			mysqli_query($con,"SET NAMES 'utf8'");
			mysqli_query($con,"SET character_set_connection=utf8");
			mysqli_query($con,"SET character_set_client=utf8");
			mysqli_query($con,"SET character_set_results=utf8");
			
			echo "<h2>Exclusão de Cirúrgia</h2>";	
			echo "Excluindo agendamento cirúrgico código $codigo <br>"; 
			
			
			$db = 'banco_unimedic';
			
			mysqli_select_db($con, $db) or 
				die("Erro na seleção do banco:" .
						mysqli_error($con) );
						
			
			$sql = "DELETE FROM agenda_cirurgia WHERE id=$codigo";
			
			mysqli_query($con, $sql) or 
				die("Erro na exclusão do agendamento $codigo:" .
						mysqli_error($con) ) ;
			
			
			echo "Agendamento $codigo excluído com sucesso!<hr>";
			echo "<a href='listagem_cirurgia.php'>Listagem de Cirurgias</a>";
			?>
	</body>
</html>
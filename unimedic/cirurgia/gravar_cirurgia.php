<!DOCTYPE html>
<html lang="pt-br">

	<head>
		<title>Gravando Cirúrgia</title>
		<meta charset="UTF-8">
	<head>

	<body>
		<h2>Gravando Agendamento Cirúrgico</h2>
		
		<?php
			header("content-type: text/html;charset=utf-8");
			
			$nomePaciente	 = $_POST['nomePaciente'];
			$procedimento	 = $_POST['procedimento'];
			$medicoResponsa	 = $_POST['medicoResponsa'];
			$assistente		 = $_POST['assistente'];
			$salaCirurgica	 = $_POST['salaCirurgica'];
			$data			 = $_POST['data'];
			$periodo		 = $_POST['periodo'];
			$obs			 = $_POST['obs'];
			
			echo "Nome do paciente: $nomePaciente <br>";
			echo "Procedimento: $procedimento <br>";
			echo "Médico responsável: $medicoResponsa <br>";
			
			if($assistente =="")
				echo "Assistente: Sem assistente <br>";
			else
				echo "Assistente: $assistente <br>";	
			
			
			echo "Sala Cirúgica/Consultório: $salaCirurgica <br>";
			echo "Data: $data <br>";
			echo "Período: $periodo <br>";
			
			if($obs=="")
				echo "Observações: Nenhuma observação destacada. <br>";
			else
				echo "Observações: $obs <br>";
			
			if (strlen($nomePaciente) < 3)
			{
				echo "<hr>";
				echo "O nome do Paciente deve ter pelo menos 3 
				caracteres. Informe novamente.<br>";
				die("Programa Cancelado");
			}
			
			// Gravando no banco de dados
			// 1 - Conectar no MYSQL
			$con = mysqli_connect("localhost", "root", "");
			
			// 2 - Selecionar / Abrir banco de dados
			mysqli_select_db($con, "banco_unimedic") or 
				die("Erro na abertura/seleção do banco: " .
					mysqli_error($con) );
				
			// Configuração do UTF-8
			mysqli_query($con,"SET NAMES 'utf8'");
			mysqli_query($con,"SET character_set_connection=utf8");
			mysqli_query($con,"SET character_set_client=utf8");
			mysqli_query($con,"SET character_set_results=utf8");

					
			// 3 - criar a variável com o comando de inserção
			$sql = 
			"INSERT INTO agenda_cirurgia
			(nomePaciente, procedimento, medicoResponsa, assistente, salaCirurgica, data, periodo, obs) VALUES
			('$nomePaciente', '$procedimento', '$medicoResponsa', '$assistente', '$salaCirurgica', '$data', '$periodo', '$obs')";
			
			// 4 - Enviar o comando que está na variável para o MYSQL
			mysqli_query($con , $sql) or
				die("Erro na inserção de agendamento:" .
					mysqli_error($con) );
					
			echo "Agendamento efetuado com sucesso!";

		?>

		<hr>

		<a href="listagem_cirurgia.php">Listagem Cirúrgica</a>
	</body>
</html>
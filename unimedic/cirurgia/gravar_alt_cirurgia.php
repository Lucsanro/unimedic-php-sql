<!DOCTYPE html>
<html lang="pt-br">

	<head>
		<title>Gravando Alteração</title>
		<meta charset="UTF-8">
	<head>

	<body>
		<?php

			header("content-type: text/html;charset=utf-8");

			if(! isset($_POST['id']))
				die("Rotina chamada de forma incorreta!");
			
			$id				 = $_POST["id"];				
			$nomePaciente	 = $_POST['nomePaciente'];		
			$procedimento	 = $_POST['procedimento'];		
			$medicoResponsa	 = $_POST['medicoResponsa'];	
			$assistente		 = $_POST['assistente'];		
			$salaCirurgica	 = $_POST['salaCirurgica'];		
			$data			 = $_POST['data'];			
			$periodo		 = $_POST['periodo'];		
			$obs			 = $_POST['obs'];
			
			echo "<h2>Alterando Dados</h2>";
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

			// Conectando no MYSQL e abrindo o banco
			include "conexao.php";
			
			// 3 - Criando a string de alteração de dados
			/*$sql = "UPDATE times SET 	
				nome='$nome'				,
				tecnico='$tecnico'			,
				pontos='$pontos'			,
				G4='$G4'					,
				tipo='$tipo'				,
				dataCriacao='$dataCriacao'	,
				regiao='$região'			,
				historico ='$historico'      ";
				
			//Verificando se é p/atualizar o arquivo
			if($nomeArquivo !=="")
				$sql = $sql . " ,icone='$nomeArquivo' ";
			//
			$sql = $sql . " WHERE id=$codigo " ;
			*/
			
			$sql = "UPDATE agenda_cirurgia SET
				nomePaciente='$nomePaciente'	,
				procedimento='$procedimento'	, 
				medicoResponsa='$medicoResponsa',
				assistente='$assistente'		, 
				salaCirurgica='$salaCirurgica'	,
				data='$data'					, 
				periodo='$periodo'				,
				obs='$obs' WHERE id=$codigo ";

			
			// echo "<hr>Comando SQL: <br> $sql <br>" ;
			
			// 4 - Enviando o comando de inserção para o MYSQL
			mysqli_query($con, $sql) or 
				die("Erro na inserção de registro no banco:" .
					mysqli_error($con) );
					
			// Configuração do UTF-8
			mysqli_query($con,"SET NAMES 'utf8'");
			mysqli_query($con,"SET character_set_connection=utf8");
			mysqli_query($con,"SET character_set_client=utf8");
			mysqli_query($con,"SET character_set_results=utf8");
			
		?>

		Dados gravados com sucesso!
		<hr>

		<a href="listagem_cirurgia.php">Listagem Cirúrgica</a>
	</body>
</html>
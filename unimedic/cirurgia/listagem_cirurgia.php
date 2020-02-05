<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Listagem Cirúgica</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
	
		<div>
			<h2>Listagem Cirúrgica</h2>
			
			<?php	
			
				header("content-type: text/html;charset=utf-8");
				
				$con = mysqli_connect('localhost', 'root', '');
				
				mysqli_query($con,"SET NAMES 'utf8'");
				mysqli_query($con,"SET character_set_connection=utf8");
				mysqli_query($con,"SET character_set_client=utf8");
				mysqli_query($con,"SET character_set_results=utf8");

				
				$resultado = mysqli_select_db($con, 
								'banco_unimedic') or
					die("Erro na abertura do banco de 
						dados:" . mysqli_error($con) );

				
				$comandoSQL = "SELECT * FROM agenda_cirurgia" ;
				
				
				$registros = mysqli_query($con, $comandoSQL) or 
					die("Erro na seleção de registros:" .
							mysqli_error($con) );

				
				$linhas = mysqli_num_rows($registros);
				
				if($linhas<1)
					die("O agendamento de cirurgias está vazio!" . 
							"<hr> <a href='../homepage.html'>Voltar para Ínicio</a> |
							<a href='agenda_cirurgia.html'>Cadastrar Cirúrgia</a>");
				
				
				
				$contador = 0;	
				
				echo "<table border='1'>";
				
				
				echo "		<tr>";
				echo "			<th>Código</th>";
				echo "			<th>Paciente</th>";   			
				echo "			<th>Procedimento</th>";			
				echo "			<th>Médico</th>";				
				echo "			<th>Assistente</th>";			
				echo "			<th>Sala</th>";					
				echo "			<th>Data</th>";					
				echo "			<th>Período</th>";				
				echo "			<th>Obs</th>";	
				echo "			<th colspan='2'>Ações</th>";
				echo "		</tr>";
						
				while ($contador < $linhas)
				{
					
					
					$dados=mysqli_fetch_array($registros);
					
					$id				 = $dados["id"];				
					$nomePaciente	 = $dados['nomePaciente'];		
					$procedimento	 = $dados['procedimento'];		
					$medicoResponsa	 = $dados['medicoResponsa'];	
					$assistente		 = $dados['assistente'];		
					$salaCirurgica	 = $dados['salaCirurgica'];		
					$data			 = $dados['data'];			
					$periodo		 = $dados['periodo'];		
					$obs			 = $dados['obs'];			
					
					
					echo "<tr>";
					
					echo "	<td>$id</td>"; 							
					echo "	<td>$nomePaciente</td>";				
					echo "	<td>$procedimento</td>";				
					echo "	<td>$medicoResponsa</td>";			
					echo "	<td>$assistente</td>" ;					
					echo "	<td>$salaCirurgica</td>";				
					echo "	<td>$data</td>";						
					echo "	<td>$periodo</td>";						
					echo "	<td>$obs</td>";							
					echo "	<td> <a href='excluir_cirurgia.php?c=$id'>Excluir</a> </td>";
					echo "	<td> <a href='alterar_cirurgia.php?c=$id'>Alterar</a> </td>";
					
					echo "</tr>";
					$contador++;
				}
				
				echo "</table>";
			?>

			<hr>

			<a href="../homepage.html">Voltar para Ínicio</a> | <a href="agenda_cirurgia.html">Cadastrar Nova Cirúrgia</a>
		</div>
	</body>
</html>
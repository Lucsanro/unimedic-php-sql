<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Alteração de Cirúrgia</title>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/agendaAlteracao.css">
	</head>
	
	<body 	oncontextmenu="return false"
			ondragstart="return false"
			onselectstart="return false">
			
		<?php
			header("content-type: text/html;charset=utf-8");
		
			if(! isset($_GET['c']))
				die("Forma de chamada da rotina de 
					alteração incorreta!!");
				
			// colocando o código do time numa variável
			$codigo = $_GET['c'];
			
			// Conectar no MYSQL e abrir o banco
			include "conexao.php";
			
			mysqli_query($con,"SET NAMES 'utf8'");
			mysqli_query($con,"SET character_set_connection=utf8");
			mysqli_query($con,"SET character_set_client=utf8");
			mysqli_query($con,"SET character_set_results=utf8");
		
			// criar a variável $sql c/comando de seleção
			$sql ="SELECT * FROM agenda_cirurgia WHERE id=$codigo";
			
			// mostrar o comando na tela - copiar no console
			// se não funcionar - arrumo e tento de novo
			// se funcionar - comento a linha de baixo
			// e dou sequencia no programa
			//die($sql);
			
			// Executando o comando de seleção no MYSQL
			$registro = mysqli_query($con, $sql) or 
				die('Erro na seleção dos dados do time 
						$codigo:' . mysqli_error($con) );

			// verificando se localizou o time
			$linhas = mysqli_num_rows($registro);
			
			// Se $linhas for menor que 1 - não tem mais
			if($linhas<1)
				die("Agendamento foi excluído? - Sistema cancelado!");
			
			
			// desmembrando $registro em dados separados
			$dados = mysqli_fetch_array($registro);
			
			// Criando uma variável p/cada dado:
			$codigo			 = $dados["id"];				
			$nomePaciente	 = $dados['nomePaciente'];		
			$procedimento	 = $dados['procedimento'];		
			$medicoResponsa	 = $dados['medicoResponsa'];	
			$assistente		 = $dados['assistente'];		
			$salaCirurgica	 = $dados['salaCirurgica'];		
			$data			 = $dados['data'];			
			$periodo		 = $dados['periodo'];		
			$obs			 = $dados['obs'];
		?>	

		<div id="formCorpo">
			<h1 id="titulo">Agendamento Cirúrgico - Alteração</h1> <hr>
		
			<form	action="gravar_alt_cirurgia.php"
					method="post"> <br>
					
				<input 	type="hidden" name="id"
						value="<?php echo $codigo;?>">
				
				<p><label for="paciente">Paciente:<span class="corVermelha">*</span></label> <br>
				<input	type="text"	name="nomePaciente"
						id="paciente" maxlength="100"
						size="105" required
						value="<?php echo $nomePaciente;?>"></p> <br>
						
				<p><label for="cirurgia">Procedimento:<span class="corVermelha">*</span></label> <br>
				<input	type="text"	name="procedimento"
						id="cirurgia" maxlength="50"
						size="55" required list="proced"
						value="<?php echo $procedimento;?>"></p> <br>
						
				<datalist id="proced">
					<option value="Clareamento"></option>
					<option value="Extração"></option>
					<option value="Implante"></option>
					<option value="Limpeza"></option>
					<option value="Prótese Dentária"></option>
				</datalist>
					
				<p><label for="medico">Médico responsável:<span class="corVermelha">*</span></label> <br>
				<input	type="text"	name="medicoResponsa"
						id="medico"	maxlength="100"
						size="105" required
						value="<?php echo $medicoResponsa;?>"></p> <br>
				
				<p><label for="assistente">Assistente:</label> <br>
				<input	type="text"	name="assistente"
						id="assistente" maxlength="100"
						size="105"
						value="<?php echo $assistente;?>"></p> <br>
				
				<p><label for="sala">Sala Cirúrgica/Consultório:<span class="corVermelha">*</span></label>
				<input	type="number"	name="salaCirurgica"
						id="sala"	maxlength="2"
						min="1" max="30" required
						value="<?php echo $salaCirurgica;?>"><p> <br>
						
				<p><label for="data">Data:<span class="corVermelha">*</span></label>
				<input	type="date"	name="data"
						id="data" required
						value="<?php echo $data;?>"><p> <br>
				
				<?php
					$manha ="";
					$tarde ="";
					
					if($periodo == "M") $manha = "checked";
					if($periodo == "T") $tarde = "checked";				
				?>
				
				<p>Periodo:
				<input  type="radio"	name="periodo"
						id="manha" value="M"
						<?php echo $manha;?>> <label for="manha">Manhã</label>
				
				<input  type="radio"	name="periodo"
						id="tarde" value="T"
						<?php echo $tarde;?>> <label for="tarde">Tarde</label><p> <br>
				
				<p>Observações: <br>
				<textarea	type="text"
							name="obs"
							id="obs"
							maxlength="500"
							placeholder="Insira eventuais observações aqui"><?php echo $obs;?></textarea> <p> <br>
						
				<input id="envio" class="btn btn-lightblue" type="submit" value="Alterar">
			</form>
		</div>
	</body>
</html>